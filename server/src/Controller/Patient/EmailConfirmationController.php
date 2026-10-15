<?php

namespace App\App\Controller\Patient;

use App\App\Repository\PatientRepository;
use App\App\UseCases\Patient\EmailConfirmationUseCase;

class EmailConfirmationController
{
	public function handle($id)
	{
		$repository = new PatientRepository();
		try {
			$EmailUseCase = new EmailConfirmationUseCase($repository);
			$verfyUser = $EmailUseCase->execute($id);
			echo !!$verfyUser ? "email verificado com sucesso" : "O email já foi verificado anteriormente";
		} catch (\Throwable $th) {
			echo json_encode(["msg" => $th->getMessage()]);
		}
	}
}
