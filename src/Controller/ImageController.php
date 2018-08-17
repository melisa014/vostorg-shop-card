<?php

namespace App\Controller;

use App\Service\FirmGetter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ItForFree\rusphp\File\Image\ImageResizer;

class ImageController extends Controller
{
    /**
     * @Route("/image", name="image")
     */
    public function showAction(Request $request)
//    @Route("/image/{path}/{format}", name="image")
//    public function showAction(string $path, string $format)
    {
        // ToDo: научиться передавать параметры из шаблона
//        dump($path);
//        dump($format);
//        die();
        dump($request->get('path'));
        dump($request->get('format'));
        die;

        ImageResizer::showInFormat($path, $format);

//        return new Response(Response::HTTP_OK);
    }
}
