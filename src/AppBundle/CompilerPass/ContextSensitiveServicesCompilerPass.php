<?php

namespace AppBundle\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ContextSensitiveServicesCompilerPass implements CompilerPassInterface
{
    const CONTEXT_AWARE_CONTAINER_ID = 'app.container.context_aware';

    public function process(ContainerBuilder $container)
    {
        if (!$container->has(self::CONTEXT_AWARE_CONTAINER_ID)) {
            return;
        }

        $definition = $container->findDefinition(self::CONTEXT_AWARE_CONTAINER_ID);

        $taggedServices = $container->findTaggedServiceIds('context.sensitive');

        foreach ($taggedServices as $serviceId => $tags) {
            $serviceDefinition = $container->findDefinition($serviceId);
            $properties = $serviceDefinition->getProperties();
            $arguments = isset($properties['dynamic_arguments']) ? $properties['dynamic_arguments'] : [];

            foreach ($tags as $attributes) {
                $definition->addMethodCall(
                    'set',
                    [$attributes['context'], $attributes['alias'], $serviceId, $arguments]
                );
            }
        }

        $definition->addMethodCall('initialize');
    }
}