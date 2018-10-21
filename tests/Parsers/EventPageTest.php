<?php

namespace Sportic\Omniresult\Endu\Tests\Parsers;

use Sportic\Omniresult\Common\Models\Race;
use Sportic\Omniresult\Endu\Scrapers\EventPage as PageScraper;
use Sportic\Omniresult\Endu\Parsers\EventPage as PageParser;

/**
 * Class EventPageTest
 * @package Sportic\Omniresult\Endu\Tests\Scrapers
 */
class EventPageTest extends AbstractPageTest
{
    public function testGenerateContentRaces()
    {
        $parametersParsed = static::initParserFromFixturesJsonp(
            new PageParser(),
            (new PageScraper()),
            'EventPage/SimpleEvent/event_page'
        );

        $races = $parametersParsed->getRecords();
        self::assertCount(5, $races);

        /** @var Race $firstRace */
        $firstRace = $races[0];
        self::assertInstanceOf(Race::class, $firstRace);

        self::assertSame('27587', $firstRace->getId());
        self::assertSame('Marathon', $firstRace->getName());
        self::assertSame('204927_99PQGBZQWO.jsonp', $firstRace->getParameter('endpoint'));
    }
}
