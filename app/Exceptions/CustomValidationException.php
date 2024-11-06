<?php

namespace App\Exceptions;

use Exception;

class CustomValidationException extends Exception {

    public function __construct(
        $message,
        public array $errors = []
    ) {
        parent::__construct($message);
    }
}
