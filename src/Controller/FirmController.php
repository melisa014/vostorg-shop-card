<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Firm;
use App\Entity\Product;
use App\Service\FirmGetter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class FirmController extends Controller
{
    /**
     * @Route("/firm/{firmId}", name="firm_page")
     *
     * @param int $firmId
     *
     * @return Response
     */
    public function createPageAction(int $firmId, FirmGetter $firmGetter, string $rootPath): Response
    {
        $em = $this->getDoctrine()
                ->getManager();

        $firm = $em->getRepository(Firm::class)
                ->find($firmId);

        if (empty($firm)) {
            throw new EntityNotFoundException("Фирма с id = $firmId не найдена");
        }

        if ('garun' == $firm->getName()) {
            $pdfFilename = 'garun.pdf';

            $this->showGarunCatalog($pdfFilename, "$rootPath/../public/catalog/$pdfFilename");
        }

        $categories = [];

        foreach ($em->getRepository(Category::class)->findAll() as $category) {
            $categories[] = [
                'label' => $category->getLabel(),
                'products' => $em->getRepository(Product::class)
                    ->findBy([
                        'firm' => $firm,
                        'category' => $category,
                    ])
            ];
        }

        return $this->render('firm/page.html.twig',[
            'firms' => $firmGetter->getAll(),
            'firm' => $firm,
            'categories' => $categories,
        ]);
    }

    private function showGarunCatalog(string $pdfFilename, string $pathToFile)
    {
       $response = new BinaryFileResponse($pathToFile);

       $response->headers->set('Content-Type', 'application/pdf');
       $response->setContentDisposition(
          ResponseHeaderBag::DISPOSITION_INLINE, //use ResponseHeaderBag::DISPOSITION_ATTACHMENT to save as an attachement
          $pdfFilename
       );

       return $response;
    }
}
