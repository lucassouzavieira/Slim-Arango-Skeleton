<?php

namespace App\Core\Contracts\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * REST interface for controllers
 *
 * @package App\Controllers\Contracts
 * @since 1.0
 * @author Lucas S. Vieira
 */
interface RestInterface
{
    /**
     * List all resources
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request, Response $response, $args) : Response;

    /**
     * Stores a new resource in database
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request, Response $response, $args) : Response;

    /**
     * Shows a resource
     *
     * @param Request $request
     * @return Response
     */
    public function show(Request $request, Response $response, $args) : Response;

    /**
     * Update a resource
     *
     * @param Request $request
     * @return Response
     */
    public function update(Request $request, Response $response, $args) : Response;

    /**
     * Destroy a resource
     *
     * @param Request $request
     * @return Response
     */
    public function destroy(Request $request, Response $response, $args) : Response;
}