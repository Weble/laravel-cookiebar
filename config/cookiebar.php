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
     * Set the cookie duration in days.  Default is 365 * 20.
     */
    'cookie_lifetime' => 365 * 20,

    /*
     * Set the Google Tag Manager Code
     */
    'gtm_code' => env('GTM_CODE', ''),

    /*
     * Consents
     */
    'gtag_consent' => [
        'ad_storage' => [
            'value'         => 'denied',
            'description'   => 'ad_storage',
            'enabled'       => true,
        ],
        'analytics_storage' => [
            'value'         => 'denied',
            'description'   => 'analytics_storage',
            'enabled'       => true,
        ],
        'functional_storage' => [
            'value'         => 'denied',
            'description'   => 'functional_storage',
            'enabled'       => true,
        ],
        'personalization_storage' => [
            'value'         => 'denied',
            'description'   => 'personalization_storage',
            'enabled'       => true,
        ],
        'security_storage' => [
            'value'         => 'denied',
            'description'   => 'security_storage',
            'enabled'       => true,
        ]
    ]
];
