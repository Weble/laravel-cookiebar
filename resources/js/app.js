import {getCookie, setCookie} from 'tiny-cookie';
import Alpine from 'alpinejs'

window.CookiebarConfig = (function () {
    let config = {}

    return {
        set: function(data){
            Object.assign( config, data );
        },
        get: function(){
            return config;
        }
    }
})();

if (! window.Alpine) {
    console.error('No alpinejs detected')
}


// Data Layer
window.dataLayer = window.dataLayer || [];
if (typeof gtag === 'undefined') {
    function gtag() {
        dataLayer.push(arguments);
    }
    window.gtag = window.gtag || gtag;
}

Alpine.data('cookiebar', () => ({
    showDialog: true,
    showModal: false,
    config: CookiebarConfig.get(),
    init() {
        setDefaultConsentState();
        loadGTM();
    },
    agree() {
        Object.keys(gtag_consent).forEach(function (key){
            gtag_consent[key] = 'granted'
        });
        setCookie(this.config.advanced_cookie_name, JSON.stringify(this.config.gtag_consent), {expires: this.config.expirationInDays});
        gtag('consent', 'update', gtag_consent);
        dataLayer.push({
            event: 'gtm.init_consent'
        });
        this.showDialog = false;
    },
    dismiss() {
        console.log('dismiss')
    },
    manage() {
        console.log('manage')
    },
    setDefaultConsentState() {
        console.log('setDefaultConsentState');

        // se non ho il cookie, nego tutti i consenti
        if (! cookieExists(advanced_cookie_name)) {
            gtag('consent', 'default', gtag_consent);
            console.log(JSON.stringify(gtag_consent));
            setCookie(advanced_cookie_name, JSON.stringify(gtag_consent), expirationInDays)
            return;
        }

        // se ho cookie, aggiorno consenti
        // var consents = getCookie(advanced_cookie_name);
        // setCookie(advanced_cookie_name, JSON.stringify(consents), expirationInDays)
        // gtag('consent', 'update', consents);
    },
    loadGTM() {
        console.log('loadGTM');

        if (!gtm_code) {
            return;
        }

        (function (w, d, s, l, i) {
            w[l] = w[l] || [];w[l].push({'gtm.start':
                    new Date().getTime(), event: 'gtm.js'});const f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l !== 'dataLayer' ? '&l=' + l : '';j.async = true;j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', gtm_code);
    }
}))
