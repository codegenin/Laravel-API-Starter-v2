<?php
namespace App\ACME\Helpers;

class StringHelper
{
    /**
     * Clean the string removing line breaks and slashes
     *
     * @param $string
     * @return mixed
     */
    public static function cleanString($string)
    {
        #return str_replace(["\r", "\n", "\\", "/"], '', strip_tags($string));
        return rtrim($string, "\r\n");
    }
}