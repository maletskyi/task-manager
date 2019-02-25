<?php

declare(strict_types=1);

namespace App\Utils;

use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;

class DIControllerResolver extends ControllerResolver
{
    private $container;

    public function __construct(ContainerBuilder $container, LoggerInterface $logger = null)
    {
        $this->container = $container;

        parent::__construct($logger);
    }

    protected function instantiateController($class)
    {
        $reflector = new \ReflectionClass($class);

        $constructor = $reflector->getConstructor();

        if ($constructor === null) {
            $instance = $reflector->newInstance();
        } else {
            $dependencies = [];

            foreach ($constructor->getParameters() as $parameter) {
                $dependencies[] = $this->container->get($parameter->getClass()->name);
            }

            $instance = $reflector->newInstanceArgs($dependencies);
        }

        return $instance;
    }
}