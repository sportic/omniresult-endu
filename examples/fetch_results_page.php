<?php

require '../vendor/autoload.php';

$parameters = [
    'event' => '42143',
    'hash' => '204951_8J4747PGC0.jsonp',
];

$client = new \Sportic\Omniresult\Endu\EnduClient();
$resultsParser = $client->results($parameters);

/** @var \Sportic\Omniresult\Common\Content\ListContent $data */
$data = $resultsParser->getContent();

var_dump($data->getRecords());
