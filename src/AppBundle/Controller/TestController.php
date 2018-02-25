<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ItForFree\rusphp\PHP\Time\Timer;

class TestController extends Controller
{
    /**
     * @Route("/test")
     */
    public function timer()
    {
//        Timer::start();
//        trim('8   ');
//        Timer::me();
        Timer::start();
        strval('8   ');
        Timer::me();
        
        
        die('sfgsef');
    }
}
