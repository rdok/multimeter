<?php declare(strict_types = 1);

namespace App\Command;

use App\Db\ProvidesDbClient;
use App\Dht22\ProvidesDht22Client;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class TemperatureCommand extends Command
{
    /** @var string */
    protected static $defaultName = 'dht22:temperature';

    /** @var ProvidesDbClient */
    private $dbClient;
    /** @var ProvidesDht22Client */
    private $dht22Client;

    public function __construct(
        ProvidesDht22Client $dht22Client,
        ProvidesDbClient $dbClient
    )
    {
        parent::__construct();

        $this->dbClient = $dbClient;
        $this->dht22Client = $dht22Client;
    }

    protected function configure(): void
    {
        $this->setDescription(
            'Get a reading from dht22 and store it to the db service.'
        );
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int
    {
        $temperature = $this->dht22Client->getTemperature();
        $dbRecord = $this->dbClient->storeTemperature($temperature);

        $log = sprintf('Temperature added: %s', json_encode($dbRecord));

        $output->writeln([$log]);

        return 0;
    }
}
