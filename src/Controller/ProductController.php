<?php

namespace App\Controller;

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
    
    /**
     * @Route("/", name="product_index")
     * 
     * @Method("GET")
     * 
     * @param FirmGetter $firmGetter
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
     * @Route("/new", name="product_new")
     * 
     * @Method({"GET", "POST"})
     * 
     * @param Request    $request
     * @param FirmGetter $firmGetter
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
            $file = $form->get('photo')->getData();
            $photoDescroption = $form->get('photoDescription')->getData();
            
            if (!empty($file)) {
                $fileName = $product->getVendorCode().'.'.$file->guessExtension();
                $filePath = $this->getParameter('kernel.project_dir')
                        .$this->getParameter('photo_directory')
                        .$product->getCategory()->getName()
                        .'/'.$fileName;

                $photo = new Photo();
                $photo->setName($fileName);
                $photo->setPath($filePath);
                $photo->setDescription($photoDescroption);
                $photo->setProduct($product);
                $product->addPhoto($photo);

                $file->move($filePath);

                $em->persist($photo);
            }
            
            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute('product_index');
        }
        
        return $this->render('product/new.html.twig', [
            'form' => $form->createView(),
            'firms' => $firmGetter->getAll()
        ]);
    }

    /**
     * @Route("/{id}/edit", name="product_edit")
     * 
     * @Method({"GET", "POST"})
     * 
     * @param Request    $request
     * @param Product    $product
     * @param FirmGetter $firmGetter
     * 
     * @return Response
     */
    public function editAction(Request $request, Product $product, FirmGetter $firmGetter): Response
    {
        $deleteForm = $this->createDeleteForm($product);
        $editForm = $this->createForm(ProductType::class, $product);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()
                    ->getManager()
                    ->flush();

            return $this->redirectToRoute('product_index');
        }

        return $this->render('product/edit.html.twig', [
            'product' => $product,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'firms' => $firmGetter->getAll()
        ]);
    }

    /**
     * @Route("/{id}", name="product_delete")
     * 
     * @Method("DELETE")
     * 
     * @param Request $request
     * @param Product $product
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
     * @param Product    $product
     * 
     * @return Form
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
