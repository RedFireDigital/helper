<?php

namespace RedFireDigital\Helper\Service\QR\Model;

class QRPrint implements QRPrintInterface
{

    private string $title;
    private string $description;
    private string $logoPath;
    private string $qrData;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getLogoPath(): string
    {
        return $this->logoPath;
    }

    /**
     * @param string $logoPath
     */
    public function setLogoPath(string $logoPath): void
    {
        $this->logoPath = $logoPath;
    }

    /**
     * @return string
     */
    public function getQRData(): string
    {
        return $this->qrData;
    }

    /**
     * @param string $qrData
     */
    public function setQRData(string $qrData): void
    {
        $this->qrData = $qrData;
    }




}