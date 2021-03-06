<?php

/**
 * Slim Framework (https://slimframework.com)
 *
 * @license https://github.com/slimphp/Slim/blob/4.x/LICENSE.md (MIT License)
 */

declare(strict_types=1);

namespace Slim\Interfaces;

use InvalidArgumentException;
use Psr\Http\Message\UriInterface;
use RuntimeException;

interface RouteParserInterface
{
    /**
     * Build the path for a named routes excluding the base path
     *
     * @param string   $routeName   Route name
     * @param string[] $data        Named argument replacement data
     * @param string[] $queryParams Optional query string parameters
     *
     * @return string
     *
     * @throws RuntimeException         If named routes does not exist
     * @throws InvalidArgumentException If required data not provided
     */
    public function relativeUrlFor(string $routeName, array $data = [], array $queryParams = []): string;

    /**
     * Build the path for a named routes including the base path
     *
     * @param string   $routeName   Route name
     * @param string[] $data        Named argument replacement data
     * @param string[] $queryParams Optional query string parameters
     *
     * @return string
     *
     * @throws RuntimeException         If named routes does not exist
     * @throws InvalidArgumentException If required data not provided
     */
    public function urlFor(string $routeName, array $data = [], array $queryParams = []): string;

    /**
     * Get fully qualified URL for named routes
     *
     * @param UriInterface $uri
     * @param string       $routeName   Route name
     * @param string[]     $data        Named argument replacement data
     * @param string[]     $queryParams Optional query string parameters
     *
     * @return string
     */
    public function fullUrlFor(UriInterface $uri, string $routeName, array $data = [], array $queryParams = []): string;
}
