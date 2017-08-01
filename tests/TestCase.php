<?php

namespace AppTests;

use PHPUnit\Framework\TestCase as BaseTestCase;

/**
 * Base test class for application
 *
 * @abstract
 * @since 1.0
 * @author Lucas S. Vieira
 */
abstract class TestCase extends BaseTestCase
{
    protected $app;

    /**
     * Set up app for tests
     */
    public function setUp()
    {
        $this->app = $this->createApplication();
    }

    /**
     * Create an application instance for tests
     *
     * @return Slim\App
     */
    public function createApplication()
    {
        return require dirname(__DIR__) . DIRECTORY_SEPARATOR . "bootstrap.php";
    }
}