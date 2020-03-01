<?php declare(strict_types=1);

use App\Db\DbClient;
use App\Db\ProvidesDbClient;
use App\Dht22\Dht22Client;
use App\Dht22\ProvidesDht22Client;
use DI\Container;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

return [
    HttpClientInterface::class => function () {
        return HttpClient::create();
    },
    ProvidesDbClient::class => function (Container $container) {
        $httpClient = $container->get(HttpClientInterface::class);

        return new DbClient($httpClient);
    },
    ProvidesDht22Client::class => function (Container $container) {
        $httpClient = $container->get(HttpClientInterface::class);

        return new Dht22Client($httpClient);
    }
];
