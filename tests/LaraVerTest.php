<?php

namespace SergiX44\LaraVer\Tests;

use Orchestra\Testbench\TestCase;
use SergiX44\LaraVer\LaraVer;

/**
 * Class LaraVerTest
 * @package SergiX44\LaraVer\Tests
 */
class LaraVerTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @param $uri
     * @param $number
     * @dataProvider providesUri
     */
    public function testExtractTheRightVersionNumber($uri, $number)
    {
        $n = LaraVer::parseVersion($uri);
        self::assertSame($number, $n);
    }

    /**
     * @return array[]
     */
    public function providesUri()
    {
        return [
            [
                'uri' => '/api/v2/users/list',
                'number' => 2,
            ], [
                'uri' => '/api/v1/',
                'number' => 1,
            ], [
                'uri' => '/v1023/',
                'number' => 1023,
            ],
        ];
    }
}
