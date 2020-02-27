<?php declare(strict_types = 1);

namespace App;

use DI\Container;
use DI\ContainerBuilder;

final class App
{
    /** * @var Container */
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

    public function make($name)
    {
        return $this->ioc->get($name);
    }

    public function instance($name, $object)
    {
        $this->ioc->set($name, $object);

        return $this;
    }
}
