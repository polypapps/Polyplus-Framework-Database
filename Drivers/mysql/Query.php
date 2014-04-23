<?php

namespace Polyplus\Api\Database\Drivers\mysql;

/**
 * Description of Query
 *
 * @author intelimen18
 */
class Query implements \Polyplus\Api\Database\DatabaseQuery {
    
    private $sql;
    private $conn;
    
    function __construct($sql, $conn) {
        $this->sql = $sql;
        $this->conn = $conn;
    }
    
    public function getSelectStatement() {
        
        return new \Polyplus\Api\Database\DatabaseStatement($this->sql, $this->conn);
        
    }

    public function toArray() {
        return $this->getSelectStatement()->fetchAll(\PDO::FETCH_CLASS, "stdClass");
    }

    public function uniqueResult() {
        return $this->getSelectStatement()->fetch();
    }
        
}

?>
