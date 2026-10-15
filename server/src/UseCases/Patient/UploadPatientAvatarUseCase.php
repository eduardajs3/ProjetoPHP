<?php

namespace App\App\UseCases\Patient;

use App\App\Errors\ResourceNotFoundError;
use App\App\Repository\PatientRepository;

use Aws\S3\S3Client;
use Aws\Exception\AwsException;


class UploadPatientAvatarUseCase {
	private $repository;

	public function __construct() {
		$this->repository = new PatientRepository();
	}
  
  public function execute($id, $file) {
    $s3Client = new S3Client([
      'version' => 'latest',
      'region' => $_ENV["AWS_BUCKET_REGION"],
      'credentials' => [
        'key'    => $_ENV["AWS_ACCESS_KEY"],
        'secret' => $_ENV["AWS_SECRET_ACCESS_KEY"],
      ],
    ]);

    $patientExists = $this->repository->getPatientById($id);

    if (!$patientExists || !$file) {
      throw new ResourceNotFoundError();
    } else {
      $fileTmpPath = $file['tmp_name'];
      $fileName = $file['name'];
      $fileType = $file['type'];

      $key = 'avatars/patient/' . time() . '_' . basename($fileName);

      $result = $s3Client->putObject([
        'Bucket' => $_ENV["AWS_BUCKET"],
        'Key'    => $key,
        'SourceFile' => $fileTmpPath,
        'ContentType' => $fileType,
        'ACL'    => 'public-read', 
      ]);

      $avatarURL = $result['ObjectURL'];
      $this->repository->updatePatientAvatar($id, $avatarURL);

      return [
        "patientId" => $id,
        "avatar" => $avatarURL,
      ];
    }
  }
}