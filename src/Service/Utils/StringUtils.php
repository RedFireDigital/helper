<?php
/**
 * Created by Graham Owens (gra@redfiredigital.uk)
 * Company: RedFire Digital Ltd (www.redfiredigital.uk)
 * Console: Shrek
 *
 * User:    gra
 * Date:    04/August/2021
 * Time:    09:00
 * Project: virtuopo-admin-service
 * File:    StringUtils.php
 * IDE:     PhpStorm
 *
 **/

namespace RedFireDigital\Helper\Service\Utils;

class StringUtils
{
    public static function getOnlyLettersNumbers(string $string) : string
    {
        return preg_replace("/[^a-zA-Z0-9]+/", "", $string);
    }

    public static function getRandomWord(int $len = 10)
    {
        $word = array_merge(range('a', 'z'), range('A', 'Z'));
        shuffle($word);
        return substr(implode($word), 0, $len);
    }

    public static function getStringWithLeadingZeros(string $string, int $length) : string
    {
        return substr(str_repeat(0, $length).$string, - $length);
    }

    public static function ripOutBodyTagStuffOnly(string $blurb) : string
    {
        return strip_tags($blurb, ['a', 'strong', 'h1', 'h2', 'h3']);
    }

    public static function getRawBody(string $blurb) : string
    {
        return $blurb;
    }

    public static function getUrlFromString(string $url) : string
    {
        $string = preg_replace("/ /", "-", $url);
        $string = preg_replace("/'/", "", $string);
        $string = preg_replace("/:/", "", $string);
        $string = preg_replace('/"/', "", $string);
        $string = preg_replace('/\./', "", $string);
        $string = preg_replace('/\?/', "", $string);
        $string = preg_replace('/&amp;/', "and", $string);
        $string = preg_replace('/&/', "and", $string);
        return preg_replace('/\//', "and", $string);
    }

    public static function getLastPartOfURL(string $url) : string
    {
        $path = parse_url($url, PHP_URL_PATH);
        $pathFragments = explode('/', $path);
        return end($pathFragments);
    }
}