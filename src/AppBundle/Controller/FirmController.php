<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Firm;
use AppBundle\Form\FirmType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Firm controller.
 *
 * @Route("firm")
 */
class FirmController extends Controller
{
    /**
     * Lists all firm entities.
     *
     * @Route("/", name="firm_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $firms = $em->getRepository('AppBundle:Firm')->findAll();

        return $this->render('firm/index.html.twig', array(
            'firms' => $firms,
        ));
    }

    /**
     * Creates a new firm entity.
     *
     * @Route("/new", name="firm_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $firm = new Firm();
        $form = $this->createForm('AppBundle\Form\FirmType', $firm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($firm);
            $em->flush();

            return $this->redirectToRoute('firm_show', array('id' => $firm->getId()));
        }

        return $this->render('firm/new.html.twig', array(
            'firm' => $firm,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a firm entity.
     *
     * @Route("/{id}", name="firm_show")
     * @Method("GET")
     */
    public function showAction(Firm $firm)
    {
        $deleteForm = $this->createDeleteForm($firm);

        return $this->render('firm/show.html.twig', array(
            'firm' => $firm,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing firm entity.
     *
     * @Route("/{id}/edit", name="firm_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Firm $firm)
    {
        $deleteForm = $this->createDeleteForm($firm);
        $editForm = $this->createForm('AppBundle\Form\FirmType', $firm);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('firm_edit', array('id' => $firm->getId()));
        }

        return $this->render('firm/edit.html.twig', array(
            'firm' => $firm,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a firm entity.
     *
     * @Route("/{id}", name="firm_delete")
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

        return $this->redirectToRoute('firm_index');
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
            ->setAction($this->generateUrl('firm_delete', array('id' => $firm->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
