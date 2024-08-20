<?php

namespace App\Models;

class Users extends Model
{
    /**
     * Find row by email and return it
     *
     * @return array|null
    */
    public function findByEmail($email)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE email = LOWER(:email) ";
        $this->query($sql, ['email'=>$email]);
        return $this->get();
    }

    /**
     * 
     * Get all submitted application by user
     * 
     * @return array|Exception
     */
    public function submittedApplications()
    {
        return $this->hasMany("\App\Models\SubmittedApplications", "user_id", "id");
    }
}