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
            'firmLabel' => $firm->getLabel(),
            'firmId' => $firm->getId(),
            'products' => $products,
        ]);
    }

    /**
     * @Route("/admin/firm", name="admin_firm_index")
     * 
     * @Method("GET")
     * 
     * @return Response
     */
    public function indexAction(): Response
    {
        $em = $this->getDoctrine()->getManager();

        $firms = $em->getRepository(Firm::class)->findAll();

        return $this->render('firm/index.html.twig', array(
            'firms' => $firms,
        ));
    }

    /**
     * @Route("/admin/firm/new", name="admin_firm_new")
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
        $firm = new Firm();
        $form = $this->createForm(FirmType::class, $firm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $form->get('photo')->getData();
            
            if (!empty($file)) {
                $fileName = $firm->getName().'.'.$file->getClientOriginalExtension();
                $filePath = $this->getParameter('firm_photo_directory');

                $firm->setPathToPhoto($filePath.'/'.$fileName);

                $file->move($this->getParameter('kernel.project_dir')
                        .'/'.'public'
                        .'/'.$filePath, $fileName);
            }
            
            $em->persist($firm);
            $em->flush();

            return $this->redirectToRoute('admin_firm_index');
        }

        return $this->render('firm/new.html.twig', array(
            'firm' => $firm,
            'form' => $form->createView(),
            'firms' => $firmGetter->getAll()
        ));
    }

    /**
     * @Route("/admin/firm/{id}/edit", name="admin_firm_edit")
     * 
     * @Method({"GET", "POST"})
     * 
     * @param Request    $request
     * @param Firm       $firm
     * @param FirmGetter $firmGetter
     * 
     * @return Response
     */
    public function editAction(Request $request, Firm $firm, FirmGetter $firmGetter): Response
    {
        $deleteForm = $this->createDeleteForm($firm);
        $editForm = $this->createForm(FirmType::class, $firm);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
        
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $editForm->get('photo')->getData();
            
            if (!empty($file)) {
                $fileName = $firm->getName().'.'.$file->getClientOriginalExtension();
                $filePath = $this->getParameter('firm_photo_directory');

                $firm->setPathToPhoto($filePath.'/'.$fileName);

                $file->move($this->getParameter('kernel.project_dir')
                        .'/'.'public'
                        .'/'.$filePath, $fileName);
            }
        
            $em->persist($firm);
            $em->flush();

            return $this->redirectToRoute('admin_firm_index');
        }

        return $this->render('firm/edit.html.twig', array(
            'firm' => $firm,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'firms' => $firmGetter->getAll()
        ));
    }

    /**
     * @Route("/admin/firm/{id}", name="admin_firm_delete")
     * 
     * @Method("DELETE")
     * 
     * @param Request $request
     * @param Firm    $firm
     * 
     * @return Response
     */
    public function deleteAction(Request $request, Firm $firm): Response
    {
        $form = $this->createDeleteForm($firm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($firm);
            $em->flush();
        }

        return $this->redirectToRoute('admin_firm_index');
    }

    /**
     * Creates a form to delete a firm entity.
     *
     * @param Firm $firm The firm entity
     *
     * @return Form The form
     */
    private function createDeleteForm(Firm $firm): Form
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_firm_delete', [
                'id' => $firm->getId(),
                    ]))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
