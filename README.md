# Box post API SDK
    //TODO: tests
    //TODO: error response handler
    //TODO: make mapping response to response object

## Usage
```php
$sdk = new \Post\Box\Sdk\PostBoxSdk();

$sdk->getInfo()->get('00007064')['Osoba'][0]['NazevOsoby'];
```

## Configuration
### Options
You can set 
- client_builder - where you can implement you own HttpClient, Request and Stream based on PSR-18 
- uri_factory - where you can implement your own factory for Uri builder based on UriFactoryInterface
- uri - where you can set you own URI
```php
$clientBuilder = new ClientBuilder();
$options = new Options([
'client_builder' => $clientBuilder,
'uri' => 'https://sandbox.com'
]);
$sdk = new \Post\Box\Sdk\PostBoxSdk($options);
```
### Mock client builder

```php
$mockClient = new Http\Mock\Client();

$psr17Factory = new Psr17Factory();
$response = $psr17Factory
    ->createResponse(200)
    ->withBody(
        $psr17Factory
        ->createStream('YOUR XML RESPONSE')
    );
$mockClient->addResponse($response);
$clientBuilder = new ClientBuilder($mockClient);

$options = new Options([
'client_builder' => $clientBuilder,
]);
$sdk = new \Post\Box\Sdk\PostBoxSdk($options);
```
