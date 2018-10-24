<?php

namespace Sportic\Omniresult\Endu\Scrapers;

use Sportic\Omniresult\Endu\Helper;
use Sportic\Omniresult\Endu\Parsers\EventPage as Parser;

/**
 * Class CompanyPage
 * @package Sportic\Omniresult\Endu\Scrapers
 *
 * @method Parser execute()
 */
class ResultPage extends AbstractScraper
{
    /**
     * @return mixed
     */
    public function getEvent()
    {
        return $this->getParameter('event');
    }

    /**
     * @return mixed
     */
    public function getBib()
    {
        return $this->getParameter('bib');
    }

    /**
     * @inheritdoc
     */
    protected function generateCrawler()
    {
        $client = $this->getClient();
        $crawler = $client->request(
            'GET',
            $this->getCrawlerUri()
        );

        return $crawler;
    }

    /**
     * @return array
     */
    protected function generateParserData()
    {
        $this->getRequest();

        return [
            'response' => $this->getClient()->getResponse(),
        ];
    }

    /**
     * @return string
     */
    public function getCrawlerUri()
    {
        return $this->getApiUriHost()
            . '/events'
            . '/' . $this->getEvent()
            . '/result'
            . '/' . $this->getBib()
            . '/detail';
    }
}
