<?php

namespace AppBundle\ContextAwareContainer\Exception;

use Exception;

class AlreadyRegisteredException extends Exception
{
    public function __construct($alias, $context, $code = 0, Exception $previous = null)
    {
        parent::__construct("Service \"$alias\" has already been registered for context \"$context\"", $code, $previous);
    }
}