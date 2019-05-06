<?php

namespace qlixes\Tiket;

use qlixes\Tiket\TiketException;
use GuzzleHttp\Client;

class Base extends TiketException
{
    protected $client;

    protected $options = [];
    protected $headers = [];
    protected $body = [];

    function getBaseUri($uri, $port)
    {
        $ports = ($port) ?? 443;

        $client = new Client([
            'base_uri' => $uri
        ]);

        return $client;
    }
}