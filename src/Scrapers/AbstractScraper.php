<?php

namespace Sportic\Omniresult\Endu\Scrapers;

use ByTIC\GouttePhantomJs\Clients\ClientFactory;
use Goutte\Client;

/**
 * Class AbstractScraper
 * @package Sportic\Omniresult\Endu\Scrapers
 */
abstract class AbstractScraper extends \Sportic\Omniresult\Common\Scrapers\AbstractScraper
{
    /** @noinspection PhpMissingParentCallCommonInspection
     * @return Client
     */
    protected function generateClient()
    {
        return ClientFactory::getGoutteClient();
    }

    /**
     * @return string
     */
    abstract public function getCrawlerUri();

    /**
     * @return string
     */
    protected function getCrawlerUriHost()
    {
        return 'https://www.endu.net/en';
    }

    /**
     * @return string
     */
    protected function getApiUriHost()
    {
        return 'https://apiah-staging.endu.net';
    }

    /**
     * @return string
     */
    protected function getAmazonS3Host()
    {
        return 'https://ecs-eventi.s3.amazonaws.com';
    }
}
