<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use CodeItNow\BarcodeBundle\Utils\QrCode;
use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;

class BarcodeController extends AbstractController
{
    /**
     * @Route("/barcode", name="barcode")
     */
    public function index(): Response
    {

       
        // $myuid = uniqid('AASTU'); 
        $myuid = $this->generate_random_letters(6);
        $barcode = new BarcodeGenerator();
        $barcode->setText($myuid );
        $barcode->setType(BarcodeGenerator::Code128);
        $barcode->setScale(2);
        $barcode->setThickness(15);
        $barcode->setFontSize(0);
        $code = $barcode->generate();
        
        echo '<img src="data:image/png;base64,'.$code.'" />';
        echo "<br>";
        


die;

        return $this->render('barcode/index.html.twig', [
            'controller_name' => 'BarcodeController',
        ]);
    }

    function generate_random_letters($length) {
        $random = '';
        for ($i = 0; $i < $length; $i++) {
            $random .= chr(rand(ord('0'), ord('9')));
        }
        return $random;
    }
}
