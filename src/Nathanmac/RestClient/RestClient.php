<?php 

namespace Nathanmac\RestClient;

use Config, Exception;

class RestClientException extends Exception {}

class RestClient {
 
    protected $_submitted = false;
 	protected $_headers = array();
 	protected $_body = '';

	public function get($uri, $headers = array(), $timeout = 30) {
		$ch  = curl_init($uri);
        
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if (is_array($headers) && count($headers) > 0)
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        if (curl_errno($ch)) {
            $error_codes = Config::get('restclient::error_codes');
            throw new RestClientException(isset($error_codes[curl_errno($ch)]) ? $error_codes[curl_errno($ch)] : "UNKNOWN_ERROR");
        }

        $this->_submitted = true;
        $this->_body = curl_exec($ch);
        $this->_headers = curl_getinfo($ch);
        
        curl_close($ch);
		return $this;
	}

	public function post($uri, $payload, $headers = array(), $timeout = 30) {
		$ch  = curl_init($uri);
        
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if (is_array($headers) && count($headers) > 0)
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        if (curl_errno($ch)) {
            $error_codes = Config::get('restclient::error_codes');
            throw new RestClientException(isset($error_codes[curl_errno($ch)]) ? $error_codes[curl_errno($ch)] : "UNKNOWN_ERROR");
        }
        
        $this->_submitted = true;
        $this->_body = curl_exec($ch);
        $this->_headers = curl_getinfo($ch);

        curl_close($ch);
        return $this;
	}
 	
 	public function put($uri, $payload, $headers = array(), $timeout = 30) {
        $ch  = curl_init($uri);
        
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if (is_array($headers) && count($headers) > 0)
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        if (curl_errno($ch)) {
            $error_codes = Config::get('restclient::error_codes');
            throw new RestClientException(isset($error_codes[curl_errno($ch)]) ? $error_codes[curl_errno($ch)] : "UNKNOWN_ERROR");
        }
        
        $this->_submitted = true;
        $this->_body = curl_exec($ch);
        $this->_headers = curl_getinfo($ch);
        
        curl_close($ch);
        return $this;
 	}

 	public function delete($uri, $headers = array(), $timeout = 30) {
        $ch  = curl_init($uri);
        
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if (is_array($headers) && count($headers) > 0)
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        if (curl_errno($ch)) {
            $error_codes = Config::get('restclient::error_codes');
            throw new RestClientException(isset($error_codes[curl_errno($ch)]) ? $error_codes[curl_errno($ch)] : "UNKNOWN_ERROR");
        }

        $this->_submitted = true;
        $this->_body = curl_exec($ch);
        $this->_headers = curl_getinfo($ch);
        
        curl_close($ch);
        return $this;
 	}


 	/*
	 *	After the request - functions to return data
 	 */
 	public function getStatusCode() {
        if ($this->_submitted)
            return $this->getHeader('http_code');
        return 0;
 	}

    public function getStatusText() {
        if ($this->_submitted) {
            $http_status_codes = Config::get('restclient::http_status_codes');
            return isset($http_status_codes[$this->getStatusCode()]) ? $http_status_codes[$this->getStatusCode()] : 'UNKNOWN';
        }
        return 'UNKNOWN';
    }

 	public function getContent() {
 		return $this->_body;
 	}

 	public function getHeaders() {
 		return $this->_headers;
 	}

 	public function getHeader($index) {
 		if (isset($this->_headers[$index]))
 			return $this->_headers[$index];
        return 'N/A';
 	}

 	public function getTime() {
 		return $this->getHeader('total_time');
 	}
}
