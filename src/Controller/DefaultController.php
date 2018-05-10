<?php

namespace App\Controller;

use App\Service\FirmGetter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * 
     * @return Response
     */
    public function indexAction(Request $request, FirmGetter $firmGetter): Response
    {
        return $this->render('default/index.html.twig', [
            'firms' => $firmGetter->getAll(),
        ]);
    }
    /**
     * @Route("/about", name="about")
     * 
     * @return Response
     */
    public function aboutAction(Request $request): Response
    {
        return $this->render('default/about.html.twig', [
            'template' => 'about',
        ]);
    }
    /**
     * @Route("/contacts", name="contacts")
     * 
     * @return Response
     */
    public function contactsAction(Request $request): Response
    {
        return $this->render('default/contacts.html.twig', [
            'template' => 'contacts',
        ]);
    }
    /**
     * @Route("/order", name="order")
     * 
     * @return Response
     */
    public function orderAction(Request $request): Response
    {
        return $this->render('default/order.html.twig', [
            'template' => 'order',
        ]);
    }
}
