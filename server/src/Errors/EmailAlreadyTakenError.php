<?php

namespace App\App\Errors;

use Exception;

class EmailAlreadyTakenError extends Exception {
    public function __construct($message = "Email already taken", $code = 409) {
		parent::__construct($message, $code);
	}
}