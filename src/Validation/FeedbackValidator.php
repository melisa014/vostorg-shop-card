<?php

namespace App\Validation;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Collection;

class FeedbackValidator extends AbstractValidator
{
    /**
     * Возвращает список полей с правилами валидации
     *
     * @return Collection
     */
    protected function getConstraint(): Collection
    {
        return new Collection([
            'name' => $this->getNameRules(),
            'email' => $this->getNameRules(),
            'phone' => $this->getPhoneRules(),
            'message' => $this->getNameRules(),
            'route' => $this->getNameRules(),
        ]);
    }

    /**
     * Возвращает текст сообщения об ошибке не заполненого поля
     *
     * @return string
     */
    private function getMessageForNotBlank(): string
    {
        return 'Поле обязательно к заполнению';
    }

    /**
     * Возвращает правила валидации для имени пользователя
     *
     * @return array
     */
    private function getNameRules(): array
    {
        return [
            new Assert\NotBlank([
                'message' => $this->getMessageForNotBlank(),
            ]),
            new Assert\Type([
                'type' => "string",
            ]),
        ];
    }

    /**
     * Возвращает правила валидации для телефона пользователя
     *
     * @return array
     */
    private function getPhoneRules(): array
    {
        return [
            new Assert\NotBlank([
                'message' => $this->getMessageForNotBlank(),
            ]),
            new Assert\Regex([
                'pattern' => "/^\+7[0-9]{10}$/x",
                'message' => 'Введите номер телефона в формате +79876543210',
            ]),
        ];
    }
}