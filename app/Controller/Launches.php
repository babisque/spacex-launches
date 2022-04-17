<?php

namespace Spacex\Controller;

use Laminas\Diactoros\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Spacex\Service\HtmlRender;

class Launches
{
    use HtmlRender;

    public function nextLaunch(): ResponseInterface
    {
        $response = file_get_contents("https://api.spacexdata.com/v4/launches/next");
        $response = json_decode($response);

        $html = $this->htmlRender('pages/index.php', [
            'launch' => $response,
            'title' => $response->name,
        ]);

        return new Response\HtmlResponse($html, 200, []);
    }

    public function pastLaunches(): ResponseInterface
    {
        $response = file_get_contents("https://api.spacexdata.com/v4/launches/past");
        $response = json_decode($response);

        $html = $this->htmlRender('pages/pastLaunches.php', [
            'title' => 'Past Launches',
            'launches' => $response,
        ]);

        return new Response\HtmlResponse($html, 200, []);
    }

    public function lastLaunch(): ResponseInterface
    {
        $response = file_get_contents("https://api.spacexdata.com/v4/launches/latest");
        $response = json_decode($response);

        $rocket = file_get_contents("https://api.spacexdata.com/v4/rockets/$response->rocket");
        $rocket = json_decode($rocket);

        $html = $this->htmlRender('pages/latest.php', [
            'flightNumber' => $response->flight_number,
            'details' => $response->details,
            'rocketDetails' => $rocket->flickr_images,
        ]);

        return new Response\HtmlResponse($html, 200, []);
    }
}