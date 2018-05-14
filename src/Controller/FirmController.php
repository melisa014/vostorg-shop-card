<?php

namespace App\Controller;

use App\Entity\Firm;
use App\Entity\Product;
use App\Service\FirmGetter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
     * Lists all firm entities.
     *
     * @Route("/admin/firm", name="admin_firm_index")
     * 
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $firms = $em->getRepository('App:Firm')->findAll();

        return $this->render('firm/index.html.twig', array(
            'firms' => $firms,
        ));
    }

    /**
     * Creates a new firm entity.
     *
     * @Route("/admin/firm/new", name="admin_firm_new")
     * 
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, FirmGetter $firmGetter)
    {
        $firm = new Firm();
        $form = $this->createForm('App\Form\FirmType', $firm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($firm);
            $em->flush();

            return $this->redirectToRoute('admin_firm_show', array('id' => $firm->getId()));
        }

        return $this->render('firm/new.html.twig', array(
            'firm' => $firm,
            'form' => $form->createView(),
            'firms' => $firmGetter->getAll()
        ));
    }

    /**
     * Displays a form to edit an existing firm entity.
     *
     * @Route("/admin/firm/{id}/edit", name="admin_firm_edit")
     * 
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Firm $firm, FirmGetter $firmGetter)
    {
        $deleteForm = $this->createDeleteForm($firm);
        $editForm = $this->createForm('App\Form\FirmType', $firm);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_firm_index', array('id' => $firm->getId()));
        }

        return $this->render('firm/edit.html.twig', array(
            'firm' => $firm,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'firms' => $firmGetter->getAll()
        ));
    }

    /**
     * Deletes a firm entity.
     *
     * @Route("/admin/firm/{id}", name="admin_firm_delete")
     * 
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Firm $firm)
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
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Firm $firm)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_firm_delete', [
                'id' => $firm->getId(),
//                'firms' => $firmGetter->getAll()
                    ]))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
