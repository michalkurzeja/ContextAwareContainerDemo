<?php

namespace AppBundle\ContextAwareContainer\Exception;

use Exception;

class AlreadyInitializedException extends Exception
{
    public function __construct($message = "This object has already been initialized", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}