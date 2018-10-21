<?php

namespace Sportic\Omniresult\Endu\Tests\Parsers;

use Sportic\Omniresult\Common\Models\Event;
use Sportic\Omniresult\Endu\Scrapers\EventCollectionPage as PageScraper;
use Sportic\Omniresult\Endu\Parsers\EventCollectionPage as PageParser;

/**
 * Class EventCollectionPageTest
 * @package Sportic\Omniresult\Endu\Tests\Scrapers
 */
class EventCollectionPageTest extends AbstractPageTest
{
    public function testGenerateContentRaces()
    {
        $parametersParsed = static::initParserFromFixtures(
            new PageParser(),
            (new PageScraper()),
            'EventCollectionPage/SimpleEvent/event_page'
        );

        $event = $parametersParsed->getRecord();
        self::assertInstanceOf(Event::class, $event);
    }
}
