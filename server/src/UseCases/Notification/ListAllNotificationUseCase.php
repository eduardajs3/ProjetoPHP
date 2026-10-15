<?php

namespace App\App\UseCases\Notification;

use App\App\Repository\NotificationRepository;

class ListAllNotificationUseCase {
  private $repository;

	public function __construct() {
		$this->repository = new NotificationRepository();
	}

  public function execute() {
    $notifications = $this->repository->getAllNotifications();

    return $notifications;
  }
}