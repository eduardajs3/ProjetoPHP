<?php

namespace App\App\Controller\Notification;

use App\App\Repository\NotificationRepository;
use App\App\UseCases\Notification\MarkNotificationAsReadUseCase;
use App\App\Errors\ResourceNotFoundError;

class MarkNotificationAsReadController {
  public function handle($params) {
    try {
			$id = $params['id'];

      $notificationRepository = new NotificationRepository();
			$markNotificationAsReadUseCase = new MarkNotificationAsReadUseCase($notificationRepository);

			$markNotificationAsReadUseCase->execute($id);

			http_response_code(204);
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