<?php

namespace Sportic\Omniresult\Endu;

use Sportic\Omniresult\Common\RequestDetector\AbstractRequestDetector;

/**
 * Class RequestDetector
 * @package Sportic\Omniresult\Trackmyrace
 */
class RequestDetector extends AbstractRequestDetector
{
    protected $pathParts = null;

    /**
     * @inheritdoc
     */
    protected function isValidRequest()
    {
        if (in_array(
            $this->getUrlComponent('host'),
            ['www.endu.net', 'endu.net']
        )) {
            return true;
        }
        return parent::isValidRequest();
    }

    /**
     * @return string
     */
    protected function detectAction()
    {
        $pathParts = $this->getPathParts();

        if ($pathParts[1] != 'events') {
            return '';
        }
        if (count($pathParts) == 3) {
            return 'event';
        }
        if (count($pathParts) == 4) {
            if ($pathParts[3] == 'results') {
                return 'results';
            }
        }
        return '';
    }

    /**
     * @inheritdoc
     */
    protected function detectParams()
    {
        $pathParts = $this->getPathParts();

        $return = [];
        $return['eventSlug'] = $pathParts[2];

        return $return;
    }

    /**
     * @return array
     */
    public function getPathParts(): array
    {
        if ($this->pathParts === null) {
            $this->detectUrlPathParts();
        }
        return $this->pathParts;
    }

    protected function detectUrlPathParts()
    {
        $path = strtolower($this->getUrlComponent('path'));
        $path = trim($path, '/');
        $this->pathParts = explode('/', $path);
    }
}
