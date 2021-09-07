<?php namespace Octobro\Recaptcha\Models;

use Model;

/**
 * Settings Model
 */
class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];
    
    public $settingsCode = 'octobro_recaptcha_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';

}
