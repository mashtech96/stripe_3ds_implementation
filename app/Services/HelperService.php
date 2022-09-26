<?php
namespace App\Services;
use Carbon\Carbon;

class HelperService
{
  
    public static function dateTimeFormat($dateTime, $format = 'M d, Y h:i A', $locale = null, $default = '')
    {
        if ($locale != null) {
            Carbon::setLocale($locale);
        }

        try {
            return Carbon::parse($dateTime)->format($format);
        } catch (\Exception $err) {
            return $default;
        }
    }
    public static function dateFormat($dateTime, $format = 'M d, Y', $locale = null, $default = '')
    {
        if ($locale != null) {
            Carbon::setLocale($locale);
        }

        try {
            return Carbon::parse($dateTime)->format($format);
        } catch (\Exception $err) {
            return $default;
        }
    }
    public static function timeFormat($dateTime, $format = 'h:i A', $locale = null, $default = '')
    {
        if ($locale != null) {
            Carbon::setLocale($locale);
        }

        try {
            return Carbon::parse($dateTime)->format($format);
        } catch (\Exception $err) {
            return $default;
        }
    }
   

}