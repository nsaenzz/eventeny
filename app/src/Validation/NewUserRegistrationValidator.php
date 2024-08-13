<?php

namespace App\Validation;

use \Respect\Validation\Validator as V;

class NewUserRegistrationValidator extends Validator
{
    /**
     *
     * @return void
     */
    public function __construct()
    {
        $this->initRules();
        //$this->initMessages();
    }
    
    /**
     * Set the user subscription constraints
     *
     * @return void
     */
    public function initRules() : void
    {
        $this->rules['name'] = V::alpha(' ')->length(2, 255);
        $this->rules['email'] = V::email()->emailAvailable();
        $this->rules['password'] = V::noWhitespace()->length(8, 255)->setName('password');
        $this->rules['password_confirmation'] = V::noWhitespace()->length(8, 255)->equals($_POST['password_confirmation'])->setName('password confirmation');
        $this->rules['role'] = V::containsAny(['organizer', 'vendor']);
    }
}