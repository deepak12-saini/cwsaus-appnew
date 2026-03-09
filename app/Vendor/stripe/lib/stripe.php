<?php

// Tested on PHP 5.2, 5.3

// This snippet (and some of the curl code) due to the Facebook SDK.
if (!function_exists('curl_init')) {
  throw new Exception('Stripe needs the CURL PHP extension.');
}
if (!function_exists('json_decode')) {
  throw new Exception('Stripe needs the JSON PHP extension.');
}


abstract class Stripe
{
  public static $apiKey;
  public static $apiBase = 'https://api.stripe.com/v1';
  public static $verifySslCerts = true;
  const VERSION = '1.6.5';

  public static function getApiKey()
  {
    return self::$apiKey;
  }

  public static function setApiKey($apiKey)
  {
    self::$apiKey = $apiKey;
  }

  public static function getVerifySslCerts() {
    return self::$verifySslCerts;
  }

  public static function setVerifySslCerts($verify) {
    self::$verifySslCerts = $verify;
  }
}


// Utilities
require(dirname(__FILE__) . '/stripe/Util.php');
require(dirname(__FILE__) . '/stripe/Util/Set.php');

// Errors
require(dirname(__FILE__) . '/stripe/Error.php');
require(dirname(__FILE__) . '/stripe/ApiError.php');
require(dirname(__FILE__) . '/stripe/ApiConnectionError.php');
require(dirname(__FILE__) . '/stripe/AuthenticationError.php');
require(dirname(__FILE__) . '/stripe/CardError.php');
require(dirname(__FILE__) . '/stripe/InvalidRequestError.php');

// Plumbing
require(dirname(__FILE__) . '/stripe/Object.php');
require(dirname(__FILE__) . '/stripe/ApiRequestor.php');
require(dirname(__FILE__) . '/stripe/ApiResource.php');

// Stripe API Resources
require(dirname(__FILE__) . '/stripe/Charge.php');
require(dirname(__FILE__) . '/stripe/Customer.php');
require(dirname(__FILE__) . '/stripe/Invoice.php');
require(dirname(__FILE__) . '/stripe/InvoiceItem.php');
require(dirname(__FILE__) . '/stripe/Plan.php');
require(dirname(__FILE__) . '/stripe/Token.php');
require(dirname(__FILE__) . '/stripe/Coupon.php');
require(dirname(__FILE__) . '/stripe/Event.php');
