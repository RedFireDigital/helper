<?php

namespace RedFireDigital\Helper\Service\QR\Model;

interface QRPrintInterface
{
    public function getTitle() : string;
    public function getDescription() : string;
    public function getLogoUrl() : string;
    public function getQRData() : string;
}