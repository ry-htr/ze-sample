<?php
/**
 *
 */
namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Monolog\Logger;

/**
 * Class TestMiddleware
 * @package App\Middleware
 */
class TestMiddleware
{
    /** @var Logger */
    private $logger;

    /**
     * TestMiddleware constructor.
     * @param Logger $logger
     */
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param callable|null $next
     * @return ResponseInterface
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next = null
    ) {
        $this->logger->addWarning('Foo', $request->getAttributes());

        if ($next) {
            $this->logger->addError('Bar', ['foo' => 'bar']);
            $response = $next($request, $response);
        }
        return $response;
    }
}
