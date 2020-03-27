<?php

namespace App\Controller;

use ItForFree\rusphp\Log\Time\Timer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
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
