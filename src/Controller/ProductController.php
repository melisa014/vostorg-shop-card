<?php

namespace App\Controller;

use App\Entity\Product;
use App\Service\FirmGetter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ProductController extends Controller
{
    /**
     * @Route("/product/{productId}", name="product_page")
     *
     * @param int        $productId
     * @param FirmGetter $firmGetter
     *
     * @return Response
     *
     * @throws EntityNotFoundException
     */
    public function createPageAction(int $productId, FirmGetter $firmGetter): Response
    {
        $em = $this->getDoctrine()
                ->getManager();

        $product = $em->getRepository(Product::class)
                ->find($productId);

        if (empty($product)) {
            throw new EntityNotFoundException("Продукт с id = $productId не найден");
        }

        return $this->render('product/page.html.twig',[
            'firms' => $firmGetter->getAll(),
            'product' => $product,
        ]);
    }
}
