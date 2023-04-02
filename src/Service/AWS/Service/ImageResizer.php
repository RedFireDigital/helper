<?php

namespace RedFireDigital\Helper\Service\AWS\Service;

use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use RedFireDigital\Helper\Service\AWS\Model\ImageSize;

class ImageResizer
{

    private $imagine;

    public function __construct()
    {
        $this->imagine = new Imagine();
    }

    public function resize(string $filename, string $imageFileContents, ImageSize $imageSize): string
    {
        list($iwidth, $iheight) = getimagesizefromstring($imageFileContents);


        $ratio = $iwidth / $iheight;

        $width = $imageSize->getWidth();
        $height = $imageSize->getHeight();

        if ($width / $height > $ratio) {
            $width = $height * $ratio;
        } else {
            $height = $width / $ratio;
        }

        $pathInfo = pathinfo($filename);


        $saveFileName =
            $pathInfo['dirname'] . '/' .
            $imageSize->getName() . '/' .
            $pathInfo['filename'] . '.' . $pathInfo['extension'];

        $photo = $this->imagine->open($filename);
        $photo->resize(new Box($width, $height))->save($saveFileName);

        return $saveFileName;
    }
}