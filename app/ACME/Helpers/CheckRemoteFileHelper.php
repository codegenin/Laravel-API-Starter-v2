<?php
namespace App\ACME\Helpers;

class CheckRemoteFileHelper
{
    /**
     * Checks the file if present in remote server
     *
     * @param $url
     * @return bool
     */
    public static function checkRemoteFile($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        // don't download content
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
        $result = curl_exec($ch);
        curl_close($ch);
    
        if ($result !== false) {
            return true;
        } else {
            return false;
        }
    }
    
}