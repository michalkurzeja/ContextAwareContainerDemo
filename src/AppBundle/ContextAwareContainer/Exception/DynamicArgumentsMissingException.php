<?php

namespace AppBundle\ContextAwareContainer\Exception;

use Exception;

class DynamicArgumentsMissingException extends Exception
{
    public function __construct($alias, $context, $code = 0, Exception $previous = null)
    {
        parent::__construct("Dynamic arguments for service \"$alias\" in context \"$context\" are missing", $code, $previous);
    }
}