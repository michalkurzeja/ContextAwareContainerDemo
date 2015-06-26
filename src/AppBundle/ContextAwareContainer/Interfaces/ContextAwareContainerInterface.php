<?php

namespace AppBundle\ContextAwareContainer\Interfaces;

use AppBundle\ContextAwareContainer\Exception\AlreadyInitializedException;
use AppBundle\ContextAwareContainer\Exception\DynamicArgumentsMissingException;
use AppBundle\ContextAwareContainer\Exception\ServiceNotFoundInContextException;
use AppBundle\ContextAwareContainer\Exception\UndefinedContextException;

interface ContextAwareContainerInterface
{
    /**
     * @param $context
     * @param $alias
     * @return mixed
     * @throws UndefinedContextException
     * @throws ServiceNotFoundInContextException
     * @throws DynamicArgumentsMissingException
     */
    public function get($context, $alias);

    /**
     * @param $context
     * @param $alias
     * @param $serviceId
     * @param array $arguments
     * @return mixed
     * @throws AlreadyInitializedException
     */
    public function set($context, $alias, $serviceId, array $arguments);
}