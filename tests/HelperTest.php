<?php

namespace Sportic\Omniresult\Endu\Tests;

use Sportic\Omniresult\Endu\Helper;
use Sportic\Omniresult\Endu\RequestDetector;

/**
 * Class HelperTest
 * @package Sportic\Omniresult\Endu\Tests
 */
class HelperTest extends AbstractTest
{
    /**
     * @param $id
     * @param $path
     * @dataProvider eventPathProvider
     */
    public function testEventPath($id, $path)
    {
        $pathComputed = Helper::generateEventPath($id);

        self::assertSame($path, $pathComputed);
    }

    /**
     * @return array
     */
    public function eventPathProvider()
    {
        return [
            ['42143', '/00000000/00040000/00042100/00042143/'],
            ['31676', '/00000000/00030000/00031600/00031676/'],
            ['29913', '/00000000/00020000/00029900/00029913/'],
        ];
    }
}
