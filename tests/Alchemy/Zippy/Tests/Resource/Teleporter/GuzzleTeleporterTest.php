<?php

namespace Alchemy\Zippy\Tests\Resource\Teleporter;

use Alchemy\Zippy\Resource\Teleporter\GuzzleTeleporter;
use Alchemy\Zippy\Resource\Resource;

class GuzzleTeleporterTest extends TeleporterTestCase
{
    /**
     * @covers Alchemy\Zippy\Resource\Teleporter\GuzzleTeleporter::teleport
     * @dataProvider provideContexts
     */
    public function testTeleport($context)
    {
        if (false === class_exists('Guzzle\Http\Client')) {
            $this->markTestSkipped('Guzzle library is not installed');
        }

        $teleporter = GuzzleTeleporter::create();

        $target = 'plop-badge.png';
        $resource = new Resource('http://www.google.com/+/business/images/plus-badge.png', $target);

        if (is_file($target)) {
            unlink($context . '/' . $target);
        }

        $teleporter->teleport($resource, $context);

        $this->assertfileExists($context . '/' . $target);
        unlink($context . '/' . $target);
    }

    /**
     * @covers Alchemy\Zippy\Resource\Teleporter\GuzzleTeleporter::create
     */
    public function testCreate()
    {
        if (false === class_exists('Guzzle\Http\Client')) {
            $this->markTestSkipped('Guzzle library is not installed');
        }

        $this->assertInstanceOf('Alchemy\Zippy\Resource\Teleporter\GuzzleTeleporter', GuzzleTeleporter::create());
    }
}
