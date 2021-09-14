<?php namespace Octobro\Recaptcha\Components;

use Cms\Classes\ComponentBase;
use Octobro\Recaptcha\Models\Settings;

class Recaptcha extends ComponentBase
{
    /**
     * Settings instance
     * @var Octobro\Recaptcha\Models\Settings
     */
    public $settings;

    /**
     * Returns details about this component.
     * 
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'Recaptcha Component',
            'description' => 'Displays the reCATPCHA widget.'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    /**
     * Prepares variables for the widget rendering
     */
    public function onRun() {
        $this->settings = $this->page['settings'] = Settings::instance();
    }

}