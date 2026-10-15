<?php

namespace App\App\UseCases\Patient;

use App\App\Model\PatientModel;
use App\App\Repository\PatientRepository;

class ListAllPatientsUseCase
{
	private $patient;
  private $repository;
	public function __construct(PatientModel $model, PatientRepository $repository)
	{
		$this->patient = $model;
		$this->repository = $repository;
	}

	public function execute($nutritionistId)
	{
		$patients = $this->repository->getAllPatients($nutritionistId);

		return $patients;
	}
}
