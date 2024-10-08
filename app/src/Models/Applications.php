<?php

namespace App\Models;

use DateTime;

class Applications extends Model
{
    public function submittedApplications()
    {
        return $this->hasMany("\App\Models\SubmittedApplications", "application_id", "id");
    }

    public function getAvailableApplications()
    {
        $date   = new DateTime();
        $today = $date->format('Y-m-d H:i:s');
        $deadlineDates['from'] = $today;
        $deadlineDates['to'] = $today;
        $sql = "SELECT * FROM " . $this->table . " WHERE deadline_from <= :from AND deadline_to >= :to";
        $this->query($sql, $deadlineDates);
        return $this->get();
    }

    public function getAdditionalInputs() : array
    {
        $additionalInputs = [];
        if (isset($this->custom_form_inputs)) {
            $inputNames = explode(",", $this->custom_form_inputs);
            foreach($inputNames as $inputName) {
                $additionalFormInputs = new AdditionalFormInputs();
                $additionalInputs[] = $additionalFormInputs->findByName($inputName);
            }
        }
        return $additionalInputs;
    }

}