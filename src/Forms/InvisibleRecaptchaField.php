<?php

namespace CyberDuck\Recaptcha\Forms;

use CyberDuck\Recaptcha\Contract\RecaptchaElement;
use CyberDuck\Recaptcha\Traits\RecaptchaValidator;
use SilverStripe\Control\Controller;
use SilverStripe\Core\Environment;
use SilverStripe\Forms\LiteralField;
use SilverStripe\View\Requirements;

class InvisibleRecaptchaField extends LiteralField implements RecaptchaElement
{
    use RecaptchaValidator;
    
    protected $formSelector;

    protected $container;

    protected $siteKey;

    protected $secretKey;

    public function __construct(string $name, string $formSelector, string $container)
    {
        Requirements::javascript('https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit', [
            "async" => true,
            "defer" => true,
        ]);
        $this->formSelector = $formSelector;
        $this->container = $container;

        $this->siteKey = Environment::getEnv('RECAPTCHA_INVISIBLE_SITE_KEY');
        $this->secretKey = Environment::getEnv('RECAPTCHA_INVISIBLE_SECRET_KEY');

        parent::__construct($name, $this->getRecaptchaHTML());
    }

	public function getRecaptchaHTML(): string
	{
        return Controller::curr()->customise([
            'FormSelector' => $this->formSelector,
            'Container' => $this->container,
            'SiteKey' => Environment::getEnv('RECAPTCHA_INVISIBLE_SITE_KEY')
        ])->renderWith('Forms/InvisibleRecaptcha');
    }
}