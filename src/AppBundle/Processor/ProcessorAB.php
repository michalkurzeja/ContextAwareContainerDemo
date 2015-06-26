<?php

namespace AppBundle\Processor;

use AppBundle\ContextAwareContainer\Interfaces\DynamicArgumentsInterface;

class ProcessorAB
{
    protected $processor;

    public function process()
    {
        return 'ProcessorAB::process()';
    }

}