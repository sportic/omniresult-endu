<?php

namespace Sportic\Omniresult\Endu\Parsers;

use Sportic\Omniresult\Common\Content\ListContent;
use Sportic\Omniresult\Common\Models\Result;
use Sportic\Omniresult\Endu\Helper;

/**
 * Class ResultsPage
 * @package Sportic\Omniresult\Endu\Parsers
 */
class ResultsPage extends AbstractParser
{

    /**
     * @return array
     */
    protected function generateContent()
    {
        $configArray = $this->getConfigArray();
        $results = $this->parseResults($configArray);

        $params = [
            'records' => $results
        ];
        return $params;
    }

    /**
     * @param $config
     * @return array
     */
    protected function parseResults($config)
    {
        $itemArray = $config['rows'];
        $return = [];
        foreach ($itemArray as $itemArray) {
            $return[] = $this->parseResult($itemArray);
        }
        return $return;
    }

    /**
     * @param $config
     * @return Result
     */
    protected function parseResult($config)
    {
        $matches = [
            'posGen' => 'pa',
            'id' => 'bi',
            'bib' => 'bi',
            'full_name' => 'nm',
            'first_name' => 'nn',
            'last_name' => 'nc',
            'gender' => 'sx',
            'country' => 'nz',
            'category' => 'ca',
            'time_gross' => 'tu',
            'time' => 'tr',
        ];

        $parameters = [];
        foreach ($matches as $field => $key) {
            if (isset($config[$key])) {
                $parameters[$field] = $config[$key];
            }
        }
        $parameters['id'] = $this->getParameter('event') . Helper::slugsSeparator() . $parameters['id'];
        $result = new Result($parameters);
        return $result;
    }

    /**
     * @return array
     */
    protected function getConfigArray()
    {
        $configHtml = $this->getConfigString();

        $data = json_decode($configHtml, true);
        return $data;
    }

    /**
     * @return mixed|string
     */
    protected function getConfigString()
    {
        $string = $this->getResponse()->getContent();
        $string = str_replace('jgrid(', '', $string);
        $string = str_replace(');', '', $string);

        return $string;
    }

    /** @noinspection PhpMissingParentCallCommonInspection
     * @inheritdoc
     */
    protected function getContentClassName()
    {
        return ListContent::class;
    }

    /** @noinspection PhpMissingParentCallCommonInspection
     * @inheritdoc
     */
    public function getModelClassName()
    {
        return Result::class;
    }
}
