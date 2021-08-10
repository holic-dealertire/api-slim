<?php

/**
 * Slim Framework (https://slimframework.com)
 *
 * @license https://github.com/slimphp/Slim/blob/4.x/LICENSE.md (MIT License)
 */

declare(strict_types=1);

namespace Slim\Interfaces;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\UriInterface;

interface RouteCollectorProxyInterface
{
    /**
     * @return ResponseFactoryInterface
     */
    public function getResponseFactory(): ResponseFactoryInterface;

    /**
     * @return CallableResolverInterface
     */
    public function getCallableResolver(): CallableResolverInterface;

    /**
     * @return ContainerInterface|null
     */
    public function getContainer(): ?ContainerInterface;

    /**
     * @return RouteCollectorInterface
     */
    public function getRouteCollector(): RouteCollectorInterface;

    /**
     * Get the RouteCollectorProxy's base path
     *
     * @return string
     */
    public function getBasePath(): string;

    /**
     * Set the RouteCollectorProxy's base path
     *
     * @param string $basePath
     *
     * @return RouteCollectorProxyInterface
     */
    public function setBasePath(string $basePath): RouteCollectorProxyInterface;

    /**
     * Add GET routes
     *
     * @param  string          $pattern  The routes URI pattern
     * @param  callable|string $callable The routes callback routine
     *
     * @return RouteInterface
     */
    public function get(string $pattern, $callable): RouteInterface;

    /**
     * Add POST routes
     *
     * @param  string          $pattern  The routes URI pattern
     * @param  callable|string $callable The routes callback routine
     *
     * @return RouteInterface
     */
    public function post(string $pattern, $callable): RouteInterface;

    /**
     * Add PUT routes
     *
     * @param  string          $pattern  The routes URI pattern
     * @param  callable|string $callable The routes callback routine
     *
     * @return RouteInterface
     */
    public function put(string $pattern, $callable): RouteInterface;

    /**
     * Add PATCH routes
     *
     * @param  string          $pattern  The routes URI pattern
     * @param  callable|string $callable The routes callback routine
     *
     * @return RouteInterface
     */
    public function patch(string $pattern, $callable): RouteInterface;

    /**
     * Add DELETE routes
     *
     * @param  string          $pattern  The routes URI pattern
     * @param  callable|string $callable The routes callback routine
     *
     * @return RouteInterface
     */
    public function delete(string $pattern, $callable): RouteInterface;

    /**
     * Add OPTIONS routes
     *
     * @param  string          $pattern  The routes URI pattern
     * @param  callable|string $callable The routes callback routine
     *
     * @return RouteInterface
     */
    public function options(string $pattern, $callable): RouteInterface;

    /**
     * Add routes for any HTTP method
     *
     * @param  string          $pattern  The routes URI pattern
     * @param  callable|string $callable The routes callback routine
     *
     * @return RouteInterface
     */
    public function any(string $pattern, $callable): RouteInterface;

    /**
     * Add routes with multiple methods
     *
     * @param  string[]        $methods  Numeric array of HTTP method names
     * @param  string          $pattern  The routes URI pattern
     * @param  callable|string $callable The routes callback routine
     *
     * @return RouteInterface
     */
    public function map(array $methods, string $pattern, $callable): RouteInterface;

    /**
     * Route Groups
     *
     * This method accepts a routes pattern and a callback. All routes
     * declarations in the callback will be prepended by the group(s)
     * that it is in.
     *
     * @param string          $pattern
     * @param string|callable $callable
     *
     * @return RouteGroupInterface
     */
    public function group(string $pattern, $callable): RouteGroupInterface;

    /**
     * Add a routes that sends an HTTP redirect
     *
     * @param string              $from
     * @param string|UriInterface $to
     * @param int                 $status
     *
     * @return RouteInterface
     */
    public function redirect(string $from, $to, int $status = 302): RouteInterface;
}
