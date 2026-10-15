<?php

namespace App\App\Errors;

use Exception;

class InvalidCredentialsError extends Exception {
    public function __construct($message = "Email or password is incorrect", $code = 401) {
		parent::__construct($message, $code);
	}
}