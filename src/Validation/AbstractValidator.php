<?php

namespace App\Validation;

use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class AbstractValidator
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @param ValidatorInterface $validator
     */
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Возвращает правила валидации
     *
     * @return array
     */
    abstract protected function getConstraints(): array;

    /**
     * Возвращает список необязательных полей
     *
     * @return array
     */
    abstract protected function getOptionalFields(): array;

    /**
     * Валидирует данные и возвращает массив с ошибками (или пустой массив, если ошибок нет)
     *
     * @param array $requestFields
     *
     * @return array
     */
    public function validate(array $requestFields): array
    {
        // Удаление правил валидации для необязательных полей, которые не пришли
        $constraints = array_filter(
            $this->getConstraints(),
            function (string $fieldName) use ($requestFields): bool {
                if (!in_array($fieldName, $this->getOptionalFields())) {
                    return true;
                }

                return key_exists($fieldName, $requestFields);
            },
            ARRAY_FILTER_USE_KEY
        );

        $errors = [];

        /**
         * @var ConstraintViolation $violation
         */
        foreach ($this->validator->validate($requestFields, new Collection($constraints)) as $violation) {
            $field = preg_replace(['/\]\[/', '/\[|\]/'], ['.', ''], $violation->getPropertyPath());
            $errors[$field] = $violation->getMessage();
        }

        return $errors;
    }
}