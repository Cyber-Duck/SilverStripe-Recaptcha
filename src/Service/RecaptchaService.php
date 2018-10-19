<?php

namespace CyberDuck\Recaptcha\Service;

use CyberDuck\Recaptcha\Contract\RecaptchaElement;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Forms\Validator;

/**
 * Service to validate the passed reCAPTCHA value and reCAPTCHA API response
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
class RecaptchaService
{
    /**
     * RecaptchaElement form field
     *
     * @var RecaptchaElement
     */
    protected $field;
    
    /**
     * Form field validator instance
     *
     * @var Validator
     */
    protected $validator;
    
    /**
     * Controller request
     *
     * @var HTTPRequest
     */
    protected $request;
    
    /**
     * HTTP client instance
     *
     * @var Client
     */
    protected $client;

    /**
     * reCAPTCHA API endpoint
     *
     * @var string
     */
    protected $endpoint = 'https://www.google.com/recaptcha/api/siteverify';

    /**
     * Sets the required properties
     *
     * @param RecaptchaElement $field
     * @param Validator $validator
     * @param HTTPRequest $request
     */
    public function __construct(RecaptchaElement $field, Validator $validator, HTTPRequest $request)
    {
        $this->field = $field;
        $this->validator = $validator;
        $this->request = $request;
        $this->client = new Client();
    }

    /**
     * Performs the reCAPTCHA validation
     *
     * @return boolean
     */
    public function validate(): bool
    {
        if(!$this->request->postVar('g-recaptcha-response')) {
            $this->setRecaptchaErrorMessage('reCAPTCHA field is required');
            return false;
        }
        return $this->validateRequest();
    }

    /**
     * Performs the reCAPTCHA API request validation
     *
     * @return boolean
     */
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

    /**
     * Sets an error message on the form field
     *
     * @param string $message
     * @return void
     */
    private function setRecaptchaErrorMessage(string $message): void
    {
        $this->validator->validationError(
            $this->field->getName(),
            $message,
            'required'
        );
    }

    /**
     * Builds the reCAPTCHA API endpoint URI
     *
     * @return string
     */
    private function getRecaptchaRequestEndpoint(): string
    {
        $params = http_build_query([
            'secret'   => $this->secretKey,
            'response' => $this->request->postVar('g-recaptcha-response')
        ]);
        return $this->endpoint.'?'.$params;
    }
}