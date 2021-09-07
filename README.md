# Recaptcha Plugin for OctoberCMS
It's a plugin for OctoberCMS for you that want to verify using google recaptcha in easy way.

### Configuration
In the OctoberCMS backend go to Settings > Captcha Settings. You are required to enter a Site key and a Secret key there. Selecting a language is optional. Please follow the instructions on https://developers.google.com/recaptcha/ in order to obtain these keys. Enable `Use captcha on login backend?` if you want to use recaptcha on login backend.

### Usage
Place the `{% component 'reCaptcha' %}` code inside the form element.
```php
    <form data-request="onSubmit">
        <div>
            <input type = "email" name="email" />
        </div>
        <div>
            <input type = "text" name="password" />
        </div>
        <div>
            {% component 'reCaptcha'  %}
        </div>
        <div>
            <input type="submit" value="Submit" />
        </div>
    </form>
```
Verify recaptcha using `Octobro\Recaptcha\Classes\RecaptchaAuthorizer`.
```php
    \Octobro\Recaptcha\Classes\RecaptchaAuthorizer::instance()->verify();
```