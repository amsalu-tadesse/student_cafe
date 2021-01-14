<?php

namespace App\Controller;

use App\Entity\Student;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use CodeItNow\BarcodeBundle\Utils\QrCode;
use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
use Dompdf\Dompdf;
use Dompdf\Options;
use Mumpo\FpdfBarcode\FpdfBarcode;
// use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;
// use setasign\Fpdi\Tfpdf\Fpdi;
// use setasign\Fpdi\Fpdi;
// use setasign\Fpdi\Tfpdf\Fpdi;
use setasign\Fpdi\Fpdi;

class BarcodeController extends AbstractController
{

     /**
     * @Route("/batchbarcode", name="batchbarcode")
     */
    public function GenerateBatch()
    {
        $arr=[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36];
        $this->generateCards($arr);

    }
    /**
     * @Route("/down/{id}", name="down")
     */
    public function down(Student $student)
    {
        $input = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIgAAAAlCAIAAAAWWjY1AAAATHRFWHRDb3B5cmlnaHQAR2VuZXJhdGVkIHdpdGggQmFyY29kZSBHZW5lcmF0b3IgZm9yIFBIUCBodHRwOi8vd3d3LmJhcmNvZGVwaHAuY29tWX9wuAAAAAlwSFlzAAAOxAAADsQBlSsOGwAAAMJJREFUaIHt2kEKwyAQQFGVXmTufwbPNl0EimAnZBHwL/5bFSOj5FPoor0tMrO11nv/fb5cK/vO+6f7enVKdeK6slonV9OenLvPvD9xn1+9h2r+/X3WPePvPXScYaAMA2UYKMNAGQbKMFCGgTIMlGGgDANlGCjDQBkGyjBQhoEyDJRhoAwDZRgow0AZBsowUIaBMgyUYaAMA2UYKMNA9er/7TrLbwyUYaAMA2UYqM/pC7xgzpmZETHGiIjT13mHv8qgvtVgQkR6OTTmAAAAAElFTkSuQmCC';
        $output = '/var/www/gradution/public/uploads/barcode.png';
        file_put_contents($output, file_get_contents($input));
        return new Response("donwloaded");
    }

    /**
     * @Route("/barcode/{id}", name="barcode")
     */
    public function index(Student $student)
    {

       
        // $myuid = uniqid('AASTU'); 
        $myuid = $this->generate_random_letters(6);
        $barcode = new BarcodeGenerator();
        $barcode->setText($myuid );
        $barcode->setType(BarcodeGenerator::Code128);
        $barcode->setScale(2);
        $barcode->setThickness(15);
        $barcode->setFontSize(11);
        $code = $barcode->generate();

        // file_put_contents('/var/www/gradution/public/uploads/barcode.png', $code);

        // $bcode ='<img src="data:image/png;base64,'.$code.'" />';
        // $output_file = "/var/www/gradution/public/uploads/haha.jpeg";

        // $con = $this->base64_to_jpeg($bcode, $output_file);
        
        //   echo '<img src="data:image/png;base64,'.$code.'" />';
        //   die;
        //  echo "<br>";
        // $lastBarcode = $student->getFirstName().'<img src="data:image/png;base64,'.$code.'" />';
        // $lastBarcode = $student->getFirstName().'<img src="data:image/png;base64,'.$code.'" />';

        
       /* $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);*/
        // $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $input = 'data:image/png;base64,'.$code;
        $output = '/var/www/gradution/public/uploads/barcodes/barcode_'.$student->getId().'.png';
        file_put_contents($output, file_get_contents($input));
        // return new Response("donwloaded");
        // die;

        $barcode_file = '/var/www/gradution/public/uploads/barcodes/barcode_'.$student->getId().'.png';



/*
$pdf = new Fpdi();

$pageCount = $pdf->setSourceFile('Fantastic-Speaker.pdf');
$pageId = $pdf->importPage(1, PdfReader\PageBoundaries::MEDIA_BOX);

$pdf->addPage();
$pdf->useImportedPage($pageId, 10, 10, 90);

$pdf->Output('I', 'generated.pdf');*/



// initiate FPDI
$pdf = new Fpdi();
// $pdfbar = new FpdfBarcode();
// add a page
// $pdf->AddPage();
// set the source file
$pdf->setSourceFile("/var/www/gradution/public/logos/template.pdf");
// import page 1
$templateId = $pdf->importPage(1);
// use the imported page and place it at point 10,10 with a width of 100 mm
// $pdf->useTemplate($templateId, 10, 10, 100);



// $pdf = new FpdfTpl();
// $pdf->AddPage();


$pdf->setFont('Helvetica');
// $pdf->Text(10, 10, 'HEADING');

$imsize = 33.8;

// for ($i = 10; $i > 0; $i--) {
    $pdf->AddPage();
    $pdf->useTemplate($templateId);
  
        $pdf -> SetY(17); 
        $pdf -> SetX(15); 
        $pdf->Cell(100, 100, $pdf->Image($barcode_file , $pdf->GetX(), $pdf->GetY(), $imsize), 0, 0, 'L', false );
        // $pdf->Cell(15,15,'This is line number '.$i,1,1);
        $pdf -> SetY(17); 
        $pdf -> SetX(110); 
        // $pdf->Cell(15,15,'This is line number '.$i,1,1);
        $pdf->Cell(50, 10, $pdf->Image($barcode_file, $pdf->GetX(), $pdf->GetY(), $imsize), 0, 0, 'L', false );
        $pdf -> SetY(150); 
        $pdf -> SetX(15); 
        // $pdf->Cell(15,15,'This is line number '.$i,1,1);
        $pdf->Cell(50, 10, $pdf->Image($barcode_file, $pdf->GetX(), $pdf->GetY(), $imsize), 0, 0, 'L', false );
        $pdf -> SetY(150); 
        $pdf -> SetX(110); 
        // $pdf->Cell(15,15,'This is line number '.$i,1,1);
        $pdf->Cell(50, 10, $pdf->Image($barcode_file, $pdf->GetX(), $pdf->GetY(), $imsize), 0, 0, 'L', false );

// }
 


            // $pdf->Output("/var/www/gradution/public/uploads/cards/",'card_'.$student->getId().".pdf",true);  
            $pdf->Output();  


    }



