<?php declare(strict_types = 1);

namespace App;

use DI\ContainerBuilder;

final class App
{
    /** @var \DI\Container $ioc */
    private $ioc;

    public function __construct()
    {
        $this->setupIoC();
    }

    private function setupIoC(): void
    {
        $builder = new ContainerBuilder();
        $definitions = __DIR__ . '/../config/services.php';

        $builder->addDefinitions($definitions);
        $this->ioc = $builder->build();
    }

    public function make(string $name): object
    {
        return $this->ioc->get($name);
    }

    public function instance(string $name, object $object): self
    {
        $this->ioc->set($name, $object);

        return $this;
    }
}
