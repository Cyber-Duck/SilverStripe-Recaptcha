<?php

namespace CyberDuck\Recaptcha\Traits;

use SilverStripe\Control\Controller;
use CyberDuck\Recaptcha\Service\RecaptchaService;

/**
 * reCAPTCHA validator trait form form element(s)
 * 
 * @category   SilverStripe reCAPTCHA
 * @category   SilverStripe reCAPTCHA
 * @author     Andrew Mc Cormack <andy@cyber-duck.co.uk>
 * @copyright  Copyright (c) 2018, Andrew Mc Cormack
 * @license    https://github.com/cyber-duck/silverstripe-recaptcha/license
 * @version    1.0.0
 * @link       https://github.com/cyber-duck/silverstripe-recaptcha
 * @since      1.0.0
 */
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