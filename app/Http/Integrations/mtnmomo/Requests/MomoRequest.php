<?php

namespace App\Http\Integrations\mtnmomo\Requests;

use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use App\Http\Integrations\mtnmomo\MomoConnector;
use Sammyjo20\Saloon\Traits\Plugins\HasXMLBody;
class MomoRequest extends SaloonRequest
{
    use HasXMLBody;
    /**
     * The connector class.
     *
     * @var string|null
     */
    protected ?string $connector = MomoConnector::class;

    /**
     * The HTTP verb the request will use.
     *
     * @var string|null
     */
    protected ?string $method = Saloon::GET;

    /**
     * The endpoint of the request.
     *
     * @return string
     */
    public function defineXmlBody(): string
    {
        return '<?xml version="1.0" encoding="UTF-8"?>';
    }
    public function defineEndpoint(): string
    {
        return '/api/v1/user';
    }

    public function defaultHeaders(): array
    {
        return [
            'Multiple-Values-Header' => ['Value1', 'Value2'], // Value1;Value2
        ];
    }
}
