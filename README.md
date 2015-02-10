laravel-restclient
==================

[![Build Status](https://travis-ci.org/nathanmac/laravel-restclient.svg?branch=master)](https://travis-ci.org/nathanmac/laravel-restclient)
[![Still Maintained](http://stillmaintained.com/nathanmac/laravel-restclient.png)](http://stillmaintained.com/nathanmac/laravel-restclient)


Simple RestClient Package for Laravel 4

Installation
------------

Begin by installing this package through Composer. Edit your project's `composer.json` file to require `Nathanmac/laravel-restclient`.

	"require": {
		"nathanmac/laravel-restclient": "dev-master"
	}

Next, update Composer from the Terminal:

    composer update

Once this operation completes, the final step is to add the service provider. Open `app/config/app.php`, and add a new item to the providers array.

    'Nathanmac\RestClient\RestClientServiceProvider'


##### Calling an Endpoint
```php
try {
    $response = RestClient::get('hostname:port/endpoint');
} catch (Exception $ex) {
    print "Error: " . $ex->getMessage(); // Error: COULDNT_RESOLVE_HOST
}
```

###### HTTP Methods
```php
  $response = RestClient::get('hostname:port/endpoint');
  $response = RestClient::post('hostname:port/endpoint', 'payload data');
  $response = RestClient::put('hostname:port/endpoint', 'payload data');
  $response = RestClient::delete('hostname:port/endpoint');
```

###### Adding HTTP Headers
```php
$headers = array(
    'token: SLDKFJLKSDFJSLDFJ',
    'other: asfasdfasdf'
);

$response = RestClient::get('hostname:port/endpoint', $headers);
$response = RestClient::post('hostname:port/endpoint', 'payload data', $headers);
$response = RestClient::put('hostname:port/endpoint', 'payload data', $headers);
$response = RestClient::delete('hostname:port/endpoint', $headers);
```

##### Get the HTTP Status Code
```php
echo "HTTP Status Code: " . $response->getStatusCode(); // HTTP Status Code: 200
echo "HTTP Status Text: " . $response->getStatusText(); // HTTP Status Text: OK
```

##### Returning the response content
```php
print $response->getContent();
```

##### Returning the response headers
```php
print_r($response->getHeaders());
```

##### Returning a specific header
```php
echo "Content-Type: " . $response->getHeader('content_type'); // Content-Type: application/json
```

##### Returning the response time (seconds)
```php
echo "Time: " . $response->getTime();  // Time: 0.23453
```
