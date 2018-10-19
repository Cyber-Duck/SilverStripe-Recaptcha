<?php

namespace CyberDuck\Recaptcha\Contract;

/**
 * Interface for reCAPTCHA form fields
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
interface RecaptchaElement
{
    public function getRecaptchaHTML(): string;
}