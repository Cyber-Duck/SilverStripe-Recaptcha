# Silverstripe-Recaptcha
Standard reCAPTCHA and invisible reCAPTCHA form fields for SilverStripe

[![Latest Stable Version](https://poser.pugx.org/cyber-duck/silverstripe-recaptcha/v/stable)](https://packagist.org/packages/cyber-duck/silverstripe-recaptcha)
[![Latest Unstable Version](https://poser.pugx.org/cyber-duck/silverstripe-recaptcha/v/unstable)](https://packagist.org/packages/cyber-duck/silverstripe-recaptcha)
[![Total Downloads](https://poser.pugx.org/cyber-duck/silverstripe-recaptcha/downloads)](https://packagist.org/packages/cyber-duck/silverstripe-recaptcha)
[![License](https://poser.pugx.org/cyber-duck/silverstripe-recaptcha/license)](https://packagist.org/packages/cyber-duck/silverstripe-recaptcha)

Author: [Andrew Mc Cormack](https://github.com/Andrew-Mc-Cormack)

**For SilverStripe 4.* **

## Standard Recaptcha

Add 2 .env vars with your recaptcha keys

```
RECAPTCHA_SITE_KEY="0000000000"
RECAPTCHA_SECRET_KEY="0000000000"
```

Add the field to any form on your site just as you would any other field.
Pass in the field name.

```php
RecaptchaField::create('Recaptcha');
```

## Invisible Recaptcha

Add 2 .env vars with your recaptcha keys

```
RECAPTCHA_INVISIBLE_SITE_KEY="0000000000"
RECAPTCHA_INVISIBLE_SECRET_KEY="0000000000"
```

Add the field to any form on your site just as you would any other field.
Pass in the field name, the form ID, and the HTML element to render the reCAPTCHA widget.

```php
InvisibleRecaptchaField::create(
    'Recaptcha', 
    'your-form-id',
    'button'
);
```