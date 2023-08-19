<?php

declare(strict_types=1);

namespace src\infra\http\gateway;

use GuzzleHttp\Exception\GuzzleException;
use src\app\gateway\authorizeTransferService\AuthorizeTransferService as AuthorizeTransferServiceInterface;
use GuzzleHttp\Client;
final class AuthorizeTransferService implements AuthorizeTransferServiceInterface
{
    public function __construct(
        private readonly Client $client
    ) {
    }
    /**
     * @throws GuzzleException
     */
    public function permittedOperation(): bool
    {
        $response = $this->client->request('GET', 'https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6');
        return json_decode($response->getBody()->getContents())->message == 'Autorizado';
    }
}
