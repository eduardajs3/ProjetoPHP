<?php

namespace App\App\UseCases\Patient;
use App\App\JWt\TokenManager;
use App\App\Repository\PatientRepository;
use App\App\Errors\InvalidCredentialsError;

class AuthenticatePatientUseCase {
	private PatientRepository $patientRepository;
	private $tokenManager;

	public function __construct(PatientRepository $patientRepository, $table)
	{
		$this->patientRepository = $patientRepository;
		$this->tokenManager = new TokenManager();
	}

  public function execute($patient) {
    $patientExists = $this->patientRepository->getPatientByEmail($patient->email);

    $passwordMatch = password_verify($patient->password, $patientExists['password']);

    if (!$patientExists || !$passwordMatch) {
			throw new InvalidCredentialsError();
		} else {
			$accessToken = $this->tokenManager->createToken($patientExists);
			
			return [
				"token" => $accessToken,
			];
		}
  }
}