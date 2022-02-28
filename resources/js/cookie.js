import { getCookie, setCookie } from 'tiny-cookie';
import { hasClass, hide, show , addClickTo } from './helper'

window.gtmCookieBar = (() => ({
    config: {
        cookieName: '_cookieAdvancedAllowed',
        expirationInDays: 365,
        gtag_consent: {

        }
    },
    configure: configure,
    init: init,
    setupTemplate: setupTemplate,
    editConsents: _showModal
}))();

// 1
function configure(config) {
    Object.assign(this.config, config);
    return this;
}

// 2
function init() {
    // initialize GTM Data Layer
    window.dataLayer = window.dataLayer || [];
    if (typeof gtag === 'undefined') {
        function gtag() {
            dataLayer.push(arguments);
        }
        window.gtag = window.gtag || gtag;
    }

    const cookie = JSON.parse(getCookie(this.config.cookieName));

    // default consent
    if (! cookie) {
        //gtag('consent', 'default', this.config.gtag_consent);
        return this;
    }


    // update consent
    Object.assign(this.config.gtag_consent, cookie);
    //_updateConsent(this.config);


    return this;
}

// 3
function setupTemplate() {
    // update
    addClickTo('[data-cookiebar="update-consent"]', (event) => _updateConsentEvent(event, this.config) );

    // show modal
    addClickTo('[data-cookiebar="modal-show"]', () => _showModal(this.config));

    // hide modal
    addClickTo('[data-cookiebar="modal-hide"]', () => hide(document.getElementById('cookiebar-modal')));

    return this;
}

function _updateConsentEvent(event, config) {
    const target = event.target;

    const { gtag_consent } = config;

    // AGREE: all consents granted
    if (hasClass(target, 'js-cookiebar-agree')) {
        Object
            .keys(gtag_consent)
            .forEach(function (key){
                gtag_consent[key] = 'granted'
            });
    }

    // DISMISS: all consents denied
    if (hasClass(target, 'js-cookiebar-dismiss')) {
        Object
            .keys(gtag_consent)
            .forEach(function (key){
                gtag_consent[key] = 'danied'
            });
    }

    // MANAGE: select consents
    if (hasClass(target, 'js-cookiebar-custom')) {
        Object
            .keys(gtag_consent)
            .forEach((key) => {
                const checkbox = document.getElementById(key);

                if (! checkbox) {
                    gtag_consent[key] = gtag_consent[key].value ?? 'denied';
                    return;
                }

                if (checkbox.checked) {
                    gtag_consent[key] = 'granted';
                }

                if (! checkbox.checked) {
                    gtag_consent[key] = 'denied';
                }
            });
    }

    _updateConsent(config);
}

function _updateConsent(config) {
    if (! config) {
        return
    }

    const {cookieName, expirationInDays, gtag_consent} = config;

    setCookie(cookieName, JSON.stringify( gtag_consent), { expires: expirationInDays });

    gtag('consent', 'update', gtag_consent);

    dataLayer.push({
        'event': 'cookie_advanced_consent_updated'
    });

    dataLayer.push({
        'event': 'gtm.init_consent'
    });

    hide(document.getElementById('cookiebar-banner'))
    hide(document.getElementById('cookiebar-modal'))
}

function _showModal(config) {
    config = config || this.config;

    if (! config) {
     return
    }

    const consents = config.gtag_consent;

    if (! consents) {
        return
    }

    // check consent
    Object
        .keys(consents)
        .forEach((key) => {
            const checkbox = document.getElementById(key);

            if (! checkbox) {
                return;
            }

            checkbox.checked = consents[key] === 'granted'
        });

    show(document.getElementById('cookiebar-modal'))
}
