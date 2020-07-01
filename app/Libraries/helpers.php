<?php
/**
 * Copyright (c) 2020
 * Author: Mohsen Mirhosseini <mohsen.mirhosseini@gmail.com>
 */
if (!function_exists('ta_persian_num')) {
    /**
     * @param $string
     * @param bool $format
     * @return mixed|string
     */
    function ta_persian_num($string, $format = false)
    {
        if ($format === true) {
            $string = number_format($string);
        }
        //arrays of persian and latin numbers
        $persian_num = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
        $latin_num = range(0, 9);

        $string = str_replace($latin_num, $persian_num, $string);

        return $string;
    }
}

if (!function_exists('fileSizeFormatted')) {
    function fileSizeFormatted(int $size)
    {
        $size *= 1000;
        $units = array('بایت', 'کیلوبایت', 'مگابایت', 'گیگابایت', 'ترابایت', 'پنتابایت', 'اگزابایت', 'ZB', 'YB');
        $power = $size > 0 ? floor(log($size, 1000)) : 0;
        return number_format($size / pow(1000, $power), 2, '.', ',') . ' ' . $units[$power];
    }
}

if (!function_exists('randomInt')) {
    function randomInt($length = 4, $min = null, $max = null)
    {
        $intMin = (10 ** $length) / 10;
        $intMax = (10 ** $length) - 1;

        if ($min != null) {
            $intMin = $min;
        }
        if ($max != null) {
            $intMax = $max;
        }
        $codeRandom = mt_rand($intMin, $intMax);

        return $codeRandom;
    }
}
