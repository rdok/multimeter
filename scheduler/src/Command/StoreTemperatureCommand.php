<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class StoreTemperatureCommand extends Command
{
    protected static $defaultName = 'dht22:store-temperature';

    protected function configure()
    {
        $description = 'Get a reading from dht22 and store it to the db '
            . 'service';

        $this->setDescription($description);
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
       $output->writeln(['testing', 'testing2']);

       return 0;
    }
}
