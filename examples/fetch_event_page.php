<?php

require '../vendor/autoload.php';

$parameters = [
    's3_path' => 'https://ecs-eventi.s3.amazonaws.com/00000000/00040000/00042100/00042143/',
    'hash' => 'b8d7f265a7bb24df4b8fbc4a9ce1cf7a',
];

$client = new \Sportic\Omniresult\Endu\EnduClient();
$resultsParser = $client->results($parameters);
/** @var \Sportic\Omniresult\Common\Models\Event $event */
$data   = $resultsParser->getContent();

var_dump($data);
