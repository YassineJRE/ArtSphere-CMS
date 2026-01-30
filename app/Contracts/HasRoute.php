<?php

namespace App\Contracts;

interface HasRoute
{
    /**
     * Get the route URL for the model.
     *
     * @param array $query Optional query parameters to append to the URL.
     * @return string
     */
    public function getRoute(array $query = []): string;
}
