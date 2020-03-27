<?php

namespace App\Controller;

use App\Service\FirmGetter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @var FirmGetter
     */
    private $firmGetter;

    /**
     * @param FirmGetter $firmGetter
     */
    public function __construct(FirmGetter $firmGetter)
    {
        $this->firmGetter = $firmGetter;
    }

    /**
     * @Route("/", name="homepage")
     *
     * @return Response
     */
    public function indexAction(): Response
    {
        return $this->render('default/index.html.twig', [
            'firms' => $this->firmGetter->getAll(),
            'basePath' => $this->get('kernel')->getRootDir(),
            'pageDescription' => 'Мебель-трансформер - это реальность! Компактные кровати-трансформеры'
                .' сохранят уют и порядок в Вашем доме. Мебель изготовленная на заказ по Вашим эскизам'
                .' или мебель эконом-класса. Готовые шкафчики - забирайте сегодня или помодульная сборка'
                .' (с тысячей комбинаций). Спальни, гостиные, детские, прихожие, - у нас есть ВСЁ ВСЁ ВСЁ!',
            'pageKeywords' => 'мебель-трансформер, кровать-трансформер, трансформер, модульная мебель,
                спальня, гостиная, прихожая, мебель, мебель на заказ, мебель воронеж, мебель-трансформер воронеж,
                кровать-трансформер воронеж, салон мебели восторг, восторг воронеж',
        ]);
    }
}
