<?php

namespace App\Controller;

use App\Service\FirmGetter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ItForFree\rusphp\File\Image\ImageResizer;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     *
     * @return Response
     */
    public function indexAction(Request $request, FirmGetter $firmGetter): Response
    {
        return $this->render('default/index.html.twig', [
            'firms' => $firmGetter->getAll(),
            'basePath' => $this->get('kernel')->getRootDir()
        ]);
    }
}
