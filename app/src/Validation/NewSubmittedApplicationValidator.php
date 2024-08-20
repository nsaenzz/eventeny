<?php

namespace App\Validation;

use \Respect\Validation\Validator as V;

class NewSubmittedApplicationValidator extends Validator
{
    /**
     *
     * @return void
     */
    public function __construct()
    {
        $this->initRules();
    }
    
    /**
     * Set the application constraints
     *
     * @return void
     */
    public function initRules() : void
    {
        $this->rules['business_name'] = V::alnum(" ")->length(2, 255);
        $this->rules['business_email'] = V::email();
        $this->rules['business_phone'] = V::phone();
    }

}