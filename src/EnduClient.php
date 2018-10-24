<?php

namespace Sportic\Omniresult\Endu;

use Sportic\Omniresult\Common\RequestDetector\HasDetectorTrait;
use Sportic\Omniresult\Common\TimingClient;
use Sportic\Omniresult\Endu\Scrapers\EventCollectionPage;
use Sportic\Omniresult\Endu\Scrapers\EventPage;
use Sportic\Omniresult\Endu\Scrapers\ResultPage;
use Sportic\Omniresult\Endu\Scrapers\ResultsPage;

/**
 * Class EnduClient
 * @package Sportic\Omniresult\Trackmyrace
 */
class EnduClient extends TimingClient
{
    use HasDetectorTrait;

    /**
     * @param $parameters
     * @return \Sportic\Omniresult\Common\Parsers\AbstractParser|Parsers\EventPage
     */
    public function eventCollection($parameters)
    {
        return $this->executeScrapper(EventCollectionPage::class, $parameters);
    }

    /**
     * @param $parameters
     * @return \Sportic\Omniresult\Common\Parsers\AbstractParser|Parsers\EventPage
     */
    public function event($parameters)
    {
        return $this->executeScrapper(EventPage::class, $parameters);
    }

    /**
     * @param $parameters
     * @return \Sportic\Omniresult\Common\Parsers\AbstractParser|Parsers\ResultsPage
     */
    public function results($parameters)
    {
        return $this->executeScrapper(ResultsPage::class, $parameters);
    }

    /**
     * @param $parameters
     * @return \Sportic\Omniresult\Common\Parsers\AbstractParser|Parsers\ResultPage
     */
    public function result($parameters)
    {
        return $this->executeScrapper(ResultPage::class, $parameters);
    }
}
