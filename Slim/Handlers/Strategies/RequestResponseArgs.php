<?php

/**
 * Slim Framework (https://slimframework.com)
 *
 * @license https://github.com/slimphp/Slim/blob/4.x/LICENSE.md (MIT License)
 */

declare(strict_types=1);

namespace Slim\Handlers\Strategies;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Interfaces\InvocationStrategyInterface;

use function array_values;

/**
 * Route callback strategy with routes parameters as individual arguments.
 */
class RequestResponseArgs implements InvocationStrategyInterface
{
    /**
     * Invoke a routes callable with request, response and all routes parameters
     * as individual arguments.
     *
     * @param callable               $callable
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param array<mixed>           $routeArguments
     *
     * @return ResponseInterface
     */
    public function __invoke(
        callable $callable,
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $routeArguments
    ): ResponseInterface {
        return $callable($request, $response, ...array_values($routeArguments));
    }
}
