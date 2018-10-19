<?php

namespace Sportic\Omniresult\Trackmyrace;

use Sportic\Omniresult\Common\RequestDetector\HasDetectorTrait;
use Sportic\Omniresult\Common\TimingClient;
use Sportic\Omniresult\Trackmyrace\Scrapers\ResultPage;
use Sportic\Omniresult\Trackmyrace\Scrapers\ResultsPage;

/**
 * Class TrackmyraceClient
 * @package Sportic\Omniresult\Trackmyrace
 */
class TrackmyraceClient extends TimingClient
{
    use HasDetectorTrait;

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
