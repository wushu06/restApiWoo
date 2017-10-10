<?php 
session_start();
require __DIR__ . '/vendor/autoload.php';

use Automattic\WooCommerce\Client;

$woocommerce = new Client(
    'http://deuren.co.uk/wp_deuren', 
    'ck_f5c6fa9e56f37d068e6016ea692733e9c71ded5f', 
    'cs_c23941d9e0edee7121abf781f2fb715c2b745f9e',
    [
        'wp_api' => true,
        'version' => 'wc/v1',
    ]
);

use Automattic\WooCommerce\HttpClient\HttpClientException;
//print_r($woocommerce->get('products'));

try {
    // Array of response results.
    $results = $woocommerce->get('products');
    $_SESSION['result'] =  $results;
    //print_r($woocommerce->get('products'));
    // Example: ['customers' => [[ 'id' => 8, 'created_at' => '2015-05-06T17:43:51Z', 'email' => ...
   // var_dump($results);

    // Last request data.
    $lastRequest = $woocommerce->http->getRequest();
    //var_dump($lastRequest);
    $lastRequest->getUrl(); // Requested URL (string).
    $lastRequest->getMethod(); // Request method (string).
    $lastRequest->getParameters(); // Request parameters (array).
    $lastRequest->getHeaders(); // Request headers (array).
    $lastRequest->getBody(); // Request body (JSON).

    // Last response data.
    $lastResponse = $woocommerce->http->getResponse();
    $lastResponse->getCode(); // Response code (int).
    $lastResponse->getHeaders(); // Response headers (array).
    $lastResponse->getBody(); // Response body (JSON).

} catch (HttpClientException $e) {
   // var_dump($e);
     $e->getMessage(); // Error message.
     $e->getRequest(); // Last request data.
     $e->getResponse(); // Last response data.
}