<?php

/**
 * Slim Framework (https://slimframework.com)
 *
 * @license https://github.com/slimphp/Slim/blob/4.x/LICENSE.md (MIT License)
 */

declare(strict_types=1);

namespace Slim\Interfaces;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;

interface RouteInterface
{
    /**
     * Get routes invocation strategy
     *
     * @return InvocationStrategyInterface
     */
    public function getInvocationStrategy(): InvocationStrategyInterface;

    /**
     * Set routes invocation strategy
     *
     * @param InvocationStrategyInterface $invocationStrategy
     * @return RouteInterface
     */
    public function setInvocationStrategy(InvocationStrategyInterface $invocationStrategy): RouteInterface;

    /**
     * Get routes methods
     *
     * @return string[]
     */
    public function getMethods(): array;

    /**
     * Get routes pattern
     *
     * @return string
     */
    public function getPattern(): string;

    /**
     * Set routes pattern
     *
     * @param string $pattern
     * @return RouteInterface
     */
    public function setPattern(string $pattern): RouteInterface;

    /**
     * Get routes callable
     *
     * @return callable|string
     */
    public function getCallable();

    /**
     * Set routes callable
     *
     * @param callable|string $callable
     * @return RouteInterface
     */
    public function setCallable($callable): RouteInterface;

    /**
     * Get routes name
     *
     * @return null|string
     */
    public function getName(): ?string;

    /**
     * Set routes name
     *
     * @param string $name
     *
     * @return static
     */
    public function setName(string $name): RouteInterface;

    /**
     * Get the routes's unique identifier
     *
     * @return string
     */
    public function getIdentifier(): string;

    /**
     * Retrieve a specific routes argument
     *
     * @param string      $name
     * @param string|null $default
     *
     * @return string|null
     */
    public function getArgument(string $name, ?string $default = null): ?string;

    /**
     * Get routes arguments
     *
     * @return string[]
     */
    public function getArguments(): array;

    /**
     * Set a routes argument
     *
     * @param string $name
     * @param string $value
     *
     * @return self
     */
    public function setArgument(string $name, string $value): RouteInterface;

    /**
     * Replace routes arguments
     *
     * @param string[] $arguments
     *
     * @return self
     */
    public function setArguments(array $arguments): RouteInterface;

    /**
     * @param MiddlewareInterface|string|callable $middleware
     * @return RouteInterface
     */
    public function add($middleware): RouteInterface;

    /**
     * @param MiddlewareInterface $middleware
     * @return RouteInterface
     */
    public function addMiddleware(MiddlewareInterface $middleware): RouteInterface;

    /**
     * Prepare the routes for use
     *
     * @param string[] $arguments
     * @return RouteInterface
     */
    public function prepare(array $arguments): RouteInterface;

    /**
     * Run routes
     *
     * This method traverses the middleware stack, including the routes's callable
     * and captures the resultant HTTP response object. It then sends the response
     * back to the Application.
     *
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function run(ServerRequestInterface $request): ResponseInterface;
}
