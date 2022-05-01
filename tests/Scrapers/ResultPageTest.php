<?php

namespace Sportic\Omniresult\Endu\Tests\Scrapers;

use PHPUnit\Framework\TestCase;
use Sportic\Omniresult\Endu\Scrapers\ResultPage;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class ResultPageTest
 * @package Sportic\Omniresult\Endu\Tests\Scrapers
 */
class ResultPageTest extends TestCase
{

    public function testInitFromIdParam()
    {
        $scraper = new ResultPage();
        $scraper->initialize(['uid' => '42143::W24']);

        self::assertSame('42143', $scraper->getEvent());
        self::assertSame('W24', $scraper->getBib());
    }

    public function testGetCrawlerUri()
    {
        $scraper = $this->getScraper();
        $crawler = $scraper->getCrawler();

        static::assertInstanceOf(Crawler::class, $crawler);

        static::assertSame(
            'https://apiah-staging.endu.net/events/42143/result/5334/detail',
            $crawler->getUri()
        );
    }

    public function testGetCrawlerHtml()
    {
        $scraper = $this->getScraper();
        $crawler = $scraper->getCrawler();

        static::assertInstanceOf(Crawler::class, $crawler);

        $response = $scraper->getClient()->getResponse();
        $responseContent = $response->getContent();
        static::assertStringContainsString('Half Marathon', $responseContent);
        static::assertStringContainsString('21.1 km', $responseContent);
//        file_put_contents(TEST_FIXTURE_PATH . '/Parsers/ResultPage/SimpleEvent/page.json', $responseContent);
    }

    /**
     * @return ResultPage
     */
    protected function getScraper()
    {
        $params = [
            'event' => '42143',
            'bib' => '5334',
        ];
        $scraper = new ResultPage();
        $scraper->initialize($params);
        return $scraper;
    }
}
