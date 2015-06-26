<?php

namespace AppBundle\ContextAwareContainer;

use AppBundle\ContextAwareContainer\Exception\AlreadyInitializedException;
use AppBundle\ContextAwareContainer\Exception\AlreadyRegisteredException;
use AppBundle\ContextAwareContainer\Exception\DynamicArgumentsMissingException;
use AppBundle\ContextAwareContainer\Exception\ServiceNotFoundInContextException;
use AppBundle\ContextAwareContainer\Exception\UndefinedContextException;
use AppBundle\ContextAwareContainer\Interfaces\ContextAwareContainerInterface;
use AppBundle\ContextAwareContainer\Interfaces\DynamicArgumentsInterface;
use AppBundle\ContextAwareContainer\Interfaces\Initializable;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ContextAwareContainer implements ContextAwareContainerInterface, Initializable
{
    /** @var ContainerInterface */
    protected $container;
    /** @var array */
    protected $services;
    /** @var array */
    protected $arguments;

    /** @var bool */
    private $initialized;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->services = [];
        $this->arguments = [];

        $this->initialized = false;
    }

    public function get($context, $alias)
    {
        $serviceId = $this->getServiceId($context, $alias);
        $service = $this->container->get($serviceId);

        if ($service instanceof DynamicArgumentsInterface) {
            if (!isset($this->arguments[$serviceId][$context])) {
                throw new DynamicArgumentsMissingException($alias, $context);
            }

            $arguments = [];

            foreach ($this->arguments[$serviceId][$context] as $argServiceId) {
                $arguments[] = $this->container->get($this->getServiceId($context, $argServiceId));
            }

            $service->setDynamicArguments($arguments);
        }

        return $service;
    }

    protected function getServiceId($context, $alias)
    {
        if (!isset($this->services[$context])) {
            throw new UndefinedContextException($context);
        }

        if (!isset($this->services[$context][$alias])) {
            throw new ServiceNotFoundInContextException($alias, $context);
        }

        return $this->services[$context][$alias];
    }

    public function set($context, $alias, $serviceId, array $arguments)
    {
        if ($this->isInitialized()) {
            throw new AlreadyInitializedException;
        }

        if (isset($this->services[$context][$alias])) {
            throw new AlreadyRegisteredException($alias, $context);
        }

        $this->services[$context][$alias] = $serviceId;

        foreach ($arguments as $argContext => $argServiceId) {
            if ($argContext == $context) {
                $this->arguments[$serviceId][$argContext][] = $argServiceId;
            }
        }
    }

    public function initialize()
    {
        if ($this->isInitialized()) {
            throw new AlreadyInitializedException;
        }

        $this->initialized = true;
    }

    public function isInitialized()
    {
        return $this->initialized;
    }
}