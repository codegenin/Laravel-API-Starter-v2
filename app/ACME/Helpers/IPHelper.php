<?php
namespace App\ACME\Helpers;

class IPHelper
{
    /**
     * Function to get the client ip address
     * @return string
     */
    public static function get_client_ip_server()
    {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR']) {
            $clientIpAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $clientIpAddress = $_SERVER['REMOTE_ADDR'];
        }
        
        return $clientIpAddress;
    }
}