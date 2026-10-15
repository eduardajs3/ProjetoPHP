<?php

namespace App\App\Errors;

use Exception;

class UnauthorizedError extends Exception {
    public function __construct($message = "Unauthorized", $code = 401) {
		parent::__construct($message, $code);
	}
}