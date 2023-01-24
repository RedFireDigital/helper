<?php
/**
 * Created by Graham Owens (gra@redfiredigital.uk)
 * Client: RedFire Digital Ltd (www.redfiredigital.uk)
 * Console: Snowdon
 *
 * User:    gra
 * Date:    16/August/2022
 * Time:    12:50
 * Project: SpyBlu-Sally
 * File:    GitInformation.php
 * IDE:     PhpStorm
 *
 **/

namespace RedFireDigital\Helper\Service\GitInfo;

class GitInformation
{
    const MAJOR = 1;
    const MINOR = 1;
    const PATCH = 8;

    const ENV_FILE = '.env';
    const ENV_FILE_VERSION_VAR = 'APP_VERSION_STRING';

    public static function getVersion() : string
    {
        $commitHash = trim(exec('git log --pretty="%h" -n1 HEAD'));

        $commitDate = new \DateTime(trim(exec('git log -n1 --pretty=%ci HEAD')));
        $commitDate->setTimezone(new \DateTimeZone('UTC'));

        return sprintf('v%s.%s.%s-dev.%s Built (%s)', self::MAJOR, self::MINOR, self::PATCH, $commitHash, $commitDate->format('Y-m-d H:i:s'));
    }

    public static function getFullVersion() : string
    {
        $company = $_ENV['APP_COMPANY'];
        $appName = $_ENV['APP_NAME'];

        return $company . ' | '. $appName . ' | '. self::getVersion();
    }

    public static function saveInEnvFile(string $versionString) : void
    {
        $envFilePath = self::getFilePath() . self::ENV_FILE;
        $envFileLines = file($envFilePath);
        $newEnvFile = [];
        foreach ($envFileLines as $envLine) {
            if (strpos($envLine, self::ENV_FILE_VERSION_VAR, 0) === false) {
                $newEnvFile[] = $envLine;
            } else {
                $newEnvFile[] = self::ENV_FILE_VERSION_VAR.'="'.self::getFullVersion().'"' . PHP_EOL;
            }
        }
        file_put_contents($envFilePath, $newEnvFile);
    }

    public static function writeToFile(string $filePath, string $versionString) : void
    {
        file_put_contents($filePath, $versionString);
    }

    private static function getFilePathWithName() : string
    {
        return self::getFilePath() . $_ENV['APP_VERSION_FILE'];
    }

    private static function getFilePath() : string
    {
        return __DIR__ . '/../../';
    }

}