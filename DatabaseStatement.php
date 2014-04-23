<?php

namespace Polyplus\Api\Database;

/**
 * 
 *
 * @author rodrigohitec
 */
class DatabaseStatement{
    
    private $sql;
    private $parameters;
    private $stmt;
    
    public function __construct($sql, DatabaseConnection $conn, $parameters = array()) {
        $this->sql = $sql;
        $this->parameters = $parameters;
        $this->stmt = $conn->prepare($sql);
        
    }
    
    public function toSqlString() {
        return $this->sql;
    }
    
    public function execute() {
        
        ob_start();
        echo "SQL: ";
        var_dump($this->sql);
        var_dump($this->parameters);
        file_put_contents("/home/intelimen18/sites/log/zips/statement.log", ob_get_clean(), FILE_APPEND);
        
        try {
            $this->stmt->execute($this->parameters);
        } catch (\PDOException $e) {
            throw new DatabaseException($e->getMessage()." SQL: ".$this->sql);
        }
    }
    
    public function fetch(DatabaseEntity $entity = null) {
        
        if($entity) {
            $class_name = get_class($entity);
        } else {
            $class_name = "stdClass";
        }
        
        $this->execute();
        return $this->stmt->fetchObject($class_name);
        
    }
    
    public function fetchAll($fetch_style = NULL, $fetch_argument = NULL) {
        
        $this->execute();
        return $this->stmt->fetchAll($fetch_style, $fetch_argument);
        
    }

    
}

?>
