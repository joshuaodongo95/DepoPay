<?php

namespace App\Http\Integrations\mtnmomo;

use Sammyjo20\Saloon\Http\SaloonConnector;
// use Sammyjo20\Saloon\Traits\Plugins\AcceptsJson;
// use Sammyjo20\Saloon\Traits\Plugins\HasXMLBody;

class MomoConnector extends SaloonConnector
{
    // use AcceptsJson;
    // use HasXMLBody;

    /**
     * The Base URL of the API.
     *
     * @return string
     */
    public function defineBaseUrl(): string
    {
        return 'https://forge.laravel.com/api/v1';
    }

    /**
     * The headers that will be applied to every request.
     *
     * @return string[]
     */
    public function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Multiple-Values-Header' => ['Value1', 'Value2'], // Value1;Value2
        ];
    }

    /**
     * The config options that will be applied to every request.
     *
     * @return string[]
     */
    public function defaultConfig(): array
    {
        return [
            'timeout' => 60,
        ];
    }
}
