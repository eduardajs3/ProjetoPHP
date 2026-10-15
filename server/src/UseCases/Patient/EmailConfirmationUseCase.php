<?php
namespace App\App\UseCases\Patient;

use App\App\Repository\PatientRepository;

class EmailConfirmationUseCase{
	private $repository;

	public function __construct(PatientRepository $repository){
		$this->repository = $repository;
	}
	public function execute($id){
		$user = $this->repository->getPatientById($id);
		return $user['isEmailVerified'] ? false : $this->repository->confirmEmail($id);
	}
}