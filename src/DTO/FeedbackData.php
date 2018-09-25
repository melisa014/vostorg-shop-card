<?php

namespace App\DTO;

class FeedbackData
{
    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $message;

    /**
     * @var string | null
     */
    private $email;

    /**
     * @var string | null
     */
    private $name;

    /**
     * @param PhoneNumber   $phone
     * @param string        $message
     * @param Email | null  $email
     * @param string | null $name
     */
    public function __construct(
        string $phone,
        string $message,
        ?string $email,
        ?string $name
    ) {
        $this->phone = $phone;
        $this->message = $message;
        $this->email = $email;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return string | null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return string | null
     */
    public function getName(): ?string
    {
        return $this->name;
    }
}
