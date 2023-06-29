<?php

namespace Post\Box\Sdk;

use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin\BaseUriPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Post\Box\Sdk\Methods\GetInfo;
use Psr\Log\LoggerInterface;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

final class PostBoxSdk
{
    private ClientBuilder $clientBuilder;
    private ?LoggerInterface $logger;
    private Serializer $serializer;

    public function __construct(
        Options $options = null,
        LoggerInterface $logger = null
    ) {
        $options = $options ?? new Options();

        $this->clientBuilder = $options->getClientBuilder();
        $this->clientBuilder->addPlugin(new BaseUriPlugin($options->getUri()));
        $this->clientBuilder->addPlugin(
            new HeaderDefaultsPlugin(
                [
                    'Content-Type' => 'application/xml',
                    'charset' => 'uft-8'
                ]
            )
        );
        $this->logger = $logger;
        $this->serializer = new Serializer(
            [
                new ArrayDenormalizer(),
                new ObjectNormalizer(propertyTypeExtractor: new PhpDocExtractor())
            ],
            [new XmlEncoder()]
        );
    }

    public function getInfo(): GetInfo
    {
        return new GetInfo($this);
    }

    public function getHttpClient(): HttpMethodsClientInterface
    {
        return $this->clientBuilder->getHttpClient();
    }

    public function getLogger(): LoggerInterface
    {
        return $this->logger;
    }

    public function getSerializer(): Serializer
    {
        return $this->serializer;
    }
}