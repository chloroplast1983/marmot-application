<?php
namespace Marmot\Application;

use Marmot\Framework\Application\IApplication;

class Application implements IApplication
{
    public function getIndexRoute() : array
    {
        return ['GET', '/', ['Marmot\Application\Home\Controller\IndexController','index']];
    }

    public function getRouteRules() : array
    {
        return include 'routeRules.php';
    }

    public function initErrorConfig() : void
    {
        include 'errorConfig.php';
    }

    public function getErrorDescriptions() : array
    {
        return include 'errorDescriptionConfig.php';
    }

    public function initConfig() : void
    {
        include 'config.php';
    }
}
