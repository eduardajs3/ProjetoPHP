<?php

namespace App\App\UseCases\Patient;

use App\App\Model\PatientModel;
use App\App\Errors\ResourceNotFoundError;
use App\App\Repository\PatientRepository;

class UpdatePatientUseCase
{
	private $patient;
	private $repository;
	public function __construct(PatientModel $model, PatientRepository $repository)
	{
		$this->patient = $model;
		$this->repository = $repository;
	}

	public function execute($id, $patientBody)
	{
		$this->patient->setId($id);
		$this->patient->setName($patientBody->name);
		$this->patient->setEmail($patientBody->email);
		$this->patient->setAvatar($patientBody->avatar);
		$this->patient->setCpf($patientBody->cpf);
		$this->patient->setBirthDate($patientBody->birthDate);

		$patientExists = $this->repository->getPatientByEmail($patientBody->email);

		if (!$patientExists) {
			throw new ResourceNotFoundError();
		} else {
			echo $this->repository->updatePatient($this->patient);
		}
	}
}
