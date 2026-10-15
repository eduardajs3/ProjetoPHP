<?php

namespace App\App\UseCases\Notification;
use App\App\Errors\ResourceNotFoundError;
use App\App\Repository\NotificationRepository;

class MarkNotificationAsReadUseCase {
  private $repository;

	public function __construct() {
		$this->repository = new NotificationRepository();
	}

  public function execute($id) {
    $notification = $this->repository->getNotificationById($id);

    if (!$notification) {
      throw new ResourceNotFoundError();
    } else {
      $this->repository->updateNotificationRead($id);
    }
  }
}