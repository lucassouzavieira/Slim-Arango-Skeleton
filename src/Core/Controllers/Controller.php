<?php

namespace App\Core\Controllers;

use Slim\Container;

/**
 * Basic controller class
 *
 * @package App\Core\Controllers
 * @since 1.0
 * @author Lucas S. Vieira
 */
abstract class Controller
{
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }
}