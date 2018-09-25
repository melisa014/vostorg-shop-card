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
        PhoneNumber $phone,
        string $message,
        ?Email $email,
        ?string $name,
    ) {
        $this->phone = $phone;
        $this->message = $message;
        $this->email = $email;
        $this->name = $name;
    }

    /**
     * @return PhoneNumber
     */
    public function getPhone(): PhoneNumber
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
     * @return Email | null
     */
    public function getEmail(): ?Email
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
