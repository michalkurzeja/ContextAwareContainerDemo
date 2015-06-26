<?php

namespace AppBundle\ContextAwareContainer\Interfaces;

use AppBundle\ContextAwareContainer\Exception\AlreadyInitializedException;

interface Initializable
{
    /**
     * @return void
     * @throws AlreadyInitializedException
     */
    public function initialize();

    /**
     * @return bool
     */
    public function isInitialized();
}