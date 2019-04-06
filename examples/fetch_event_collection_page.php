<?php

require '../vendor/autoload.php';

$parameters = [
    'eventSlug' => 'bucharest-marathon',
];

$client = new \Sportic\Omniresult\Endu\EnduClient();
$resultsParser = $client->eventCollection($parameters);

/** @var \Sportic\Omniresult\Common\Models\Event $event */
$event   = $resultsParser->getContent()->getRecord();

var_dump($event);
var_dump($event->getParameter('editions'));
