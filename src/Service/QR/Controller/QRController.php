<?php

namespace RedFireDigital\Helper\Service\QR\Controller;

use RedFireDigital\Helper\Service\QR\Model\QRPrintInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/qr/print/')]
class QRController extends AbstractController
{
    #[Route('/{id}', name: 'qr_print', methods: ['GET'])]
    public function show(QRPrintInterface $QRPrint) : Response
    {
        return $this->render('qr/show.html.twig', [
            'qrPrint' => $QRPrint,
        ]);
    }
}