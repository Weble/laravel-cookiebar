import { getCookie, setCookie } from 'tiny-cookie';
import { hasClass } from './helper'

window.cookiebar = (() => ({
    config: {},
    configure: configure,
    init: init,
    setupTemplate: setupTemplate,
    loadGTM: loadGTM,
}))();

// 1
function configure(config) {
    Object.assign(this.config, config);
    return this;
}

// 2
function init() {
    // initialize GTM
    window.dataLayer = window.dataLayer || [];
    if (typeof gtag === 'undefined') {
        function gtag() {
            dataLayer.push(arguments);
        }
        window.gtag = window.gtag || gtag;
    }

    const cookie = JSON.parse(getCookie(this.config.advanced_cookie_name));

    // default consent
    if (! cookie) {
        gtag('consent', 'default', this.config.gtag_consent);
        return this;
    }

    // update consent
    Object.assign(this.config.gtag_consent, cookie);
    _updateConsent(this.config);

    return this;
}

// 3
function setupTemplate() {
    // update
    _addClickTo('[data-cookiebar="update-consent"]', (event) => _updateConsentEvent(event, this.config) );

    // show modal
    _addClickTo('[data-cookiebar="modal-show"]', () => _showModal(this.config.gtag_consent));

    // hide modal
    _addClickTo('[data-cookiebar="modal-hide"]', () => _hide(document.getElementById('cookiebar-modal')));

    return this;
}

// 4
function loadGTM() {
    if (! this.config.gtm_code) {
        return;
    }

    (function (w, d, s, l, i) {
        w[l] = w[l] || [];w[l].push({'gtm.start':
                new Date().getTime(), event: 'gtm.js'});const f = d.getElementsByTagName(s)[0],
            j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';j.async = true;j.src =
            'https://www.googletagmanager.com/gtm.js?id=' + i + dl;f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', this.config.gtm_code);

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

    if (hasClass(target, 'js-cookiebar-custom')) {
        Object
            .keys(gtag_consent)
            .forEach((key) => {
                const checkbox = document.getElementById(key);

                if (! checkbox) {
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
    const {advanced_cookie_name, expirationInDays, gtag_consent} = config;

    setCookie(advanced_cookie_name, JSON.stringify( gtag_consent), { expires: expirationInDays });

    gtag('consent', 'update', gtag_consent);

    dataLayer.push({
        'event': 'cookie_advanced_consent_updated'
    });

    dataLayer.push({
        'event': 'gtm.init_consent'
    });

    _hide(document.getElementById('cookiebar-banner'))
    _hide(document.getElementById('cookiebar-modal'))
}

function _addClickTo(selector, cb) {
    const elements = document.querySelectorAll(selector)
    if (elements.length <= 0) {
        return;
    }

    elements.forEach((button) => button.addEventListener("click", cb))
}

function _hide(el) {
    if (! el) {
        return;
    }
    el.style.display = "none";
}

function _show(el) {
    if (! el) {
        return;
    }
    el.style.display = "block";
}

function _showModal(consents) {
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

    _show(document.getElementById('cookiebar-modal'))
}
