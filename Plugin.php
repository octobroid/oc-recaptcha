<?php namespace Octobro\Recaptcha;

use Backend, Event, View, Input;
use ApplicationException;
use System\Classes\PluginBase;
use Octobro\Recaptcha\Models\Settings;
use Octobro\Recaptcha\Classes\RecaptchaAuthorizer;

/**
 * Recaptcha Plugin Information File
 */
class Plugin extends PluginBase
{
    public $elevated = true;
    
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Recaptcha',
            'description' => 'No description provided yet...',
            'author'      => 'Octobro',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        Event::listen('backend.auth.extendSigninView', function($controller) {
            $settings = Settings::instance();
            if ($settings->backend_captcha) {
                return View::make("octobro.recaptcha::recaptcha", ['settings'=>$settings]);
            }
        });
        Event::listen('backend.user.login', function ($user) {
            $settings = Settings::instance();
            if ($settings->backend_captcha) {
                RecaptchaAuthorizer::instance()->verify();
            }
        });
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'Captcha Settings',
                'description' => 'Manage reCAPTCHA API keys and settings.',
                'icon'        => 'icon-key',
                'class'       => 'Octobro\Recaptcha\Models\Settings',
                'order'       => 500,
                'permissions' => ['octobro.recaptcha.access_settings']
            ]
        ];
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'Octobro\Recaptcha\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        // return []; // Remove this line to activate

        return [
            'octobro.recaptcha.access_settings' => [
                'tab' => 'Recaptcha',
                'label' => 'access recaptcha settings'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'recaptcha' => [
                'label'       => 'Recaptcha',
                'url'         => Backend::url('octobro/recaptcha/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['octobro.recaptcha.*'],
                'order'       => 500,
            ],
        ];
    }
}
