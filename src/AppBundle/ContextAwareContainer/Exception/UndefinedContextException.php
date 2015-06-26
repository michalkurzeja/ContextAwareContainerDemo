<?php

namespace AppBundle\ContextAwareContainer\Exception;

use Exception;

class UndefinedContextException extends Exception
{
    public function __construct($context, $code = 0, Exception $previous = null)
    {
        parent::__construct("Context \"$context\" has not been defined", $code, $previous);
    }
}