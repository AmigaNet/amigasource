<?php

namespace AmigaSource\Auth;

class UserNotFoundException extends \Exception

{
    public function __construct($message = 'User is not found', $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
