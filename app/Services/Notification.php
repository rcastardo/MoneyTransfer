<?php

namespace MoneyTransfer\Services;

use GuzzleHttp\Client;

class Notification
{
    public static function send()
    {
        $client = new Client(['base_uri' => 'https://run.mocky.io']);
        $response = $client->request('GET', '/v3/b19f7b9f-9cbf-4fc6-ad22-dc30601aec04');

        $data = (array)json_decode($response->getBody());

        return $data['message'] === 'Enviado';
    }
}
