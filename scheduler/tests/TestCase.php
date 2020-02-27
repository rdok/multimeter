<?php declare(strict_types = 1);

namespace Tests;

use App\App;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;

abstract class TestCase extends PHPUnitTestCase
{
    /** @var App */
    protected $app;

    public function setUp():void
    {
        parent::setUp();

        $this->app = require __DIR__.'/../config/bootstrap.php';
    }
}