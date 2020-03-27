<?php

namespace App\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use ItForFree\rusphp\File\Image\ImageResizer;
use Symfony\Component\Routing\Annotation\Route;

class ImageController extends AbstractController
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
     *
     * @param Request $request
     *
     * @throws Exception
     */
    public function showAction(Request $request)
    {
        ImageResizer::showInFormat(
            $this->rootImagesPath.$request->get('path'),
            $request->get('format')
        );
    }
}
