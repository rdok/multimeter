#!/usr/bin/env php
<?php

use Symfony\Component\Console\Application;

$application = new Application();

// ... register commands

$application->run();

$application->add(new GenerateAdminCommand());
