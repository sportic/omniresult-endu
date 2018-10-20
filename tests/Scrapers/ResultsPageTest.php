<?php

namespace Sportic\Omniresult\Endu\Tests\Scrapers;

use PHPUnit\Framework\TestCase;
use Sportic\Omniresult\Endu\Scrapers\ResultsPage;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class ResultsPageTest
 * @package Sportic\Omniresult\Endu\Tests\Scrapers
 */
class ResultsPageTest extends TestCase
{
    public function testGetCrawlerUri()
    {
        $scraper = $this->getScraper();
        $crawler = $scraper->getCrawler();

        static::assertInstanceOf(Crawler::class, $crawler);

        static::assertSame(
            'https://ecs-eventi.s3.amazonaws.com/00000000/00040000/00042100/00042143/results/results-b8d7f265a7bb24df4b8fbc4a9ce1cf7a.jsonp',
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
        static::assertContains('Marathon', $responseContent);
//        file_put_contents(TEST_FIXTURE_PATH . '/Parsers/ResultsPage/SimpleEvent/event_page.jsonp', $responseContent);
    }

    /**
     * @return ResultsPage
     */
    protected function getScraper()
    {
        $params = [
            's3_path' => 'https://ecs-eventi.s3.amazonaws.com/00000000/00040000/00042100/00042143/',
            'hash' => 'b8d7f265a7bb24df4b8fbc4a9ce1cf7a',
        ];
        $scraper = new ResultsPage();
        $scraper->initialize($params);
        return $scraper;
    }
}
