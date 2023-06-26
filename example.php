<?php

use Http\Discovery\Psr17Factory;
use Post\Box\Sdk\ClientBuilder;
use Post\Box\Sdk\Options;

require_once __DIR__ . '/vendor/autoload.php';

$clientBuilder = new ClientBuilder();

/** Create mocked response

$mockClient = new Http\Mock\Client();

$psr17Factory = new Psr17Factory();
$response = $psr17Factory->createResponse(200)->withBody($psr17Factory->createStream('<GetInfoResponse xmlns="http://seznam.gov.cz/ovm/ws/v1">
<Osoba>
 <Ico>00007064</Ico>
 <NazevOsoby>test</NazevOsoby>
 <ISDS>6bnaawp</ISDS>
 <PDZ>false</PDZ>
 <TypSubjektu>OVM</TypSubjektu>
 <AdresaSidla>
 <AdresaTextem>Nad štolou 936/3, Holešovice, 17000, Praha 7</AdresaTextem>
 <OkresNazev>Hlavní město Praha</OkresNazev>
 <ObecNazev>Praha 7</ObecNazev>
 <CastObceNazev>Holešovice</CastObceNazev>
 <UliceNazev>Nad štolou</UliceNazev>
 <PostaKod>17000</PostaKod>
 <CisloDomovni>936</CisloDomovni>
 <CisloOrientacni>3</CisloOrientacni>
 </AdresaSidla>
 </Osoba>
</GetInfoResponse>
'));
$mockClient->addResponse($response);
$clientBuilder = new ClientBuilder($mockClient);
***/

$options = new Options([
    'client_builder' => $clientBuilder,
    //'uri' => 'http://sandbox.com' for
]);

$sdk = new \Post\Box\Sdk\PostBoxSdk($options);

var_dump($sdk->getInfo()->get('00007064')['Osoba'][0]['NazevOsoby']);