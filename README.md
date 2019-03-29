# Silverstripe-Recaptcha
Standard reCAPTCHA and invisible reCAPTCHA form fields for SilverStripe

[![Latest Stable Version](https://poser.pugx.org/cyber-duck/silverstripe-recaptcha/v/stable)](https://packagist.org/packages/cyber-duck/silverstripe-recaptcha)
[![Latest Unstable Version](https://poser.pugx.org/cyber-duck/silverstripe-recaptcha/v/unstable)](https://packagist.org/packages/cyber-duck/silverstripe-recaptcha)
[![Total Downloads](https://poser.pugx.org/cyber-duck/silverstripe-recaptcha/downloads)](https://packagist.org/packages/cyber-duck/silverstripe-recaptcha)
[![License](https://poser.pugx.org/cyber-duck/silverstripe-recaptcha/license)](https://packagist.org/packages/cyber-duck/silverstripe-recaptcha)

Author: [Andrew Mc Cormack](https://github.com/Andrew-Mc-Cormack)

__For SilverStripe 4.*__

## Installation

Add the following to your composer.json file and run /dev/build?flush=all

```json
{  
    "require": {  
        "cyber-duck/silverstripe-recaptcha": "4.0.*"
    }
}
```

## Standard Recaptcha

Add 2 .env vars with your recaptcha keys

```
RECAPTCHA_SITE_KEY="0000000000"
RECAPTCHA_SECRET_KEY="0000000000"
```

Add the field to any form on your site just as you would any other field.
Pass in: 
- the field name.
Also add the field to the required fields list.

```php
use CyberDuck\Recaptcha\Forms\RecaptchaField;

$fields = FieldList::create([
	RecaptchaField::create('Recaptcha');
]);

$validator = RequiredFields::create([
    'Recaptcha'
]);
```

## Invisible Recaptcha

Add 2 .env vars with your recaptcha keys

```
RECAPTCHA_INVISIBLE_SITE_KEY="0000000000"
RECAPTCHA_INVISIBLE_SECRET_KEY="0000000000"
```

Add the field to any form on your site just as you would any other field.
Pass in: 
- the field name, 
- the form ID (without #)
- the HTML element ID (without #) or selector (such as button) to render the reCAPTCHA widget.
Also add the field to the required fields list.

```php
use CyberDuck\Recaptcha\Forms\InvisibleRecaptchaField;

$fields = FieldList::create([
	InvisibleRecaptchaField::create(
	    'Recaptcha', 
	    'MemberLoginForm_LoginForm',
	    'MemberLoginForm_LoginForm_action_doLogin'
	);
]);

$validator = RequiredFields::create([
    'Recaptcha'
]);
```

## Working with jQuery and AJAX

If you would like to use the reCAPTCHA with AJAX you can copy the InvisibleRecaptcha.ss from the module templates folder into your theme templates folder

```javascript
<script type="text/javascript">
    var onRecaptchaFormSubmit = function(token) {
        document.getElementById('{$FormID}').submit();
    };
    var onloadCallback = function() {
        grecaptcha.render('{$Container}', {
        'sitekey' : '{$SiteKey}',
        'callback' : onRecaptchaFormSubmit
        });
    };
</script>
```

And just update the onRecaptchaFormSubmit function to use jQuery to select and submit the form

```javascript
<script type="text/javascript">
    var onRecaptchaFormSubmit = function(token) {
        $('#{$FormID}').submit();
    };
    var onloadCallback = function() {
        grecaptcha.render('{$Container}', {
        'sitekey' : '{$SiteKey}',
        'callback' : onRecaptchaFormSubmit
        });
    };
</script>

```

In your AJAX success function, if your form fails validation you can call onloadCallback() to re-render the reCAPTCHA

```javascript
onloadCallback()
```
