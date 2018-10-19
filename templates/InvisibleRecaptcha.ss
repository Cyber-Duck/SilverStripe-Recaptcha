<script type="text/javascript">
    var onLoginSubmit = function(token) {
        $('#{$FormSelector}').submit();
    };
    var onloadCallback = function() {
        grecaptcha.render('{$Container}', {
        'sitekey' : '{$SiteKey}',
        'callback' : onLoginSubmit
        });
    };
</script>