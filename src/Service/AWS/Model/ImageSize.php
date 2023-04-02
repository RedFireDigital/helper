<?php

namespace RedFireDigital\Helper\Service\AWS\Model;

class ImageSize
{
    private string $name;
    private int $width;
    private int $height;

    public function __toString(): string
    {
        return $this->getName();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return strtolower($this->name);
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = strtolower($name);
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @param int $width
     */
    public function setWidth(int $width): void
    {
        $this->width = $width;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param int $height
     */
    public function setHeight(int $height): void
    {
        $this->height = $height;
    }


}