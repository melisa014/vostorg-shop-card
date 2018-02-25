<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Form\ProductType;
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
     * Lists all product entities.
     *
     * @Route("/", name="product_index")
     * 
     * @Method("GET")
     * 
     * @return Response
     */
    public function indexAction(): Response
    {
        $products = $this->getDoctrine()
                ->getManager()
                ->getRepository(Product::class)
                ->findAll();

        return $this->render('product/index.html.twig', [
            'products' => $products,
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
    public function newAction(Request $request): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $data = $form->getData();
            $product->setName($data['name']);
            $product->setDescription($data['description']);
            $product->setPrice($data['price']);
            $product->setCategory($data['category']);
            $product->setVendorCode($data['vendorCode']);
            $product->setColor($data['color']);
            
            
            // TODO: photo file upload with vich. bundle
            
            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute('product_show', [
                'id' => $product->getId(),
            ]);
        }

        return $this->render('product/new.html.twig', array(
            'product' => $product,
            'form' => $form->createView(),
        ));
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
    public function showAction(Product $product): Response
    {
        $deleteForm = $this->createDeleteForm($product);

        return $this->render('product/show.html.twig', [
            'product' => $product,
            'delete_form' => $deleteForm->createView(),
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
    public function editAction(Request $request, Product $product): Response
    {
        $deleteForm = $this->createDeleteForm($product);
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
        $form = $this->createDeleteForm($product);
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
    private function createDeleteForm(Product $product): Form
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('product_delete', [
                'id' => $product->getId(),
            ]))
            ->setMethod('DELETE')
            ->getForm();
    }
}
