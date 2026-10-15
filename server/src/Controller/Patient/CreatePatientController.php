<?php

namespace App\App\Controller\Patient;

use App\App\Model\PatientModel;
use App\App\UseCases\Patient\CreatePatientUseCase;
use App\App\Errors\CrendetialsAlreadyTakenError;
use App\App\Repository\PatientRepository;
use App\App\Commons\Validations\ValidateRequestBody;

class CreatePatientController {
	public function handle() {
		$body = json_decode(file_get_contents("php://input"));

		$object = new ValidateRequestBody();

		$requiredFiles = ['name', 'email', 'password', 'CPF', 'birthDate'];
		$isBodyValid = $object->parse($body, $requiredFiles);
 
		if (!$isBodyValid['valid']) {
			http_response_code(400);
			echo json_encode(['error' => $isBodyValid['error']]);
			exit();
		}

		try {
			$nutritionistId = $_SESSION['user']->user->id;

			$patient = new PatientModel();
			$paienteRepository = new PatientRepository();
			$createPatientUseCase = new CreatePatientUseCase($patient, $paienteRepository);

			$execution = $createPatientUseCase->execute($body, $nutritionistId);
			http_response_code(201);
			echo json_encode($execution);
		} catch (CrendetialsAlreadyTakenError $err) {
			$statusCode = $err->getCode();
			$message = $err->getMessage();

			http_response_code($statusCode);
			echo json_encode([
				"message" => $message,
			]);
		}
	}
}
