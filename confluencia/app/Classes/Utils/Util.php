<?php

namespace App\Classes\Utils;

class Util {

    //public const MT4_PATH = "C:\Users\MeTheUser\AppData\Roaming\MetaQuotes\Terminal\9D15457EC01AD10E06A932AAC616DC32\MQL4\Files";
    public const MT4_PATH = "C:\iso\\";
    public const IQOPTION_PATH = "C:\\xampp\htdocs\confluencia\\";
    
    /**
     * Return formated datetime substracted
     * $x: amount of $part will be substracted
     * $part: hours, minute, day
     */
    public static function getSubTime($x, $part)
    {
        $dtnow = new \DateTime("now", new \DateTimeZone('America/Sao_Paulo'));
        date_sub($dtnow,date_interval_create_from_date_string($x . " " . $part));
        return date_format($dtnow,"YmdHi");
    }

    /**
     * Return Time Now Formated
     */
    public static function getTimeNow()
    {
        $dtnow = new \DateTime("now", new \DateTimeZone('America/Sao_Paulo'));
       
        return date_format($dtnow,"Hi");
    }

    /**
     * Return Date Now Formated
     */
    public static function getDateNow()
    {
        $dtnow = new \DateTime("now", new \DateTimeZone('America/Sao_Paulo'));
       
        return date_format($dtnow,"Ymd");
    }

    /**
     * Return DateTime Now Formated
     */
    public static function getDateTimeNow()
    {
        $dtnow = new \DateTime("now", new \DateTimeZone('America/Sao_Paulo'));
       
        return date_format($dtnow,"YmdHi");
    }
}