    public function generateCards($studentsList)
    {
        $pdf = new Fpdi();
        foreach($studentsList as $key=>$value)
        {
            $myuid = $this->generate_random_letters(6);
            $barcode = new BarcodeGenerator();
            $barcode->setText($myuid );
            $barcode->setType(BarcodeGenerator::Code128);
            $barcode->setScale(2);
            $barcode->setThickness(15);
            $barcode->setFontSize(11);
            $code = $barcode->generate();
            $input = 'data:image/png;base64,'.$code;
            $output = '/var/www/gradution/public/uploads/barcodes/barcode_'.$value.'.png';
            file_put_contents($output, file_get_contents($input));
            $barcode_file = '/var/www/gradution/public/uploads/barcodes/barcode_'.$value.'.png';
          
            $pdf->setSourceFile("/var/www/gradution/public/logos/template.pdf");
            $templateId = $pdf->importPage(1);
            $pdf->setFont('Helvetica');
            $imsize = 33.8;
  

            if($key%4==0)
            {
                $pdf->AddPage();
                $pdf->useTemplate($templateId);

                $pdf -> SetY(17); 
                $pdf -> SetX(15); 
                // $pdf->Cell(15,15,'This is line number '.$i,1,1);
                $pdf->Cell(100, 100, $pdf->Image($barcode_file , $pdf->GetX(), $pdf->GetY(), $imsize), 0, 0, 'L', false );
            }
            elseif(($key-1)%4==0)
            {
                $pdf -> SetY(17); 
                $pdf -> SetX(110); 
                // $pdf->Cell(15,15,'This is line number '.$i,1,1);
                $pdf->Cell(50, 10, $pdf->Image($barcode_file, $pdf->GetX(), $pdf->GetY(), $imsize), 0, 0, 'L', false );
            }
            elseif(($key-2)%4==0)
            {
                $pdf -> SetY(150); 
                $pdf -> SetX(15); 
                // $pdf->Cell(15,15,'This is line number '.$i,1,1);
                $pdf->Cell(50, 10, $pdf->Image($barcode_file, $pdf->GetX(), $pdf->GetY(), $imsize), 0, 0, 'L', false );
            }
            else
            {
                $pdf -> SetY(150); 
                $pdf -> SetX(110); 
                // $pdf->Cell(15,15,'This is line number '.$i,1,1);
                $pdf->Cell(50, 10, $pdf->Image($barcode_file, $pdf->GetX(), $pdf->GetY(), $imsize), 0, 0, 'L', false );
            }
            
        }
        $pdf->Output(); 
    }
    function generate_random_letters($length) {
        $random = '';
        for ($i = 0; $i < $length; $i++) {
            $random .= chr(rand(ord('0'), ord('9')));
        }
        return $random;
    }

    function base64_to_jpeg($base64_string, $output_file) {
        // open the output file for writing
        $ifp = fopen( $output_file, 'wb' ); 
    
        // split the string on commas
        // $data[ 0 ] == "data:image/png;base64"
        // $data[ 1 ] == <actual base64 string>
        $data = explode( ',', $base64_string );
    
        // we could add validation here with ensuring count( $data ) > 1
        fwrite( $ifp, base64_decode( $data[ 1 ] ) );
    
        // clean up the file resource
        fclose( $ifp ); 
    
        return $output_file; 
    }
}
