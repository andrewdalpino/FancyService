<?php

namespace App\Services;

/**
 * This class implementation is provided by FancyService.
 * 
 * A client to communicate with FancyService server.
 */
class FancyService
{
    /**
     * Constructor.
     *
     * @param array $config Contains credentials and service URI.
     */
    public function __construct(array $config)
    {
        // Already implemented.
    }
 
    /**
     * Send a product UPC and receive product information.
     *
     * @param  string $upc
     * @return array|null  An associative array with two keys or null for nothing found.
     *                     [
     *                         'prod_name' => Name of the product.
     *                         'prod_desc' => Description of the product.
     *                     ]
     * @throws \RuntimeException For unexpected events.
     */
    public function submit($upc)
    {
        // Already implemented.
    }
}