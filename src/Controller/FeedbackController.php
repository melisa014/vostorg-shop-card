<?php

namespace App\Controller;

use App\DTO\FeedbackData;
use Swift_Attachment;
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
     *
     * @return Response
     */
    private function sendFeedbackMail(FeedbackData $feedbackData, string $adminEmail): Response
    {
        $email = $feedbackData->getEmail();
        $name = $feedbackData->getName();

        $mail = (new Swift_Message('Webbankir feedback'))
            ->setFrom($this->getParameter('senderEmail'))
            ->setTo($adminEmail)
            ->setBody(
                "Email: $email\n" .
                "Телефон: {$feedbackData->getPhone()}\n" .
                "Имя: $name\n" .
                "Текст: {$feedbackData->getMessage()}"
            );

        $this->mailer->send($mail);

        return new Response();
    }
}
