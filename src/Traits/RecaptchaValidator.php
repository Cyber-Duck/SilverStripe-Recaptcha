<?php

namespace CyberDuck\Recaptcha\Traits;

use SilverStripe\Control\Controller;
use CyberDuck\Recaptcha\Service\RecaptchaService;

trait RecaptchaValidator
{
    public function validate($validator)
    {
        $service = new RecaptchaService(
            $this, 
            $validator, 
            Controller::curr()->getRequest()
        );
        return $service->validate();
    }
}