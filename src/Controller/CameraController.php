<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CameraController extends AbstractController
{
    /**
     * @Route("/camera", name="camera")
     */
    public function index(Request $request): Response
    {


        $img = $request->request->get("image");
    //  $_POST['image'];

        $folderPath = "/var/www/gradution/public/uploads/";
    
      
    
        $image_parts = explode("base64,", $img);

        // dd(  $img );
    
        // $image_type_aux = explode("image/", $image_parts[0]);
    
        // $image_type = $image_type_aux[1];
    
      if(sizeof($image_parts) > 1)
      {
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';
    
      
    
        $file = $folderPath . $fileName;
    
        file_put_contents($file, $image_base64);
        print_r($fileName);
      }
    
        
    
        
    
      
    
       

        // die;

        return $this->render('camera/index.html.twig', [
            'controller_name' => 'CameraController',
        ]);
    }
}
