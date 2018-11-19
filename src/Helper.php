<?php

namespace Sportic\Omniresult\Endu;

/**
 * Class Helper
 * @package Sportic\Omniresult\Trackmyrace
 */
class Helper extends \Sportic\Omniresult\Common\Helper
{

    /**
     * @return array
     */
    public static function getLanguages()
    {
        return ['de', 'fr', 'it', 'en', 'ro'];
    }

    /**
     * @param $id
     * @return string
     */
    public static function generateEventPath($id)
    {
        $precisions = [8, 4, 2, 0];
        $parts = [];
        foreach ($precisions as $precision) {
            $multiplier = pow(10, abs($precision));
            $part = floor($id / $multiplier) * $multiplier;
            $parts[] = str_pad($part, 8, '0', STR_PAD_LEFT);
        }
        return '/' . implode('/', $parts) . '/';
    }

    /**
     * @return string
     */
    public static function slugsSeparator()
    {
        return '::';
    }
}
