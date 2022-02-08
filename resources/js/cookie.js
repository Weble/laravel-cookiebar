import { getCookie, setCookie } from 'tiny-cookie';
import { hasClass } from './helper'

window.cookiebar = (() => ({
    config: {},
    configure: configure,
    init: init,
}))();

// 1
function configure(config) {
    Object.assign(this.config, config);
    return this;
}

// 2
function init() {
    window.dataLayer = window.dataLayer || [];
    if (typeof gtag === 'undefined') {
        function gtag() {
            dataLayer.push(arguments);
        }
        window.gtag = window.gtag || gtag;
    }
    gtag('consent', 'default', this.config.gtag_consent);

    return this;
}

// 2 - BANNER OPERATIONS ON COOKIE on page load
(window.$load = window.$load || [])
    .unshift(({}, next) => {

        // const value = JSON.parse(getCookie(advanced_cookie_name));
        //
        // //  If cookie is already setted, update consent, check consents in modal and ignore banner
        // if (value !== null) {
        //
        //     gtag('consent', 'update', value);
        //
        //     // custom event if needed
        //     window.dataLayer.push({
        //         event: 'cookie_advanced_consent_updated'
        //     });
        //
        //     // TODO: cambiare
        //     // // Check statuses
        //     // $.each(value, (consent, status) => {
        //     //
        //     //     const checkbox = $('#tm-cookie-banner-custom-modal').find('[name="' + consent + '"]');
        //     //
        //     //     if (status == 'granted') {
        //     //         checkbox.attr('checked', true);
        //     //     }
        //     //
        //     // });
        //
        //     next();
        //
        //     return;
        // }
        setup();
        // setupBanner();
        // setupModal();

        next();

});

// 3 - LOAD GTM AFTER BANNER
window.$load.push(({}, next) => {
    if (!gtm_code) {
        next();
        return;
    }

    (function (w, d, s, l, i) {
        w[l] = w[l] || [];w[l].push({'gtm.start':
                new Date().getTime(), event: 'gtm.js'});const f = d.getElementsByTagName(s)[0],
            j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';j.async = true;j.src =
            'https://www.googletagmanager.com/gtm.js?id=' + i + dl;f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', gtm_code);

    next();
});

// domReady( () => {
//     console.log('ready');
//
//     let $load = window.$load || [];
//     let $cookiebar = window.$cookiebar || {};
//
//     function load(stack, config) {
//         stack.length && stack.shift()(
//             config, () => load(stack, config)
//         );
//     }
//
//     load($load, $cookiebar);
// });

/*
 * Update consent
 */
function cookieAdvancedUpdateConsent(event)
{
    var target = event.target;

    console.log('update-consent: ', target)

    // AGREE: all consents granted
    if (hasClass(target, 'js-cookiebar-agree')) {
        Object.keys(gtag_consent).forEach(function (key){
            gtag_consent[key] = 'granted'
        });
    }

    // $('#tm-cookie-banner-custom-modal').hide();
    // $('#tm-cookie-banner').hide();

    setCookie(advanced_cookie_name, JSON.stringify(gtag_consent), {expires: expirationInDays});

    gtag('consent', 'update', gtag_consent);

    // custom event if needed
    window.dataLayer.push({
        event: 'cookie_advanced_consent_updated'
    });

    /** To Edit depending on the application **/
    window.dataLayer.push({
        event: 'gtm.init_consent'
    });
}

function setup() {
    // show consent modal
    document
        .querySelectorAll('[data-cookiebar="modal-show"]')
        .forEach((button) => button.addEventListener("click", () => {
            console.log('modal-show')
        }))

    // update
    document
        .querySelectorAll('[data-cookiebar="update-consent"]')
        .forEach((button) => button.addEventListener("click", cookieAdvancedUpdateConsent))
}

function setupBanner() {
    // update
    document
        .querySelector('[data-cookiebar="update-consent"]')
        .addEventListener("click", cookieAdvancedUpdateConsent);

}

function setupModal() {
    // close
    document
        .querySelector('[data-cookiebar="modal-close"]')
        .addEventListener("click", () => {
            console.log('modal-close')
        });
}


