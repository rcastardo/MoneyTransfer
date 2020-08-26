<?php

namespace MoneyTransfer\Services;

use GuzzleHttp\Client;

class Authorized
{
    public static function call()
    {
        $client = new Client(['base_uri' => 'https://run.mocky.io']);
        $response = $client->request('GET', '/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6');

        $data = (array)json_decode($response->getBody());

        return $data['message'] === 'Autorizado';
    }
}
