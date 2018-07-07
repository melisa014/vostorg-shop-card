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
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

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
     * @Route("/admin/product", name="admin_product_index")
     *
     * @Method("GET")
     *
     * @param Request    $request
     * @param FirmGetter $firmGetter
     *
     * @return Response
     */
    public function indexAction(Request $request, FirmGetter $firmGetter): Response
    {
        $page = $request->query->get('page', 1);

        $qb = $this->getDoctrine()
                ->getManager()
                ->getRepository(Product::class)
                ->findAllQueryBuilder();

        $adapter = new DoctrineORMAdapter($qb);
        $pagerfanta = new Pagerfanta($adapter);

        $pagerfanta->setMaxPerPage(2);
        $pagerfanta->setCurrentPage($page);

        $products = [];
        foreach ($pagerfanta->getCurrentPageResults() as $product) {
            $products[] = $product;
        }

        return $this->render('product/index.html.twig', [
            'products' => $products,
            'firms' => $firmGetter->getAll(),
            'my_pager' => $pagerfanta,
        ]);
    }

    /**
     * @Route("admin/product/new", name="admin_product_new")
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
            $em = $this->getDoctrine()
                    ->getManager();

            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $form->get('photo')->getData();
            $photoDescription = $form->get('photoDescription')->getData();

            if (!empty($file)) {
                $fileName = $product->getVendorCode().'.'.$file->getClientOriginalExtension();
                $filePath = $this->getParameter('photo_directory')
                        .'/'.$product->getFirm()->getName();

                $photo = new Photo();
                $photo->setName($fileName);
                $photo->setPath($filePath.'/'.$fileName);
                $photo->setDescription($photoDescription ?? '');
                $photo->setProduct($product);
                $product->addPhoto($photo);

                $file->move($this->getParameter('kernel.project_dir')
                        .'/'.'public'
                        .'/'.$filePath, $fileName);

                $em->persist($photo);
            }

            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute('admin_product_index');
        }

        return $this->render('product/new.html.twig', [
            'form' => $form->createView(),
            'firms' => $firmGetter->getAll()
        ]);
    }

    /**
     * @Route("/admin/product/{id}/edit", name="admin_product_edit")
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
            $em = $this->getDoctrine()
                    ->getManager();

            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $editForm->get('photo')->getData();
            $photoDescription = $editForm->get('photoDescription')->getData();

            if (!empty($file)) {
                $fileName = $product->getVendorCode().'.'.$file->getClientOriginalExtension();
                $filePath = $this->getParameter('photo_directory')
                        .'/'.$product->getFirm()->getName();

                $photo = new Photo();
                $photo->setName($fileName);
                $photo->setPath($filePath.'/'.$fileName);
                $photo->setDescription($photoDescription ?? '');
                $photo->setProduct($product);
                $product->addPhoto($photo);

                $file->move($this->getParameter('kernel.project_dir')
                        .'/'.'public'
                        .'/'.$filePath, $fileName);

                $em->persist($photo);
                $em->persist($product);

                $em->flush();
            }

            return $this->redirectToRoute('admin_product_index');
        }

        return $this->render('product/edit.html.twig', [
            'product' => $product,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'firms' => $firmGetter->getAll()
        ]);
    }

    /**
     * @Route("/admin/product/{id}", name="admin_product_delete")
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

        return $this->redirectToRoute('admin_product_index');
    }

    /**
     * @param Product $product
     *
     * @return Form
     */
    private function createDeleteForm(Product $product): Form
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_product_delete', [
                'id' => $product->getId(),
            ]))
            ->setMethod('DELETE')
            ->getForm();
    }
}
