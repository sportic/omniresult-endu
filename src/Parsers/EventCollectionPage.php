<?php

namespace Sportic\Omniresult\Endu\Parsers;

use Sportic\Omniresult\Common\Content\RecordContent;
use Sportic\Omniresult\Common\Models\Event;
use Sportic\Omniresult\Common\Models\Race;

/**
 * Class EventCollectionPage
 * @package Sportic\Omniresult\Endu\Parsers
 */
class EventCollectionPage extends AbstractParser
{
    protected $returnContent = [];

    /**
     * @return array
     */
    protected function generateContent()
    {
        $configArray = $this->getConfigArray();

        $eventParams['id'] = $configArray['event']['id'];
        $eventParams['name'] = $configArray['event']['alabel'];
        $eventParams['editions'] = $configArray['event']['editions'];
        $params = [
            'record' => new Event($eventParams)
        ];
        return $params;
    }

    /**
     * @return array
     */
    protected function getConfigArray()
    {
        $configHtml = $this->getConfigString();
        $configHtml = $this->prepareConfigString($configHtml);

        $data = json_decode($configHtml, true);
        return $data;
    }

    /**
     * @param $configString
     * @return string
     */
    protected function prepareConfigString($configString)
    {
        $trans = [
            "'en'" => '"en"',
            "''" => '""',
            "'https://" => '"https://',
            ".net'" => '.net"'
        ];
        $fields = [
            'lang',
            'account',
            'athlete',
            'card',
            'event',
            'api',
            'api_keys',
            'ws',
            'policies',
            'relation',
            'system_lang',
            'www',
            'login',
            'images'
        ];
        foreach ($fields as $field) {
            $trans[' ' . $field . ':'] = ' "' . $field . '":';
        }
        $configString = strtr($configString, $trans);
        return $configString;
    }

    protected function getConfigString()
    {
        $html = $this->getCrawler()->html();
        $posConfig = strpos($html, 'global.CONFIG = {');
        $configHtml = substr($html, $posConfig + 15);
        $posEndConfig = strpos($configHtml, '};');
        return substr($configHtml, 0, $posEndConfig + 1);
    }

    /** @noinspection PhpMissingParentCallCommonInspection
     * @inheritdoc
     */
    protected function getContentClassName()
    {
        return RecordContent::class;
    }

    /** @noinspection PhpMissingParentCallCommonInspection
     * @inheritdoc
     */
    public function getModelClassName()
    {
        return Event::class;
    }
}
