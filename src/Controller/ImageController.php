<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ItForFree\rusphp\File\Image\ImageResizer;

class ImageController extends Controller
{
    /**
     * @Route("/image", name="image")
     */
    public function showAction(Request $request)
    {
        ImageResizer::showInFormat($request->get('path'), $request->get('format'));
    }
}
