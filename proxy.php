<?php

require_once __DIR__ . '/vendor/autoload.php';

use Proxy\Proxy;
use Proxy\Adapter\Guzzle\GuzzleAdapter;
use Proxy\Filter\RemoveEncodingFilter;
use Laminas\Diactoros\ServerRequestFactory;

use GuzzleHttp\Psr7\Uri;

// Create a PSR7 request based on the current browser request.
$request = ServerRequestFactory::fromGlobals();

// Create a guzzle client
$guzzle = new GuzzleHttp\Client();

$req = $_GET['req'];

// Create the proxy instance
$proxy = new Proxy(new GuzzleAdapter($guzzle));
$url = 'http://localhost:9666/' . $req;
// $url = $toUrl;
$proxy->filter(function ($request, $response, $next) use ($url) {
	$request = $request->withUri(new Uri($url));
	$response = $next($request, $response);
	return $response;
});

// Add a response filter that removes the encoding headers.
$proxy->filter(new RemoveEncodingFilter());

// Forward the request and get the response.
$response = $proxy->forward($request)
    ->filter(function ($request, $response, $next) {
        // Manipulate the request object.
        $request = $request->withHeader('User-Agent', 'FishBot/1.0');
        $request = $request->withHeader('Origin', 'https://free.fr');
        $request = $request->withHeader('Host', 'free.fr');

        // Call the next item in the middleware.
        $response = $next($request, $response);

        // Manipulate the response object.
        $response = $response->withHeader('X-Proxy-Foo', 'Bar');
        $response = $response->withHeader('X-Forwarded-Host', 'toto.com');
        $response = $response->withHeader('Origin', 'https://free.fr');
        $response = $response->withHeader('Host', 'free.fr');

        return $response;
    })
    ->to('http://localhost:9666');

// Output response to the browser.
(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);

?>