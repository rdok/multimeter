<?php declare(strict_types = 1);

namespace App\Dht22;

use App\Temperature\ProvidesTemperature;
use App\Temperature\Temperature;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class Dht22Client implements ProvidesDht22Client
{
    /** @var \Symfony\Contracts\HttpClient\HttpClientInterface $httpClient */
    private $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function getTemperature(): ProvidesTemperature
    {
        $url = 'http://proxy/dht22/temperature';

        $response = $this->httpClient->request('GET', $url);

        $data = json_decode($response->getContent(), true);

        return new Temperature($data);
    }
}
