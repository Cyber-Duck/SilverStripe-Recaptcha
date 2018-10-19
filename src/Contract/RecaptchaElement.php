<?php

namespace CyberDuck\Recaptcha\Contract;

interface RecaptchaElement
{
    public function getRecaptchaHTML(): string;
}