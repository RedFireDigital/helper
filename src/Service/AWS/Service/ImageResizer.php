<?php

namespace RedFireDigital\Helper\Service\AWS\Service;

use Imagine\Gd\Imagine;
use Imagine\Image\Box;

class ImageResizer
{

    private $imagine;

    public function __construct()
    {
        $this->imagine = new Imagine();
    }

    public function resize(string $filename, string $imageFileContents, int $width, int $height): string
    {
        $image = getimagesizefromstring($imageFileContents);

        $iwidth = imagesx($image);
        $iheight = imagesy($image);
        $ratio = $iwidth / $iheight;

        if ($width / $height > $ratio) {
            $width = $height * $ratio;
        } else {
            $height = $width / $ratio;
        }

        $pathInfo = pathinfo($filename);


        $saveFileName =
            $pathInfo['dirname'] . '/' .
            $pathInfo['dirname'] . '-' .
            $width . 'x' .
            $height .
            $pathInfo['extension'];

        $photo = $this->imagine->open($filename);
        $photo->resize(new Box($width, $height))->save($saveFileName);

        return $saveFileName;
    }
}