# Silverstripe-Recaptcha
Standard reCAPTCHA and invisible reCAPTCHA form fields for SilverStripe

[![Latest Stable Version](https://poser.pugx.org/cyber-duck/silverstripe-recaptcha/v/stable)](https://packagist.org/packages/cyber-duck/silverstripe-recaptcha)
[![Latest Unstable Version](https://poser.pugx.org/cyber-duck/silverstripe-recaptcha/v/unstable)](https://packagist.org/packages/cyber-duck/silverstripe-recaptcha)
[![Total Downloads](https://poser.pugx.org/cyber-duck/silverstripe-recaptcha/downloads)](https://packagist.org/packages/cyber-duck/silverstripe-recaptcha)
[![License](https://poser.pugx.org/cyber-duck/silverstripe-recaptcha/license)](https://packagist.org/packages/cyber-duck/silverstripe-recaptcha)

Author: [Andrew Mc Cormack](https://github.com/Andrew-Mc-Cormack)

__For SilverStripe 4.*__

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
$fields = FieldList::create([
	RecaptchaField::create(
		'Recaptcha'
	);
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

requied fields