<?php
/** set your paypal credential **/

$config['client_id'] = 'AdGcASQ8wYe4mFHWyooDQ7XRsASbt-gYd9KX2YIHgOrARhkL44iAQZ5rmQYB93GQlPu8WVRBCc1Xz5_P';
$config['secret'] = 'EFz9cbPUdzGhpYb5ZW3gvOF1Kcl1-MCfgyOIFm-TDB1ADwno15eMaX3BPdAuAr6g_RhZaKGQMTy_lIhE';

/**
 * SDK configuration
 */
/**
 * Available option 'sandbox' or 'live'
 */
$config['settings'] = array(

    'mode' => 'sandbox',
    /**
     * Specify the max request time in seconds
     */
    'http.ConnectionTimeOut' => 1000,
    /**
     * Whether want to log to a file
     */
    'log.LogEnabled' => true,
    /**
     * Specify the file that want to write on
     */
    'log.FileName' => 'application/logs/paypal.log',
    /**
     * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
     *
     * Logging is most verbose in the 'FINE' level and decreases as you
     * proceed towards ERROR
     */
    'log.LogLevel' => 'FINE'
);
?>