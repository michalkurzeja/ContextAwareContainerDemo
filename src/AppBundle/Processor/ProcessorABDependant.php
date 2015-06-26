<?php

namespace AppBundle\Processor;

use AppBundle\ContextAwareContainer\Interfaces\DynamicArgumentsInterface;

class ProcessorABDependant implements DynamicArgumentsInterface
{
    protected $processor;

    public function process()
    {
        return 'ProcessorAB::process() + ' . $this->processor->process();
    }

    public function setDynamicArguments(array $arguments)
    {
        $this->processor = $arguments[0];
    }
}