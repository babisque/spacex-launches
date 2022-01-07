<?php

namespace App\Controllers;

class Rockets extends BaseController
{
    public function nextLaunch()
    {
        $options = [
            'baseURI' => 'https://api.spacexdata.com',
            'timeout' => 3,
        ];

        $client = \Config\Services::curlrequest($options);
        $response = $client->get('v4/launches/next', ['verify' => false]);

        $body = json_decode($response->getBody(), true);
        $data['date_launch'] = $body['date_utc'];
        $data['title'] = $body['name'];

        return view('Views/pages/index', $data);
    }
}