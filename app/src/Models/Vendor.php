<?php

namespace App\Models;
use App\Database\Database;

class Vendors extends Model{
    public function get_by_id($id) {
        $sql = "SELECT * FROM users WHERE id = $id";
        $result = $this->db->query($sql);
        return $result->fetch_assoc();
    }

}