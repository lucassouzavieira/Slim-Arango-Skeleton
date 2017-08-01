<?php

namespace App\Core\Contracts\Providers;

use Slim\Container;

/**
 * Interface for Providers classes
 *
 * @package App\Providers\Contracts
 * @since 1.0
 * @author Lucas S. Vieira
 */
interface ProviderInterface
{
    public static function register(Container $container) : void;
}