<?php

namespace App\App\UseCases\Nutritionist;

use App\App\Model\NutritionistModel;
use App\App\Errors\EmailAlreadyTakenError;
use App\App\Repository\NutritionistRepository;
use App\App\Email\SendEmail;

class CreateNutritionistUseCase {
	private $nutritionist;
	private $respository;
	private $emailSender;

	public function __construct(NutritionistModel $model, SendEmail $emailSender) {
		$this->nutritionist = $model;
		$this->emailSender = $emailSender;
    $this->respository = new NutritionistRepository();
	}

	public function execute($nutritionistBody) {
		$this->nutritionist->setName($nutritionistBody->name);
		$this->nutritionist->setEmail($nutritionistBody->email);
		$this->nutritionist->setPassword($nutritionistBody->password);
		$this->nutritionist->setCnpj($nutritionistBody->cnpj);

		$nutritionistAlreadyExists = $this->respository->getNutritionistByEmail($nutritionistBody->email);

		if ($nutritionistAlreadyExists) {
			throw new EmailAlreadyTakenError();
		} else {
			$this->respository->insertNutritionist($this->nutritionist);
			$nutritionist = $this->respository->getNutritionistByEmail($nutritionistBody->email);

			$this->emailSender->sendEmailConfirmation($nutritionist, "Confirmação de email");

			return $nutritionist;
		}
	}
}