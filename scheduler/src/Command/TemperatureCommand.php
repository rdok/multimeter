<?php

namespace App\Command;

use App\Db\DbClientInterface;
use App\Dht22\Dht22ClientInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TemperatureCommand extends Command
{
    protected static $defaultName = 'dht22:temperature';

    private DbClientInterface $dbClient;
    private Dht22ClientInterface $dht22Client;

    public function __construct(
        Dht22ClientInterface $dht22Client,
        DbClientInterface $dbClient
    )
    {
        parent::__construct();

        $this->dbClient = $dbClient;
        $this->dht22Client = $dht22Client;
    }

    protected function configure()
    {
        $this->setDescription(
            'Get a reading from dht22 and store it to the db service.'
        );
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $temperature = $this->dht22Client->getTemperature();
        $dbRecord = $this->dbClient->storeTemperature($temperature);

        $log = sprintf('Temperature added: %s', json_encode($dbRecord));

        $output->writeln([$log]);

        return 0;
    }
}
