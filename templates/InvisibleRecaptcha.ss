<script type="text/javascript">
    var onRecaptchaFormSubmit = function(token) {
        $('#{$FormSelector}').submit();
    };
    var onloadCallback = function() {
        grecaptcha.render('{$Container}', {
        'sitekey' : '{$SiteKey}',
        'callback' : onRecaptchaFormSubmit
        });
    };
</script>