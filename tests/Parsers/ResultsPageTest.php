<?php

namespace Sportic\Omniresult\Endu\Tests\Parsers;

use Sportic\Omniresult\Common\Models\Result;
use Sportic\Omniresult\Endu\Scrapers\ResultsPage as PageScraper;
use Sportic\Omniresult\Endu\Parsers\ResultsPage as PageParser;

/**
 * Class ResultsPageTest
 * @package Sportic\Omniresult\Endu\Tests\Scrapers
 */
class ResultsPageTest extends AbstractPageTest
{
    public function testGenerateContentRaces()
    {
        $parser = new PageParser();
        $parser->setParameter('event', 42143);
        $parametersParsed = static::initParserFromFixturesJsonp(
            $parser,
            (new PageScraper()),
            'ResultsPage/SimpleEvent/event_page'
        );

        $results = $parametersParsed->getRecords();
        self::assertCount(1048, $results);

        /** @var Result $firstResult */
        $firstResult = $results[0];
        self::assertInstanceOf(Result::class, $firstResult);

        self::assertSame('42143::5', $firstResult->getId());
        self::assertSame('1', $firstResult->getPosGen());
        self::assertSame('KIPKEMBOI HOSEA', $firstResult->getFullName());
        self::assertSame('2:11:31', $firstResult->getTime());
        self::assertSame('TOP', $firstResult->getCategory());
    }
}
