<?php

namespace AmigaSource\Auth;

class PasswordException extends \Exception

{
    public function __construct($message = 'Password is not valid', $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
