<?php

namespace App\Controller;

use App\Validation\FeedbackValidator;
use App\Service\FeedbackMailSender;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Exception\ValidatorException;

class FeedbackController extends Controller
{
    /**
     * @Route("/feedback", name="feedback")
     *
     * @Method("POST")
     *
     * @param Request            $request
     * @param FeedbackMailSender $feedbackMailSender
     *
     * @return Response
     *
     * @throws ValidatorException
     */
    public function indexAction(Request $request, FeedbackMailSender $feedbackMailSender): Response
    {
        // Валидируем данные, введённые пользователем
        $errors = (new FeedbackValidator())->validate($request->request->all());

        if (!empty($errors)) {
            throw new ValidatorException('Введённые данные некорректны: '.json_encode($errors));
        }

        $feedbackMailSender->sendFeedback(
            $request->get('name'),
            $request->get('email'),
            $request->get('phone'),
            $request->get('message')
        );

        return $this->redirectToRoute('homepage', [
            'feedback' => 'sent',
        ]);
    }
}
