<?php

namespace App\App\Controller\Patient;

use App\App\Model\PatientModel;
use App\App\UseCases\Patient\DeletePatientUseCase;
use App\App\Errors\ResourceNotFoundError;
use App\App\Repository\PatientRepository;

class DeletePatientController
{
	public function handle($params)
	{
		try {
			$id = $params['id'];

			$patient = new PatientModel();
			$paienteRepository = new PatientRepository();
			$deletePatientUseCase = new DeletePatientUseCase($patient, $paienteRepository);

			return $deletePatientUseCase->execute($id);
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
