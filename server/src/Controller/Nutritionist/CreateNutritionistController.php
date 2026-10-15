<?php

namespace App\App\Controller\Nutritionist;

use App\App\Email\SendEmail;
use App\App\Model\NutritionistModel;
use App\App\UseCases\Nutritionist\CreateNutritionistUseCase;
use App\App\Errors\EmailAlreadyTakenError;
use App\App\Commons\Validations\ValidateRequestBody;

class CreateNutritionistController {
public function handle() {
	$body = json_decode(file_get_contents("php://input"));

	$object = new ValidateRequestBody();

	$requiredFiles = ['name', 'email', 'password', 'cnpj'];
	$isBodyValid = $object->parse($body, $requiredFiles);

	if (!$isBodyValid['valid']) {
		http_response_code(400);
		echo json_encode(['error' => $isBodyValid['error']]);
		exit();
	}

	try {
		$nutritionist = new NutritionistModel();
		$emailSender = new SendEmail();
		$createNutritionistUseCase = new CreateNutritionistUseCase($nutritionist, $emailSender);

		$nutritionist = $createNutritionistUseCase->execute($body);

		http_response_code(201);
		echo json_encode($nutritionist);

	} catch(EmailAlreadyTakenError $err) {
		$statusCode = $err->getCode();
		$message = $err->getMessage();

		http_response_code($statusCode);
		echo json_encode([
				"message" => $message,
		]);
	}
}
}