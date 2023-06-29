<?php

namespace Post\Box\Sdk\Methods;

use Post\Box\Sdk\Models\GetInfoResponse;
use Post\Box\Sdk\PostBoxSdk;
use Psr\Http\Client\ClientExceptionInterface;

class GetInfo
{
    private PostBoxSdk $sdk;

    public function __construct(PostBoxSdk $sdk)
    {
        $this->sdk = $sdk;
    }

    public function get(string $ico): GetInfoResponse
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
            throw new \Exception("Here is some error{$e->getMessage()}");
        }

        return $this->sdk->getSerializer()->deserialize($responseBody, GetInfoResponse::class, 'xml');
    }
}