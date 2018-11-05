<?php

namespace App\Controller;

use App\DTO\FeedbackData;
use App\Service\FirmGetter;
use Swift_Mailer;
use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FeedbackController extends Controller
{
    /**
     * @var Swift_Mailer
     */
    private $mailer;

    /**
     * @param Swift_Mailer $mailer
     */
    public function __construct(Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @Route("/feedback", name="feedback", methods={"POST"})
     *
     * @param FeedbackData $feedbackData
     * @param string       $adminEmail
     * @param FirmGetter   $firmGetter
     *
     * @return Response
     */
    public function sendFeedbackMail(FeedbackData $feedbackData, string $adminEmail, FirmGetter $firmGetter): Response
    {
        $email = $feedbackData->getEmail();
        $name = $feedbackData->getName();

        $mail = $this->mailer->send(
            (new Swift_Message('Восторг почта'))
            ->setFrom($this->getParameter('senderEmail'))
            ->setTo($adminEmail)
            ->setBody(
                "Email: $email\n" .
                "Телефон: {$feedbackData->getPhone()}\n" .
                "Имя: $name\n" .
                "Текст: {$feedbackData->getMessage()}"
            )
        );

        return $this->render('default/index.html.twig', [
            'feedback' => 'sent',
            'firms' => $firmGetter->getAll(),
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
