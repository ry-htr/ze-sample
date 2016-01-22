<?php
/**
 *
 */
namespace App\Middleware;

use Interop\Container\ContainerInterface;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * Class TestFactory
 * @package App\Middleware
 */
class TestFactory
{
    /**
     * @param ContainerInterface $container
     * @return TestMiddleware
     */
    public function __invoke(ContainerInterface $container)
    {
        return new TestMiddleware(
            (new Logger('my-app'))->pushHandler(new StreamHandler('./data/logs/debug.log', Logger::DEBUG))
        );
    }
}
