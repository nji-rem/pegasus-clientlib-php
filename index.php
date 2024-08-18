<?php

use GuzzleHttp\Client;
use Merijn\Pegasus\App;
use Merijn\Pegasus\Http\ClientFactory;
use Merijn\Pegasus\Http\ClientOptions;

require_once __DIR__ . '/vendor/autoload.php';

$clientFactory = new ClientFactory();

$client = $clientFactory->createClient(new ClientOptions(
    address: "http://localhost:666",
    apiKey: "5a50aaeb-698b-4c15-8561-337e92265232"
));

dump($client);
