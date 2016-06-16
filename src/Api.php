<?php

/**
 * A middleware to check the PHP-SAPI type
 *
 * @link        https://github.com/pavlakis/php-sapi-check-middleware
 * @copyright   Copyright © 2016 Antonis Pavlakis
 * @author      Antonis Pavlakis
 * @license     https://github.com/pavlakis/php-sapi-check-middleware/blob/master/LICENSE (BSD 3-Clause License)
 */

namespace pavlakis\middleware\server;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class Api
{
    /**
     * @var string
     */
    private $sapi;

    /**
     * Api constructor.
     * @param $sapi
     */
    public function __construct($sapi)
    {
        $this->sapi = $sapi;
    }

    /**
     * Invoke middleware
     *
     * @param  ServerRequestInterface   $request  PSR7 request object
     * @param  ResponseInterface        $response PSR7 response object
     * @param  callable                 $next     Next middleware callable
     *
     * @return ResponseInterface PSR7 response object
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        if (strtolower($this->sapi) !== PHP_SAPI) {
            $response->withStatus(403);
        }

        return $next($request, $response);
    }
    
}