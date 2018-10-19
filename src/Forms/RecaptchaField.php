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

    protected $siteKey;

    protected $secretKey;

    public function __construct(string $name)
    {
        Requirements::javascript('https://www.google.com/recaptcha/api.js');
        Requirements::javascript('https://www.google.com/recaptcha/api/js/recaptcha_ajax.js');

        $this->siteKey = Environment::getEnv('RECAPTCHA_SITE_KEY');
        $this->secretKey = Environment::getEnv('RECAPTCHA_SECRET_KEY');

        parent::__construct($name, $this->getRecaptchaHTML());
    }

	public function getRecaptchaHTML(): string
	{
		return sprintf(
            '<div class="g-recaptcha" data-sitekey="%s" id="recaptcha-field"></div><br>', 
            $this->siteKey
        );
    }
}