<?php

namespace App\App\UseCases\Patient;

use App\App\Email\SendEmail;
use App\App\Errors\ResourceNotFoundError;
use App\App\Repository\PatientRepository;

class InvitePatientUseCase {
	private $repository;
	private $emailSender;

	public function __construct(PatientRepository $repository, SendEmail $emailSender)
	{
		$this->repository = $repository;
		$this->emailSender = $emailSender;
	}

  public function execute($patientEmail) {
    $this->emailSender->sendInvite($patientEmail, "Convite");
  }
}