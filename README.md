laravel-restclient
==================

[![Build Status](https://travis-ci.org/nathanmac/laravel-restclient.svg?branch=master)](https://travis-ci.org/nathanmac/laravel-restclient)

Simple RestClient Package for Laravel 4

##### Calling an Endpoint
```php
try {
    $request = RestClient::get('hostname:port/endpoint');
} catch (Exception $ex) {
    print "Error: " . $ex->getMessage(); // Error: COULDNT_RESOLVE_HOST
}
```

###### HTTP Methods
```php
  $request = RestClient::get('hostname:port/endpoint');
  $request = RestClient::post('hostname:port/endpoint', 'payload data');
  $request = RestClient::put('hostname:port/endpoint', 'payload data');
  $request = RestClient::delete('hostname:port/endpoint');
```

##### Get the HTTP Status Code
```php
echo "HTTP Status Code: " . $request->getStatusCode(); // HTTP Status Code: 200
echo "HTTP Status Text: " . $request->getStatusText(); // HTTP Status Text: OK
```

##### Returning the response content
```php
print $request->getContent();
```

##### Returning the response headers
```php
print_r($request->getHeaders());
```

##### Returning a specific header
```php
echo "Content-Type: " . $request->getHeader('content_type'); // Content-Type: application/json
```

##### Returning the response time (seconds)
```php
echo "Time: " . $request->getTime();  // Time: 0.23453
```
