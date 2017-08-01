<?php

require_once 'vendor/autoload.php';
require_once 'vendor/triagens/arangodb/autoload.php';

use Slim\App;
use Slim\Container;
use Symfony\Component\Yaml\Yaml;
use App\Providers\Arango\ArangoConnectionProvider;

/**
 * Dependencies container
 */
$container = new Container();

/**
 * Load application configurations
 */
$configurations = Yaml::parse(file_get_contents("app.yml"));
$container["config"] = $configurations;


/**
 * Register application providers
 */
ArangoConnectionProvider::register($container);

$app = new App($container);

/**
 * Load application routes
 */
require 'routes.php';

return $app;