<?php

namespace App\App\Errors;

use Exception;

class ResourceNotFoundError extends Exception {
	public function __construct($message = "Resource not found", $code = 404) {
		parent::__construct($message, $code);
	}
}