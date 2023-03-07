@if (config('cookiebar.enabled') && $defaultConsents)
<script>
window.dataLayer = window.dataLayer || [];
if (typeof gtag === 'undefined') {function gtag() {dataLayer.push(arguments);} window.gtag = window.gtag || gtag;}
gtag('consent', 'default', {!! $defaultConsents !!})
</script>
@endif
