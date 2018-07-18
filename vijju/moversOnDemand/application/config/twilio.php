<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* Name:  Twilio
	*
	* Author: Ben Edmunds
	*		  ben.edmunds@gmail.com
	*         @benedmunds
	*
	* Location:
	*
	* Created:  03.29.2011
	*
	* Description:  Twilio configuration settings.
	*
	*
	*/

	/**
	 * Mode ("sandbox" or "prod")
	 **/
	$config['mode']   = 'prod';

	/**
	 * Account SID
	 **/
	 // $sid = 'AC23c7163dab8b70440766de1728ef4df9';
  //   $token = '617a4f386faf462854efbd1271c620cd';
	$config['account_sid']   = 'AC23c7163dab8b70440766de1728ef4df9';
	// $config['account_sid']   = 'ACd9ea436674ec2d8744d2652cb265858e';

	/**
	 * Auth Token
	 **/
	$config['auth_token']    = '617a4f386faf462854efbd1271c620cd';
	// $config['auth_token']    = 'db31d00ca08a02d08005f04bb07aa754';

	/**
	 * API Version
	 **/
	$config['api_version']   = '2010-04-01';

	/**
	 * Twilio Phone Number
	 **/

	// $config['number']        = '+15512727143';
	$config['number']        = '+15005550006';
	


/* End of file twilio.php */

// https://demo.twilio.com/welcome/sms/reply/15512727143 