<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ItForFree\rusphp\File\Image\ImageResizer;

class ImageController extends Controller
{
    /**
     * @var string
     */
    private $rootImagesPath;

    /**
     * @param string $rootPath
     */
    public function __construct(string $rootPath)
    {
        $this->rootImagesPath = $rootPath.'/../public';
    }

    /**
     * @Route("/image", name="image")
     */
    public function showAction(Request $request)
    {
//        dump($request->get('path'));
//        die;
        ImageResizer::showInFormat($this->rootImagesPath.$request->get('path'), $request->get('format'));
    }
}
