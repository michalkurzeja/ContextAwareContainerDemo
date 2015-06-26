<?php

namespace AppBundle\ContextAwareContainer\Exception;

use Exception;

class ServiceNotFoundInContextException extends Exception
{
    public function __construct($alias, $context, $code = 0, Exception $previous = null)
    {
        parent::__construct("Service\"$alias\" was not found in context \"$context\"", $code, $previous);
    }
}