<?php 
class Configuration
{
	// For a full list of configuration parameters refer in wiki page (https://github.com/paypal/sdk-core-php/wiki/Configuring-the-SDK)
	public static function getConfig()
	{
		$config = array(
				// values: 'sandbox' for testing
				//		   'live' for production
				"mode" => "sandbox",
                'log.LogEnabled' => true,
                'log.FileName' => '../PayPal.log',
                'log.LogLevel' => 'FINE'
	
				// These values are defaulted in SDK. If you want to override default values, uncomment it and add your value.
				// "http.ConnectionTimeOut" => "5000",
				// "http.Retry" => "2",
		);
		return $config;
	}
	
	// Creates a configuration array containing credentials and other required configuration parameters.
	public static function getAcctAndConfig()
	{
		$config = array(
				// Signature Credential
				"acct1.UserName" => "osvin.testapi-facilitator_api1.gmail.com",
				"acct1.Password" => "A9SXCGJ592S66RY7",
				"acct1.Signature" => "AQn.0vtEJpSDilpOvvpH.VXRm0mEAIfSqt.pv-PmhgnXpQX9Y5x3sJiC",
				

                //original
				//"acct1.UserName" => "minassoulis_api1.gmail.com",
				//"acct1.Password" => "ZE5LN9XC9H8FD7W9",
				//"acct1.Signature" => "Az8WByNIvNxG-dqy9d56oH94sEzPAzdR95i9otSN.c.fsZY72OWKSgaL",

				// Subject is optional and is required only in case of third party authorization
				// "acct1.Subject" => "",
				
				// Sample Certificate Credential

				// "acct1.UserName" => "certuser_biz_api1.paypal.com",
				// "acct1.Password" => "D6JNKKULHN3G5B8A",
				// Certificate path relative to config folder or absolute path in file system
				// "acct1.CertPath" => "cert_key.pem",
				// Subject is optional and is required only in case of third party authorization
				// "acct1.Subject" => "",
		
				//$cred = new PPSignatureCredential("jb-us-seller_api1.paypal.com", "WX4WTU3S8MY44S7F", "AFcWxV21C7fd0v3bYYYRCpSSRl31A7yDhhsPUU2XhtMoZXsWHFxu-RWy");

				);
		
		return array_merge($config, self::getConfig());
	}

}
