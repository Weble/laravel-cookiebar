<?php

return [

    /*
     * Use this setting to enable the cookie consent dialog.
     */
    'enabled' => env('COOKIE_CONSENT_ENABLED', true),

    /*
     * The name of the cookie in which we store if the user
     * has agreed to accept the conditions.
     */
    'cookie_name' => '_cookieAdvancedAllowed',

    /*
     * Set the cookie duration in days.  Default is 365 days.
     */
    'cookie_lifetime' => 365,

    /*
     * Consents
     * The key is the one used by GTM Consent Mode
     */
    'gtag_consent' => [
        'required' => [
            'title'         => 'required',
            'value'         => 'granted',
            'description'   => 'required',
            'enabled'       => true,
        ],
        'ad_storage' => [
            'title'         => 'ad_storage',
            'value'         => 'denied',
            'description'   => 'ad_storage',
            'enabled'       => false,
        ],
        'analytics_storage' => [
            'title'         => 'analytics_storage',
            'value'         => 'denied',
            'description'   => 'analytics_storage',
            'enabled'       => true,
        ],
        'functional_storage' => [
            'title'         => 'functional_storage',
            'value'         => 'denied',
            'description'   => 'functional_storage',
            'enabled'       => false,
        ],
        'personalization_storage' => [
            'title'         => 'personalization_storage',
            'value'         => 'denied',
            'description'   => 'personalization_storage',
            'enabled'       => false,
        ],
        'security_storage' => [
            'title'         => 'security_storage',
            'value'         => 'denied',
            'description'   => 'security_storage',
            'enabled'       => false,
        ]
    ]
];
