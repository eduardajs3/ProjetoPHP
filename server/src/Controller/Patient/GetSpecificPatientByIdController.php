<?php

namespace App\App\Controller\Patient;

use App\App\Model\PatientModel;
use App\App\UseCases\Patient\GetSpecificPatientByIdUseCase;
use App\App\Errors\ResourceNotFoundError;
use App\App\Repository\PatientRepository;

class GetSpecificPatientByIdController
{
	public function handle($params)
	{
		try {
			$id = $params['id'];

			$patient = new PatientModel();
			$paienteRepository = new PatientRepository();
			$getSpecificPatientByIdUseCase = new GetSpecificPatientByIdUseCase($patient, $paienteRepository);

			$result = $getSpecificPatientByIdUseCase->execute($id);

			http_response_code(200);
			echo json_encode($result);
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
