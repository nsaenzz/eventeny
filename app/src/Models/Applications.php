<?php

namespace App\Models;

class Applications extends Model
{
    public function submittedApplications()
    {
        return $this->hasMany("\App\Models\SubmittedApplications", "application_id", "id");
    }
}