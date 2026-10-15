<?php

namespace App\App\Controller\Patient;
use App\App\Repository\PatientRepository;
use App\App\UseCases\Patient\UploadPatientAvatarUseCase;
use App\App\Errors\ResourceNotFoundError;

use Aws\Exception\AwsException;

class UploadPatientAvatarController {
  public function handle($params) {
    try {
      $id = $params['id'];
      $file = $_FILES['image'];

      $patientRepository = new PatientRepository();
      $uploadPatientAvatarUseCase = new UploadPatientAvatarUseCase($patientRepository);

      $result = $uploadPatientAvatarUseCase->execute($id, $file);

      echo json_encode($result);
    } catch (ResourceNotFoundError $err) {
      $statusCode = $err->getCode();
			$message = $err->getMessage();

			http_response_code($statusCode);
			echo json_encode([
				"message" => $message,
			]);
    }
  }
}