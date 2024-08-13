<?php

namespace App\Validation;

use Respect\Validation\Exceptions\NestedValidationException;

class Validator
{
    /**
     * List of constraints
     *
     * @var array
     */
    protected array $rules = [];
    
    /**
     * List of customized messages
     *
     * @var array
     */
    protected array $messages = [];

    /**
     * List of returned errors in case of a failing assertion
     *
     * @var array
     */
    protected array $errors = [];
    public string $last_error;

    public function validate($inputs)
    {
        foreach ($this->rules as $field => $rule) {
            try {
                $rule->setName(ucfirst($field))
                    ->assert($inputs[$field]);
            } catch(NestedValidationException $e) {
                $this->errors[$field] = isset($this->messages[$field]) ? [$this->messages[$field]] : $e->getMessages();
                if (is_array($e->getMessages()) && !empty($e->getMessages())) {
                    $errors = array_values($e->getMessages());
                    $this->last_error = $errors[0];
                } else {
                    $this->last_error = $e->getMessage();
                }
            }
        }
        $_SESSION['errors'] = $this->errors;
        return $this;
    }

    public function failed()
    {
        return !empty($this->errors);
    }

    public function getErrors()
    {
        return $this->errors;
    }
}