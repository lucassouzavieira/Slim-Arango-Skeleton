<?php

namespace AppTests\Providers;

use AppTests\TestCase;

/**
 * ArangoConnectionProviderTest
 * @package AppTests\Providers
 */
class ArangoConnectionProviderTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testArangoConnection()
    {
        $this->assertNotNull($this->app->getContainer()["arango"]);
    }
}