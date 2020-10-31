<?php

namespace App\Helpers;

/**
 * Helper methods
 *
 * PHP version 7.0
 */
class Helper
{

    /**
     * Sanitize Input
     *
     * @param string inputstring
     *
     * @return string sanitized string
     */
    public static function sanitize($inputString)
    {
        $clean_string = strip_tags($inputString);
        $clean_string = htmlentities($clean_string, ENT_QUOTES, 'UTF-8');
        return $clean_string;
    }
}
