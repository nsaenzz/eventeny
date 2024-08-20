<?php

namespace App\Models;

class SubmittedApplications extends Model
{

    /**
     * Find row by email and return it
     *
     * @return SubmittedApplications|array|null
    */
    public function findByUserId($userId)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE user_id = :userId ";
        $this->query($sql, ['userId'=>strtolower($userId)]);
        return $this->get();
    }

    /**
     * Find row by email and return it
     *
     * @return SubmittedApplications|array|null
    */
    public function findByUserIdApplicationId($userId, $applicationId)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE user_id = :userId and application_id = :applicationId";
        $this->query($sql, [
            'userId'=>$userId, 
            'applicationId'=>$applicationId
        ]);
        return $this->get();
    }


    public function application() : Model
    {
        return $this->belongsTo("\App\Models\Applications", "application_id", "id");
    }
}