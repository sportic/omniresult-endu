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
class ResultsPage extends AbstractScraper
{
    /**
     * @return mixed
     */
    public function getS3Path()
    {
        if (!$this->hasParameter('s3_path')) {
            $this->initS3Path();
        }
        return $this->getParameter('s3_path');
    }

    protected function initS3Path()
    {
        $idEvent = $this->getParameter('event');
        $this->setParameter('s3_path', Helper::generateEventPath($idEvent));
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

        return $crawler;
    }

    /**
     * @return array
     */
    protected function generateParserData()
    {
        $this->getRequest();

        return [
            'event' => $this->getParameter('event'),
            'response' => $this->getClient()->getResponse(),
        ];
    }

    /**
     * @return string
     */
    public function getCrawlerUri()
    {
        return $this->getAmazonS3Host()
            . $this->getS3Path()
            . 'results/jsonp/'
            . $this->getHash();
    }
}
