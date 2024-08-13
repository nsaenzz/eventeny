<?php

namespace App\Models;
use App\Database\Database;
use App\Helpers\Helper;
use Exception;

#[\AllowDynamicProperties]
abstract class Model 
{
    protected $db;
    protected string $table = "";
    protected $query = "";
    protected $data = [];
    protected array $rows = [];
    protected array $rowsArray = [];
    protected array $extractedVariables = [];
    protected string $primaryKey = "id";

    public function __construct(int $id=null)
    {
        $this->db = new Database();
        if (!$this->table) {
            $classArr = explode('\\', get_class($this));
            $className = array_pop($classArr);
            $this->table = Helper::camelToSnake($className);
        }
        if(!empty($id)){
            $this->removeExtractedVariables();
            $this->find($id);
        }
        return $this;
    }

    /**
     * Return table name
     *
     * @return int id
    */
    public function table() : int
    {
        return (int) $this->table;
    }

    /**
     * Extract variable to use them in the model
     * 
     * @param array $varibles
     *
     * @return void
    */
    public function extractVariables($variables = []) : void
    {
        foreach($variables as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * Remove Extracted variables from Model
     * 
     */
    protected function removeExtractedVariables() : void
    {
        foreach($this->extractedVariables as $var) {
            unset($this->$var);
        }
        $this->extractedVariables = [];
    }

    /**
     * Return rows
     *
     * @return int id
    */
    public function rows() : array
    {
        return $this->rows;
    }

    /**
     * Find row by id and return it
     *
     * @return self|null
    */
    public function find($id): self|null
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $this->query($sql, ['id'=>$id]);
        return $this->get();
    }

    /**
     * return all rows in model
     *
     * @return array|null
    */
    public function all(): array|null
    {
        $sql = "SELECT * FROM " . $this->table;
        $this->query($sql);
        $this->get();
        return $this->rowsArray;
    }

    /**
     * Create a new row
     *
     * @param $data
     * @return array|null
    */
    public function create(array $data): Model|null
    {
        $data['created_at'] = $data['created_at'] ?? date("Y-m-d H:i:s");
        $data['updated_at'] = $data['updated_at'] ?? date("Y-m-d H:i:s");
        $columns = array_keys($data);
        $sql = "INSERT INTO " . $this->table ." (";
        $sql .= implode(", ", $columns);
        $sql .= ") VALUES (";
        $sql .= ":". implode(", :", $columns);
        $sql .= " )";
        $this->query($sql, $data);
        return $this->get();
    }

    /**
     * Get the related model that owns this model.
     * 
     * @param string $related
     * @param string $foreignKey
     * @param string $owernerkey
     * 
     * @return Model|Exception
     */
    public function belongsTo(string $related, string $foreignKey, string $ownerKey): Model|Exception
    {
        if (!empty($this->extractedVariables)) {
            $model = new $related();
            if (isset($this->$foreignKey)) {
                $key = $this->$foreignKey;
                $sql = "SELECT * FROM " . $model->table . "WHERE $ownerKey = :key";
                $model->query($sql, ['key'=>$key]);
                return $model->get();
            }
            throw new \Exception("Foreign Key not found");
        }
        throw new \Exception("Need to get data first");
    }

    /**
     * Get related table One to Many
     * 
     * @param string $related
     * @param string $foreignKey
     * @param string $owernerkey
     * 
     * @return array|Exception
     */
    public function hasMany(string $related, string $foreignKey, string $ownerKey): array|Exception
    {
        if (!empty($this->extractedVariables)) {
            $model = new $related();
            if (isset($this->$ownerKey)) {
                $key = $this->$ownerKey;
                $sql = "SELECT * FROM " . $model->table . " WHERE $foreignKey = :key";
                $model->query($sql, ['key'=>$key]);
                return count($this->rowsArray) > 1 ? $model->get() : ($model->get() ? [$model->get()] : []);
            }
            throw new \Exception("Foreign Key not found");
        }
        throw new \Exception("Need to get data first");
    }

    /**
     * Save the query to run
     * 
     * @param $query
     * @return Model
     */
    public function query($query, $data=[]): Model
    {
        $this->query = $query;
        $this->data = $data;
        return $this;
    }

    /**
     * Run query and send rows
     *
     * @return self|array|null
     */
    public function get(): self|array|null
    {
        $this->rows = [];
        $this->rowsArray = $this->db->query($this->query, $this->data);
        if(count($this->rowsArray )){
            if(count($this->rowsArray)>1) {
                foreach ($this->rowsArray  as $row) {
                    $newModel = new static();
                    $newModel->extractedVariables = array_keys($row);
                    $newModel->extractVariables($row);
                    $newModel->rowsArray = $row;
                    $this->rows[] = $newModel;
                }
                return $this->rows;
            }  else {
                $this->removeExtractedVariables();
                $this->extractedVariables = array_keys($this->rowsArray[0]);
                
                $this->extractVariables($this->rowsArray[0]);
                return $this;
            }           
        }
        return null;
    }

    /**
     * 
     */
    public function toArray() : array|null
    {
        return $this->rowsArray;
    }

    /**
     * Run query without modifying Model
     *
     * @return bool
     */
    public function run()//: bool
    {
        //try{
            $this->db->query($this->query, $this->data);
       // } catch(\Exception $e) {
           // return false;
        //}
        //return true;
    }

    /**
     * Return is rows exists
     *
     * @return bool
     */
    public function exists() : bool
    {
        return !empty($this->db->query($this->query, $this->data));
    }

    /**
     * Delete Row by id
     * 
     * @param int|null $id
     * 
     * @return boolean
     */
    public function delete(int $id=null): bool
    {
        if ($id || isset($this->{$this->primaryKey})) {
            $id = $id  ?? $this->{$this->primaryKey};
            $sql = "DELETE FROM $this->table WHERE id = :id ";
            try {
                $this->query($sql, ['id'=>$id]);
                $this->run();
                return true;
            } catch(\Exception) {
                return false;
            }
        }
        $this->removeExtractedVariables();
        return false;
    }

    /**
     * Delete All Rows in current model
     * 
     * @return boolean
     */
    public function deleteAll(): bool
    {
        foreach ($this->rows as $row) {
            $sql = "DELETE FROM $this->table WHERE id = :id ";
            try {
                $this->query($sql, ['id'=>$row->id]);
                $this->run();
            } catch(\Exception $e) {
                return false;
            }
        }
        $this->rows = [];
        return true;
    }

    /**
     * Update Current Model to DB
     * 
     * @return Model
     */
    public function save(): Model
    {
        if (!empty($this->extractedVariables)) {
            if (isset($this->{$this->primaryKey})) {
                $sql = "UPDATE $this->table SET ";
                foreach($this->extractedVariables as $var) {
                    $sql .= $var . " = '" . $this->$var . "', ";
                }
                $sql = rtrim($sql, ", ");
                $sql .= " WHERE id = :id";
                $this->query($sql, ['id'=>$this->{$this->primaryKey}]);
                $this->run();
                $this->query = "";
                return $this;
            }
            throw new \Exception("Need primary key");
        }
        throw new \Exception("There is no data in this Model");
    }
}