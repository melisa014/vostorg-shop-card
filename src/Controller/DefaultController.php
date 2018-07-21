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
//        $firms = [];
//
//        foreach ($firmGetter->getAll() as $firm) {
//            $firms[] = [
//                'id' => $firm->getId(),
//                'name' => $firm->getName(),
//                'label' => $firm->getLabel(),
//                'description' => $firm->getDescription(),
//                'photoPath' => ImageResizer::resizeAsInFormat(
//                    dirname(__DIR__, 2).'/public'.$firm->getPhotoPath(),
//                    '350x230xSxCxP'
//                ),
//            ];
//        }

        return $this->render('default/index.html.twig', [
//            'firms' => $firms,
            'firms' => $firmGetter->getAll(),
            'basePath' => $this->get('kernel')->getRootDir()
        ]);
    }
}
