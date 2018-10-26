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
            'basePath' => $this->get('kernel')->getRootDir(),
            'pageDescription' => 'Мебель-трансформер - это реальность! Компактные кровати-трансформеры сохранят уют и порядок в Вашем доме.
                Мебель изготовленная на заказ по Вашим эскизам или мебель эконом-класса. Готовые шкафчики - забирайте сегодня
                или помодульная сборка (с тысячей комбинаций). Спальни, гостиные, детские, прихожие, - у нас есть ВСЁ ВСЁ ВСЁ!',
            'pageKeywords' => 'мебель-трансформер, кровать-трансформер, трансформер, модульная мебель,
                спальня, гостиная, прихожая, мебель, мебель на заказ, мебель воронеж, мебель-трансформер воронеж,
                кровать-трансформер воронеж, салон мебели восторг, восторг воронеж',
        ]);
    }
}
