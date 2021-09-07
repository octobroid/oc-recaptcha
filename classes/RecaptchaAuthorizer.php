<?php namespace Octobro\Recaptcha\Classes;

use Input, Request;
use Exception;
use ReCaptcha\ReCaptcha;
use Octobro\Recaptcha\Models\Settings;

class RecaptchaAuthorizer {
    use \October\Rain\Support\Traits\Singleton;

    public $recaptchaResponse, $ip;

    public function init()
    {
        $input = Input::all();
        if (array_key_exists('g-recaptcha-response', $input)) {
            $this->recaptchaResponse = $input['g-recaptcha-response'];
            $this->ip = Request::ip();
        }
    }
    public function verify() {
        $settings = Settings::instance();

        //check if has response
        if ($this->recaptchaResponse) {
            $recaptcha = new ReCaptcha( Settings::get('secret_key') );

            /**
             * Verify the reponse, pass user's IP address
             */
            $response = $recaptcha->verify(
                $this->recaptchaResponse,
                $this->ip
            );

            /**
             * Fail, if error
             */
            if (!$response->isSuccess()) {
                throw new Exception($response->getErrorCodes());
            }
        } else {
            throw new Exception('Please select captcha.');
        }
    }
}