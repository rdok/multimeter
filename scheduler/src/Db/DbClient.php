<?php declare(strict_types = 1);

namespace App\Db;

use App\Temperature\ProvidesTemperature;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class DbClient implements ProvidesDbClient
{
    /** * @var HttpClientInterface */
    private $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function storeTemperature(ProvidesTemperature $temperature): string
    {
        $this->httpClient->request(
            'POST',
            'http://proxy/db/temperatures',
            ['body' => $temperature->data()]
        );

        return "2077";
    }
}
