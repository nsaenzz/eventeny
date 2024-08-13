<?php

namespace App\Models;

class Sessions extends Model{

    /**
     * Find row by email and return it
     * 
     * @param string $token
     *
     * @return self|null
    */
    public function findByToken(string $token)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE token = :token ";
        $this->query($sql, ['token'=>$token]);
        return $this->get();
    }

    /**
     * Find row by email and return it
     *
     * @param int|string $userId
     * 
     * @return self|null
    */
    public function findByUserId(int|string $userId)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE user_id = :userId ";
        $this->query($sql, ['userId'=>$userId]);
        return $this->get();
    }

    /**
     * Delete all session from the userid in table
     *
     * @param int|string $userId
     * 
     * @return array|null
    */
    public function deleteAllUserSession($userId) : void
    {
        $sql = "DELETE FROM " . $this->table . " WHERE user_id = :userId";
        $this->query($sql, ['userId'=>$userId])->run();
    }

    /**
     * Get User table that belong to the Session
     * 
     * @return Model
     */
    public function user()
    {
        return $this->belongsTo("\App\Models\Users", "user_id", "id");
    }
}