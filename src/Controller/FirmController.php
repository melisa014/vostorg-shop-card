<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Firm;
use App\Entity\Product;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class FirmController extends AbstractController
{
    /**
     * @Route("/firm/{firmId}", name="firm_page")
     *
     * @param int $firmId
     *
     * @return Response
     *
     * @throws EntityNotFoundException
     */
    public function createPageAction(int $firmId): Response
    {
        $em = $this->getDoctrine()
                ->getManager();

        $firm = $em->getRepository(Firm::class)
                ->find($firmId);

        if (empty($firm)) {
            throw new EntityNotFoundException("Фирма с id = $firmId не найдена");
        }

        if ('garun' == $firm->getName()) {
            return $this->render('firm/garun_page.html.twig', [
                'firm' => $firm,
            ]);
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
            'firm' => $firm,
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/firm/garun/open-catalog", name="open_garun_catalog")
     *
     * @param string $rootPath
     *
     * @return BinaryFileResponse
     */
    public function showGarunCatalog(string $rootPath)
    {
        $pdfFilename = 'garun.pdf';

        $response = new BinaryFileResponse("$rootPath/../public/catalog/$pdfFilename");

        $response->headers->set('Content-Type', 'application/pdf');
        $response->setContentDisposition(
           ResponseHeaderBag::DISPOSITION_INLINE,
           $pdfFilename
        );

        return $response;
    }

    /**
     * @Route("/firm/garun/download-catalog", name="download_garun_catalog")
     *
     * @param string $rootPath
     *
     * @return BinaryFileResponse
     */
    public function downloadGarunCatalog(string $rootPath)
    {
        $pdfFilename = 'garun.pdf';

        $response = new BinaryFileResponse("$rootPath/../public/catalog/$pdfFilename");

        $response->headers->set('Content-Type', 'application/pdf');
        $response->setContentDisposition(
           ResponseHeaderBag::DISPOSITION_ATTACHMENT,
           $pdfFilename
        );

        return $response;
    }
}
