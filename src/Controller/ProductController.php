<?php

namespace App\Controller;

use App\Entity\Product;
use App\Service\FirmGetter;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @var FirmGetter
     */
    private $firmGetter;

    /**
     * @param FirmGetter $firmGetter
     */
    public function __construct(FirmGetter $firmGetter)
    {
        $this->firmGetter = $firmGetter;
    }

    /**
     * @Route("/product/{productId}", name="product_page")
     *
     * @param int        $productId
     *
     * @return Response
     *
     * @throws EntityNotFoundException
     */
    public function createPageAction(int $productId): Response
    {
        $em = $this->getDoctrine()
                ->getManager();

        $product = $em->getRepository(Product::class)
                ->find($productId);

        if (empty($product)) {
            throw new EntityNotFoundException("Продукт с id = $productId не найден");
        }

        return $this->render('product/page.html.twig',[
            'firms' => $this->firmGetter->getAll(),
            'product' => $product,
        ]);
    }
}
