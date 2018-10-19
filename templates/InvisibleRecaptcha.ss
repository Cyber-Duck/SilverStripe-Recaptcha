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