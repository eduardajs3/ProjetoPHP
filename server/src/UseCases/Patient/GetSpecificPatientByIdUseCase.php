<?php

namespace App\App\UseCases\Patient;

use App\App\Model\PatientModel;
use App\App\Errors\ResourceNotFoundError;
use App\App\Repository\PatientRepository;

class GetSpecificPatientByIdUseCase
{
	private $patient;
  private $repository;
	public function __construct(PatientModel $model, PatientRepository $repository)
	{
		$this->patient = $model;
		$this->repository = $repository;
	}

	public function execute($id)
	{
		$patientExists = $this->repository->getPatientById($id);

		if (!$patientExists) {
			throw new ResourceNotFoundError();
		} else {
			return $patientExists;
		}
	}
}
