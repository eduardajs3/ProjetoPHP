<?php

namespace App\App\Controller\Patient;

use App\App\Model\PatientModel;
use App\App\Repository\PatientRepository;
use App\App\UseCases\Patient\ListAllPatientsUseCase;

class ListAllPatientsController
{
	public function handle()
	{
		$nutritionistId = $_SESSION['user']->user->id;

		$patient = new PatientModel();
		$paienteRepository = new PatientRepository();
		$listAllPatientsUseCase = new ListAllPatientsUseCase($patient, $paienteRepository);

		$result = $listAllPatientsUseCase->execute($nutritionistId);

		http_response_code(200);
		echo json_encode($result);
	}
}
