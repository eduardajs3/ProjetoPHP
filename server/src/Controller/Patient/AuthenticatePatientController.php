<?php

namespace App\App\Controller\Patient;

use App\App\Repository\PatientRepository;
use App\App\UseCases\Patient\AuthenticatePatientUseCase;
use App\App\Errors\InvalidCredentialsError;

class AuthenticatePatientController {
  public function handle() {
    try {
      $user = json_decode(file_get_contents("php://input"));
			$patientRepository = new PatientRepository();
			$authenticatePatientUseCase = new AuthenticatePatientUseCase($patientRepository, "patients");

			$token = $authenticatePatientUseCase->execute($user);

			echo json_encode($token);
    } catch (InvalidCredentialsError $err) {
      $statusCode = $err->getCode();
			$message = $err->getMessage();

			http_response_code($statusCode);
			echo json_encode([
					"message" => $message,
			]);
    }
  }
}