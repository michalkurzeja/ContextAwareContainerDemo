<?php

namespace AppBundle\ContextAwareContainer\Interfaces;

interface Initializable
{
    public function initialize();
    public function isInitialized();
}