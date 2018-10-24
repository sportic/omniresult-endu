<?php

namespace Sportic\Omniresult\Endu\Tests\Parsers;

use Sportic\Omniresult\Common\Models\Race;
use Sportic\Omniresult\Common\Models\Result;
use Sportic\Omniresult\Common\Models\Split;
use Sportic\Omniresult\Endu\Scrapers\ResultPage as PageScraper;
use Sportic\Omniresult\Endu\Parsers\ResultPage as PageParser;

/**
 * Class EventPageTest
 * @package Sportic\Omniresult\Endu\Tests\Scrapers
 */
class ResultPageTest extends AbstractPageTest
{
    public function testGenerateContentRaces()
    {
        $parametersParsed = static::initParserFromFixturesJson(
            new PageParser(),
            (new PageScraper()),
            'ResultPage/SimpleEvent/page'
        );

        /** @var Result $result */
        $result = $parametersParsed->getRecord();
        self::assertInstanceOf(Result::class, $result);
        self::assertSame('MAXIM', $result->getFirstName());
        self::assertSame('RĂILEANU', $result->getLastName());
        self::assertSame('male', $result->getGender());

        self::assertCount(8, $result->getSplits());

        /** @var Split $split */
        $split = $result->getSplits()->get(3);
        self::assertInstanceOf(Split::class, $split);

        self::assertSame('SPLIT4 Elizabeta blv', $split->getName());
        self::assertSame('0:20:18', $split->getTime());
    }
}
