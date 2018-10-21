<?php

namespace Sportic\Omniresult\Endu\Tests\Scrapers;

use PHPUnit\Framework\TestCase;
use Sportic\Omniresult\Endu\Scrapers\EventCollectionPage as PageScraper;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class EventPageTest
 * @package Sportic\Omniresult\Endu\Tests\Scrapers
 */
class EventCollectionPageTest extends TestCase
{
    public function testGetCrawlerUri()
    {
        $crawler = $this->getCrawler();

        static::assertInstanceOf(Crawler::class, $crawler);

        static::assertSame(
            'https://www.endu.net/en/events/bucharest-marathon/',
            $crawler->getUri()
        );
    }

    public function testGetCrawlerHtml()
    {
        $crawler = $this->getCrawler();

        static::assertInstanceOf(Crawler::class, $crawler);

        $html =  $crawler->html();

        static::assertContains('Bucharest Marathon', $html);
        static::assertContains('RESULTS', $html);
        static::assertContains('global.CONFIG = {', $html);

//        file_put_contents(TEST_FIXTURE_PATH . '/Parsers/EventCollectionPage/SimpleEvent/event_page.html', $crawler->html());
    }

    /**
     * @return Crawler
     */
    protected function getCrawler()
    {
        $params = ['eventSlug' => 'bucharest-marathon'];
        $scraper = new PageScraper();
        $scraper->initialize($params);
        return $scraper->getCrawler();
    }
}
