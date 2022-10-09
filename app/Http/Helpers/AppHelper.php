<?php
 namespace App\Http\Helpers;

class AppHelper
{

    public static function getUserSessionHash()
    {
        
    }

    public static function getShortName($phrase)
    {
        /**
         * Acronyms generator of a phrase
         */
        return preg_replace('~\b(\w)|.~', '$1', $phrase);
    }

}