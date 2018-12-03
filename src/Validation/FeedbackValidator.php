<?php

namespace App\Validation;

use Symfony\Component\Validator\Constraints as Assert;

class FeedbackValidator extends AbstractValidator
{
    /**
     * Возвращает список полей с правилами валидации
     *
     * @return array
     */
    protected function getConstraints(): array
    {
        return [
            'phone' => $this->getPhoneNumberRules(),
            'message' => $this->getNotBlankRules(),
            'name' => $this->getNameRules(),
            'email' => $this->getEmailRules(),
            'recapcha' => $this->getNotBlankRules(),
        ];
    }

    /**
     * @return array
     */
    protected function getOptionalFields(): array
    {
        return [
            'name',
            'email',
        ];
    }

    /**
     * Возвращает правила валидации номера телефона
     *
     * @return array
     */
    private function getPhoneNumberRules(): array
    {
        return [
            new Assert\NotBlank([
                'message' => 'Поле обязательно к заполнению'
            ]),
            new Assert\Regex([
                'pattern' => '/^\d{11}$/',
                'message' => 'Номер телефона должен состоять из 11 цифр',
            ])
        ];
    }

    /**
     * Возвращает правила валидации для e-mail
     *
     * @return array
     */
    private function getEmailRules(): array
    {
        return [
            new Assert\Email([
                'message' => 'Недопустимое значение e-mail',
            ]),
        ];
    }

    /**
     * @return array
     */
    private function getNameRules(): array
    {
        return [];
    }

    /**
     * @return array
     */
    private function getNotBlankRules(): array
    {
        return [
            new Assert\NotBlank([
                'message' => 'Поле обязательно к заполнению'
            ]),
        ];
    }
}
