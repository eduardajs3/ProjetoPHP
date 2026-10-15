<?php

namespace App\App\Controller\Notification;

use App\App\Repository\NotificationRepository;
use App\App\UseCases\Notification\ListAllNotificationUseCase;

class ListAllNotificationsController {
  public function handle() {
    $notificationRepository = new NotificationRepository();
    $listAllNotificationUseCase = new ListAllNotificationUseCase($notificationRepository);

    $notifications = $listAllNotificationUseCase->execute();

    echo json_encode($notifications);
  }
}