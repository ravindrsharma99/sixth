<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';

    use Travoltron\Plaid;

class PlaidTest extends Plaid
{
    public function testContactPlaid()
    {
        $categories = Plaid::categories();
        $this->assertNotNull($categories);
    }
}

?>