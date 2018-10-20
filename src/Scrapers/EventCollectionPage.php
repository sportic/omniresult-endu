<?php

namespace Sportic\Omniresult\Endu\Scrapers;

use Sportic\Omniresult\Endu\Parsers\EventCollectionPage as Parser;

/**
 * Class EventCollectionPage
 * @package Sportic\Omniresult\Endu\Scrapers
 *
 * @method Parser execute()
 */
class EventCollectionPage extends AbstractScraper
{
    /**
     * @return mixed
     */
    public function getEventSlug()
    {
        return $this->getParameter('eventSlug');
    }

    /**
     * @throws \Sportic\Omniresult\Common\Exception\InvalidRequestException
     */
    protected function doCallValidation()
    {
        $this->validate('eventSlug');
    }

    /**
     * @inheritdoc
     */
    protected function generateCrawler()
    {
        $client  = $this->getClient();
        $crawler = $client->request(
            'GET',
            $this->getCrawlerUri()
        );

        return $crawler;
    }

    /**
     * @return string
     */
    public function getCrawlerUri()
    {
        return $this->getCrawlerUriHost().'/events'
               . '/' . $this->getEventSlug()
               . '/';
    }
}
