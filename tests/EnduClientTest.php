<?php

namespace Sportic\Omniresult\Endu\Tests;

/**
 * Class EnduClientTest
 * @package Sportic\Omniresult\Endu\Tests
 */
class EnduClientTest extends AbstractTest
{
    /**
     * @param $slug
     * @param $eventName
     * @dataProvider eventCollectionData
     */
    public function testEventCollection($slug, $eventName)
    {
        $parameters = [
            'eventSlug' => $slug,
        ];
        $client = new \Sportic\Omniresult\Endu\EnduClient();
        $resultsParser = $client->eventCollection($parameters);

        /** @var \Sportic\Omniresult\Common\Models\Event $event */
        $event   = $resultsParser->getContent()->getRecord();
        self::assertSame($eventName, $event->getName());
    }

    /**
     * @return array
     */
    public function eventCollectionData()
    {
        return [
            ['uniqa-bucharest-10k','Uniqa Bucharest 10k & Family Run'],
        ];
    }
}
