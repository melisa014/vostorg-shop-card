<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Photo;
use App\Entity\Product;
use App\Form\ProductType;
use App\Service\FirmGetter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("product")
 */
class ProductController extends Controller
{
    /**
     * @Route("/product/{productId}", name="product_page")
     * 
     * @param int $productId
     * 
     * @return Response
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
    
    /**
     * Lists all product entities.
     *
     * @Route("/", name="product_index")
     * 
     * @Method("GET")
     * 
     * @return Response
     */
    public function indexAction(FirmGetter $firmGetter): Response
    {
        $products = $this->getDoctrine()
                ->getManager()
                ->getRepository(Product::class)
                ->findAll();

        return $this->render('product/index.html.twig', [
            'products' => $products,
            'firms' => $firmGetter->getAll()
        ]);
    }

    /**
     * Creates a new product entity.
     *
     * @Route("/new", name="product_new")
     * 
     * @Method({"GET", "POST"})
     * 
     * @return Response
     */
    public function newAction(Request $request, FirmGetter $firmGetter): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
           
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            dump($form->getData());
            dump($_FILES);
//            dump($file);
            die('sfse');
            
            if (!empty($file)) {
                $fileName = $product->getVendorCode().'.'.$file->guessExtension();
                $filePath = $this->getParameter('kernel.project_dir')
                        .$this->getParameter('photo_directory')
                        .$product->getCategory()->getName()
                        .'/'.$fileName;

                $photo = new Photo();
                $photo->setName($fileName);
                $photo->setPath($filePath);
                $photo->setProduct($product);
                $product->addPhoto($photo);

                $file->move($filePath);

                $em->persist($photo);
            }
            
            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute('product_show', [
                'id' => $product->getId(),
                'firms' => $firmGetter->getAll(),
            ]);
        }
        
        return $this->render('product/new.html.twig', [
            'form' => $form->createView(),
            'firms' => $firmGetter->getAll()
        ]);
    }

    /**
     * Finds and displays a product entity.
     *
     * @Route("/{id}", name="product_show")
     * 
     * @Method("GET")
     * 
     * @return Response
     */
    public function showAction(Product $product, FirmGetter $firmGetter): Response
    {
        $deleteForm = $this->createDeleteForm($product, $firmGetter);

        return $this->render('product/show.html.twig', [
            'product' => $product,
            'delete_form' => $deleteForm->createView(),
            'firms' => $firmGetter->getAll()
        ]);
    }

    /**
     * Displays a form to edit an existing product entity.
     *
     * @Route("/{id}/edit", name="product_edit")
     * 
     * @Method({"GET", "POST"})
     * 
     * @return Response
     */
    public function editAction(Request $request, Product $product, FirmGetter $firmGetter): Response
    {
        $deleteForm = $this->createDeleteForm($product, $firmGetter);
        $editForm = $this->createForm(ProductType::class, $product);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()
                    ->getManager()
                    ->flush();

            return $this->redirectToRoute('product_edit', [
                'id' => $product->getId(),
            ]);
        }

        return $this->render('product/edit.html.twig', [
            'product' => $product,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'firms' => $firmGetter->getAll()
        ]);
    }

    /**
     * Deletes a product entity.
     *
     * @Route("/{id}", name="product_delete")
     * 
     * @Method("DELETE")
     * 
     * @return Response
     */
    public function deleteAction(Request $request, Product $product): Response
    {
        $form = $this->createDeleteForm($product, $firmGetter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()
                    ->getManager();
            // TODO: переделать на софт-удаление
            $em->remove($product);
            $em->flush();
        }

        return $this->redirectToRoute('product_index');
    }

    /**
     * Creates a form to delete a product entity.
     *
     * @param Product $product The product entity
     *
     * @return Form The form
     */
    private function createDeleteForm(Product $product, FirmGetter $firmGetter): Form
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('product_delete', [
                'id' => $product->getId(),
                'firms' => $firmGetter->getAll()
            ]))
            ->setMethod('DELETE')
            ->getForm();
    }
}
