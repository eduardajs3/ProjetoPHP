<?php

namespace App\App\UseCases\Patient;

use App\App\Email\SendEmail;
use App\App\Model\PatientModel;
use App\App\Errors\CrendetialsAlreadyTakenError;
use App\App\Repository\PatientRepository;

class CreatePatientUseCase {
	private $patient;
	private $repository;

	public function __construct(PatientModel $patient, PatientRepository $repository)
	{
		$this->patient = $patient;
		$this->repository = $repository;
	}

	public function execute($patientBody, $nutritionistId) {
		$this->patient->setName($patientBody->name);
		$this->patient->setEmail($patientBody->email);
		$this->patient->setPassword($patientBody->password);
		$this->patient->setCpf($patientBody->CPF);
		$this->patient->setBirthDate($patientBody->birthDate);
		$this->patient->setNutritionistId($nutritionistId);

		$patientAlreadyExists = $this->repository->getPatientByEmail($this->patient->getEmail());
		$cpfAlreadyTaken = $this->repository->getPatienteByCpf($this->patient->getCpf());

		if ($cpfAlreadyTaken || $patientAlreadyExists) {
			throw new CrendetialsAlreadyTakenError();
		} else {
			$patientCreated = $this->repository->insertPatient($this->patient);
			return $patientCreated;
		}
	}
}
