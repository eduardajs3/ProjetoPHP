<?php

namespace App\App\UseCases\Nutritionist;

use App\App\Errors\ResourceNotFoundError;
use App\App\Repository\NutritionistRepository;

use Aws\S3\S3Client;
use Aws\Exception\AwsException;


class UploadNutritionistAvatarUseCase {
	private $repository;

	public function __construct() {
		$this->repository = new NutritionistRepository();
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

    $nutritionistExists = $this->repository->getNutritionistById($id);

    if (!$nutritionistExists || !$file) {
      throw new ResourceNotFoundError();
    } else {
      $fileTmpPath = $file['tmp_name'];
      $fileName = $file['name'];
      $fileType = $file['type'];

      $key = 'avatars/nutri/' . time() . '_' . basename($fileName);

      $result = $s3Client->putObject([
        'Bucket' => $_ENV["AWS_BUCKET"],
        'Key'    => $key,
        'SourceFile' => $fileTmpPath,
        'ContentType' => $fileType,
        'ACL'    => 'public-read', 
      ]);

      $avatarURL = $result['ObjectURL'];
      $this->repository->updateNutritionistAvatar($id, $avatarURL);

      return [
        "nutritionistId" => $id,
        "avatar" => $avatarURL,
      ];
    }
  }
}