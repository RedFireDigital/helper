<?php
/**
 * Created by Graham Owens (gra@redfiredigital.uk)
 * Company: RedFire Digital Ltd (www.redfiredigital.uk)
 * Console: i7 Fedora
 *
 * User:    gra
 * Date:    03/July/2023
 * Time:    16:06
 * Project: helper
 * File:    RandomContent.php
 * IDE:     PhpStorm
 *
 **/

namespace RedFireDigital\Helper\Service\Utils;

class RandomContent
{
    private array $surnames;
    private array $boysNames;
    private array $girlsNames;
    public function __construct()
    {

    }
    public function getRandomName() : string
    {
        return "";
    }

    public function getRandomBoysName() : string
    {

    }

    private function getAllBoysNames() : array
    {
        $path = __DIR__ . "/../";
        $loadedFile = file_get_contents($path);
    }

}