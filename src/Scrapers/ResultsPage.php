<?php

namespace Sportic\Omniresult\Endu\Scrapers;

use Sportic\Omniresult\Endu\Parsers\EventPage as Parser;

/**
 * Class CompanyPage
 * @package Sportic\Omniresult\Endu\Scrapers
 *
 * @method Parser execute()
 */
class ResultsPage extends AbstractScraper
{
    /**
     * @return mixed
     */
    public function getS3Path()
    {
        return $this->getParameter('s3_path');
    }

    /**
     * @return mixed
     */
    public function getHash()
    {
        return $this->getParameter('hash');
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
        $response = $client->getResponse();

        return $crawler;
    }

    /**
     * @return string
     */
    public function getCrawlerUri()
    {
        return $this->getS3Path()
            . 'results/results-'
            . $this->getHash()
            . '.jsonp';
    }
}
