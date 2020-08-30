<?php

namespace MoneyTransfer\Services;

use GuzzleHttp\Client;

class AuthorizedTransaction
{
    public static function call()
    {
        $client = new Client(['base_uri' => 'https://run.mocky.io']);
        $response = $client->request('GET', '/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6');

        $data = json_decode($response->getBody(), true);

        return $data['message'] === 'Autorizado';
    }
}
