<?php

namespace App\App\Errors;

use Exception;

class CrendetialsAlreadyTakenError extends Exception {
    public function __construct($message = "CPF or email is already taken", $code = 409) {
		parent::__construct($message, $code);
	}
}