<?php

namespace MoneyTransfer\Services;

use GuzzleHttp\Client;

class NotificationTransaction
{
    public static function send()
    {
        $client = new Client(['base_uri' => 'https://run.mocky.io']);
        $response = $client->request('GET', '/v3/b19f7b9f-9cbf-4fc6-ad22-dc30601aec04');

        $data = json_decode($response->getBody(), true);

        return $data['message'] === 'Enviado';
    }
}
