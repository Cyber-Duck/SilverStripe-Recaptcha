<?php

namespace CyberDuck\Recaptcha\Forms;

use CyberDuck\Recaptcha\Contract\RecaptchaElement;
use CyberDuck\Recaptcha\Traits\RecaptchaValidator;
use SilverStripe\Core\Environment;
use SilverStripe\Forms\LiteralField;
use SilverStripe\View\Requirements;

/**
 * reCAPTCHA form field
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
class RecaptchaField extends LiteralField implements RecaptchaElement
{
    use RecaptchaValidator;

    /**
     * reCAPTCHA site key
     *
     * @var string
     */
    protected $siteKey;

    /**
     * reCAPTCHA secret key
     *
     * @var string
     */
    protected $secretKey;

    /**
     * Sets the required properties and passes the reCAPTCAH HTML to the LiteralField parent class
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        Requirements::javascript('https://www.google.com/recaptcha/api.js');

        $this->siteKey = Environment::getEnv('RECAPTCHA_SITE_KEY');
        $this->secretKey = Environment::getEnv('RECAPTCHA_SECRET_KEY');

        parent::__construct($name, $this->getRecaptchaHTML());
    }

    /**
     * Returns the rendered reCAPTCHA HTML for output
     *
     * @return string
     */
	public function getRecaptchaHTML(): string
	{
		return sprintf(
            '<div class="g-recaptcha" data-sitekey="%s" id="recaptcha-field"></div><br>', 
            $this->siteKey
        );
    }
}