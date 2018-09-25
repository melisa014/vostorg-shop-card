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
            (new Swift_Message('Webbankir feedback'))
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
            'feedback_sent' => true,
            'firms' => $firmGetter->getAll(),
            'basePath' => $this->get('kernel')->getRootDir()
        ]);
    }
}
