<?php

namespace App\Validation;

use \Respect\Validation\Validator as V;

class NewApplicationValidator extends Validator
{
    /**
     *
     * @return void
     */
    public function __construct()
    {
        $this->initRules();
        $this->initMessages();
    }
    
    /**
     * Set the application constraints
     *
     * @return void
     */
    public function initRules() : void
    {
        $this->rules['title'] = V::alnum(' ', ',', '?', '!')->length(2, 255);
        $this->rules['description'] = V::alnum(' ', ',', '?', '!')->length(2, 65535);
        $this->rules['deadline_from'] = V::date('m/d/Y');
        $this->rules['deadline_to'] = V::date('m/d/Y');
        $this->rules['price'] = V::number();
        $this->rules['cover_photo_type'] = V::in(['image/jpeg', 'image/jpg', 'image/png']);
        $this->rules['cover_photo_size'] = V::number()->greaterThan(100000)->lessThan(10000000);
    }

    /**
     * Set the custom error message
     *
     * @return void
     */
    public function initMessages() : void 
    {
        $this->messages['cover_photo_type'] = "Cover Photo has to be a valid image file";
        $this->messages['cover_photo_size'] = "Cover Photo have to between 100KB and 10MB";
    }
}