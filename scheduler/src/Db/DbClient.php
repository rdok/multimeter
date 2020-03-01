<?php declare(strict_types = 1);

namespace App\Db;

use App\Temperature\ProvidesTemperature;
use App\Validation\ValidatorFactory;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class DbClient implements ProvidesDbClient
{
    /** @var HttpClientInterface $httpClient */
    private $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function storeTemperature(ProvidesTemperature $temperature): string
    {
        $response = $this->httpClient->request(
            'POST',
            'http://proxy/db/temperatures',
            ['body' => $temperature->toArray()]
        );

        $response = json_decode($response->getContent(), true);

        $this->validate($response);

        return $response['id'];
    }

    /**
     * @param array<string> $response
     * @throws InvalidDbResponse
     */
    private function validate(array $response): void
    {
        $validator = ValidatorFactory::make($response, ['id' => 'required']);

        if ($validator->fails()) {
            throw new InvalidDbResponse($validator->errors()->toJson());
        }
    }
}
