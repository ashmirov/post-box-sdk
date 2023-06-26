<?php

namespace Post\Box\Sdk\Methods;

use Http\Client\Exception;
use Post\Box\Sdk\PostBoxSdk;
use Post\Box\Sdk\ResponseHandler;
use Psr\Http\Client\ClientExceptionInterface;

class GetInfo
{
    private PostBoxSdk $sdk;

    public function __construct(PostBoxSdk $sdk)
    {
        $this->sdk = $sdk;
    }

    public function get(string $ico): array
    {
        $requestBody = <<<XML
        <GetInfoRequest xmlns="http://seznam.gov.cz/ovm/ws/v1">
            <Ico>{$ico}</Ico>
        </GetInfoRequest>
        XML;

        try {
            $responseBody = $this
                ->sdk
                ->getHttpClient()
                ->post(uri: '/call', body: $requestBody)
                ->getBody()
                ->getContents();
        } catch (ClientExceptionInterface $e) {
            $this->sdk->getLogger()->error("Here is error {$e->getMessage()}");
        }

        $response = simplexml_load_string($responseBody);

        $data = ResponseHandler::xmlToArray($response->children());

        if (!isset($data['Osoba'][0])) {
            $data['Osoba'] = [$data['Osoba']];
        }

        return $data;
    }
}