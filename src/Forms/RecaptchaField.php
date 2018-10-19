<?php

namespace CyberDuck\Recaptcha\Forms;

use CyberDuck\Recaptcha\Contract\RecaptchaElement;
use CyberDuck\Recaptcha\Traits\RecaptchaValidator;
use SilverStripe\Core\Environment;
use SilverStripe\Forms\LiteralField;
use SilverStripe\View\Requirements;

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