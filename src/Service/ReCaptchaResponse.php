<?php

namespace App\Service;

/**
 * A ReCaptchaResponse is returned from checkAnswer().
 */
class ReCaptchaResponse
{
    public $success;
    public $errorCodes;
}
