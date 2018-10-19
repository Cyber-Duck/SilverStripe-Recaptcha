<?php

namespace CyberDuck\Recaptcha\Service;

use CyberDuck\Recaptcha\Contract\RecaptchaElement;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Forms\Validator;

class RecaptchaService
{
    protected $field;
    
    protected $validator;
    
    protected $request;
    
    protected $client;

    protected $endpoint = 'https://www.google.com/recaptcha/api/siteverify';

    public function __construct(RecaptchaElement $field, Validator $validator, HTTPRequest $request)
    {
        $this->field = $field;
        $this->validator = $validator;
        $this->request = $request;
        $this->client = new Client();
    }

    public function validate(): bool
    {
        if(!$this->request->postVar('g-recaptcha-response')) {
            $this->setRecaptchaErrorMessage('reCAPTCHA field is required');
            return false;
        }
        return $this->validateRequest();
    }

    private function validateRequest(): bool
    {
        $response = $this->client->request('POST', 
            $this->getRecaptchaRequestEndpoint(), []
        );
        $body = json_decode((string) $response->getBody());
        if(!is_object($body)) {
            $this->setRecaptchaErrorMessage('reCAPTCHA request error');
            return false;
        }
        if(!property_exists($body, 'success')) {
            $this->setRecaptchaErrorMessage('reCAPTCHA request success error');
            return false;
        }
        if($body->success !== true) {
            $this->setRecaptchaErrorMessage('reCAPTCHA does not match');
            return false;
        }
        return true;
    }

    private function setRecaptchaErrorMessage(string $message): void
    {
        $this->validator->validationError(
            $this->field->getName(),
            'Invalid reCAPTCHA',
            'required'
        );
    }

    private function getRecaptchaRequestEndpoint(): string
    {
        $params = http_build_query([
            'secret'   => $this->secretKey,
            'response' => $this->request->postVar('g-recaptcha-response')
        ]);
        return $this->endpoint.'?'.$params;
    }
}