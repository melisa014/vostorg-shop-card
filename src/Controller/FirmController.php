<?php

namespace App\Controller;

use App\Entity\Firm;
use App\Entity\Product;
use App\Service\FirmGetter;
use App\Form\FirmType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class FirmController extends Controller
{
    /**
     * @Route("/firm/{firmId}", name="firm_page")
     *
     * @param int $firmId
     *
     * @return Response
     */
    public function createPageAction(int $firmId, FirmGetter $firmGetter): Response
    {
        $em = $this->getDoctrine()
                ->getManager();

        $firm = $em->getRepository(Firm::class)
                ->find($firmId);

        if (empty($firm)) {
            throw new EntityNotFoundException("Фирма с id = $firmId не найдена");
        }

        // Достаём все продукты фирмы и выводим на страницу
        $products = $em->getRepository(Product::class)
                ->findBy([
                    'firm' => $firm,
                ]);

        return $this->render('firm/page.html.twig',[
            'firms' => $firmGetter->getAll(),
            'firm' => $firm,
            'firmId' => $firm->getId(),
            'products' => $products,
        ]);
    }
}
