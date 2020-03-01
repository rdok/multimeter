<?php declare(strict_types=1);

namespace App\Db;

use App\Temperature\ProvidesTemperature;
use App\Validation\ValidatorFactory;
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
        $response = $this->httpClient->request(
            'POST',
            'http://proxy/db/temperatures',
            ['body' => $temperature->data()]
        );

        $response = json_decode($response->getContent(), true);

        $this->validate($response);

        return $response['id'];
    }

    private function validate($response)
    {
        $validator = ValidatorFactory::make($response, ['id' => 'required']);

        if ($validator->fails()) {
            throw new InvalidDbResponse($validator->errors()->toJson());
        }
    }
}
