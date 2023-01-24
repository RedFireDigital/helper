<?php
/**
 * Created by Graham Owens (gra@redfiredigital.uk)
 * Company: RedFire Digital Ltd (www.redfiredigital.uk)
 * Console: Snowdon
 *
 * User:    gra
 * Date:    05/September/2021
 * Time:    23:03
 * Project: virtuopo-admin-service
 * File:    MathsUtils.php
 * IDE:     PhpStorm
 *
 **/

namespace RedFireDigital\Helper\Service\Utils;

class MathsUtils
{
    public static function getNicePercentage($num, $total) : string
    {
        if($total !== 0) {
            $percent = $num / $total * 100;
        } else {
            $percent = 0;
        }
        return number_format((float)$percent, 3, '.', '') . '%';
    }
}