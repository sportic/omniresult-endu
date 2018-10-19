<?php

namespace Sportic\Omniresult\Endu\Tests;

use Sportic\Omniresult\Endu\RequestDetector;

/**
 * Class RequestDetectorTest
 * @package Sportic\Omniresult\Endu\Tests
 */
class RequestDetectorTest extends AbstractTest
{
    /**
     * @param $url
     * @param $valid
     * @param $action
     * @param $params
     * @dataProvider detectProvider
     */
    public function testDetect($url, $valid, $action, $params)
    {
        $result = RequestDetector::detect($url);

        self::assertSame($valid, $result->isValid());
        self::assertSame($action, $result->getAction());
        self::assertSame($params, $result->getParams());
    }

    /**
     * @return array
     */
    public function detectProvider()
    {
        return [
            [
                'https://www.endu.net/en/events/bucharest-marathon/',
                true,
                'event',
                ['eventSlug' => 'bucharest-marathon']
            ],
            [
                'https://www.endu.net/en/events/bucharest-marathon/results',
                true,
                'results',
                ['eventSlug' => 'bucharest-marathon']
            ]
        ];
    }
}
