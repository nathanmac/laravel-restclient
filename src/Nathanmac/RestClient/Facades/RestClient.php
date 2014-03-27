<?php namespace Nathanmac\RestClient\Facades;
 
use Illuminate\Support\Facades\Facade;
 
class RestClient extends Facade {
 
  /**
   * Get the registered name of the component.
   *
   * @return string
   */
  protected static function getFacadeAccessor() { return 'restclient'; }
 
}