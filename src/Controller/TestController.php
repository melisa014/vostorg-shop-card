<?php

namespace App\Controller;

use DateTimeImmutable;
use ItForFree\rusphp\Log\Time\Timer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class TestController extends AbstractController
{
    /**
     * @Route("/serializer")
     *
     * @throws ExceptionInterface
     */
    public function serializer()
    {
        $normalizer = new DateTimeNormalizer();
//        $serializer = new Serializer($normalizers);

        $newDate = new DateTimeImmutable();

        $normalizer->normalize($newDate);

        dump($normalizer);
        die('sfgsef');
    }

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
