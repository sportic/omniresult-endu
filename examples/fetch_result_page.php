<?php

require '../vendor/autoload.php';

$parameters = [
    'event' => '42143',
    'bib' => '5334',
];

$client = new \Sportic\Omniresult\Endu\EnduClient();
$resultsParser = $client->result($parameters);

/** @var \Sportic\Omniresult\Common\Content\RecordContent $data */
$data = $resultsParser->getContent();

var_dump($data->getRecord());
