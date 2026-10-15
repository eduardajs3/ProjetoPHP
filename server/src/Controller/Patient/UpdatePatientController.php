<?php

namespace App\App\Controller\Patient;

use App\App\Model\PatientModel;
use App\App\UseCases\Patient\UpdatePatientUseCase;
use App\App\Errors\ResourceNotFoundError;
use App\App\Repository\PatientRepository;

class UpdatePatientController
{
	public function handle($params)
	{
		try {
			$id = $params['id'];
			$body = json_decode(file_get_contents("php://input"));

			$patient = new PatientModel();
			$paienteRepository = new PatientRepository();
			$updatePatientUseCase = new UpdatePatientUseCase($patient, $paienteRepository);

			$updatePatientUseCase->execute($id, $body);

			http_response_code(200);
			echo json_encode(["message" => "Patient updated succesfully"]);
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
