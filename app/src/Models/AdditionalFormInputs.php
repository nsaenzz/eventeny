<?php

namespace App\Models;

use DateTime;

class AdditionalFormInputs extends Model
{
    /**
     * Find row by name and return it
     *
     * @return self|null
    */
    public function findByName($name): self|null
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE name = LOWER(:name) ";
        $this->query($sql, ['name'=>$name]);
        return $this->get();
    }
}