<?php

namespace App\App\Controller\Patient;

use App\App\Email\SendEmail;
use App\App\Repository\PatientRepository;
use App\App\Errors\ResourceNotFoundError;
use App\App\Commons\Validations\ValidateRequestBody;
use App\App\UseCases\Patient\InvitePatientUseCase;

class InvitePatientController {
  public function handle() {
    $body = json_decode(file_get_contents("php://input"));

		$object = new ValidateRequestBody();

		$requiredFields = ['email'];
		$isBodyValid = $object->parse($body, $requiredFields);

    if (!$isBodyValid['valid']) {
			http_response_code(400);
			echo json_encode(['error' => $isBodyValid['error']]);
			exit();
		}

    try {
			$patientRepository = new PatientRepository();
			$emailSender = new SendEmail();
			$invitePatientUseCase = new InvitePatientUseCase($patientRepository, $emailSender);

			$invitePatientUseCase->execute($body->email);
			http_response_code(200);
			echo json_encode([
				"message" => "Invite sent successfully!"
			]);
    } catch (ResourceNotFoundError $err) {
      $statusCode = $err->getCode();
			$message = $err->getMessage();

			http_response_code($statusCode);
			echo json_encode([
				"message" => $message,
			]);
    }
    
  }
}