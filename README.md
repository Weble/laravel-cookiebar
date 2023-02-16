# Laravel Cookies Consent Management with GTM ConsentMode

Laravel package for the new EU Cookie LAW. Provides a nice toolbar with a modal to select which consent

## Installation

```shell
composer require weble/laravel-cookiebar
```

### Publish Assets

Copy the assets required to run the laravel cookiebar into your project.
This includes the javascript file, the language files and the views.

```shell
 php artisan vendor:publish --provider="Weble\Cookiebar\CookiebarServiceProvider"
```


### Config - Optional

You can also optionally publish the configuration file.

```shell
php artisan vendor:publish --provider="Weble\Cookiebar\CookiebarServiceProvider" --tag="cookiebar-config"
```

Also, remember to follow the installation instructions for [Spatie GoogleTagManager](https://github.com/spatie/laravel-googletagmanager), which is included in this package and required to correctly use the cookeibar.

## Usage

Once you've correctly [Setup Spatie GoogleTagManager](https://github.com/spatie/laravel-googletagmanager), 
be sure to set the option in the cookiebar configuration file to fit your needs.

Most of all, remember to enable the cookiebar and set the consents you need.

## Reopening the consent modal.

You can reopen the consent modal by calling

```js
window.gtmCookieBar.editConsents()
``` 

Usually this is done in a link / button in the footer of your website.


## Customizations

By default the cookiebar is styled using Tailwind CSS.

Add this configuration to your ```tailwing.config.js``` file to set the colors

 ```js
 cookiebar: {
    banner: {
        'primary': '', // bg - button
        'secondary': '', // text - buttont
    },
    modal: {
        'drop': '', 
        'primary': '', // title
        'secondary': '', // text
    checkbox: {
        'primary': '', // checked - border color
        'secondary': '', // unchecked color
    },
    button: {
        save: {
            'primary': '', // button bg color
            'secondary': '', // button text color
            'hover': '', // button hover color
        },
    cancel: {
        'secondary': '', // button text color
        }
    }
},
 ```

Add this configuration to your ```tailwing.config.js``` file to set the checkbox icon

```js
...
backgroundImage: theme => ({
    ...
    'cookiebar-modal-checkbox-icon': 'url("data:image/svg+xml,%3csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 20 20\'%3e%3cpath fill=\'none\' stroke=\'%23fff\' stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'3\' d=\'M6 10l3 3l6-6\'/%3e%3c/svg%3e")'
    ...
}),
    ...
```

You can publish the views, assets and translations, and then edit the files in `resources/view/vendor/cookiebar/` to better suit your needs.
