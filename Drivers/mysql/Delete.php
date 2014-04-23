<?php

namespace Polyplus\Api\Database\Drivers\mysql;

use Polyplus\Api\Database\DatabaseTable;
use Polyplus\Api\Database\DatabaseConnection;
use Polyplus\Api\Database\DatabaseException;
use Polyplus\Api\Database\DatabaseStatement;
use Polyplus\Api\Database\DatabaseDelete;
use Polyplus\Api\Database\DatabaseCriteria;


/**
 * Description of Delete
 *
 * @author rodrigohitec
 */
class Delete implements DatabaseDelete{
    
    private $criteria;
    
    private $tableName;
    
    public function setCriteria(DatabaseCriteria $criteria) {
        
        if(!$criteria->hasOrder() && !$criteria->hasMaxResults())
            $this->criteria = $criteria;
        else
            throw new DatabaseException("Ordering or limiting not allowed on Delete");
    }

    public function setTable(DatabaseTable $table) {
        $this->tableName = $table->getTableName();
    }
    
    public function getStatement(DatabaseConnection $conn) {
        
        $parameters = array();
        if($this->criteria) {
            
            $sql = "delete from ".$this->tableName." ";
            
            $sql .= $this->criteria->toSqlString();
            $parameters += $this->criteria->getCriterion()->getParameters();

        }

        return new DatabaseStatement($sql, $conn, $parameters);
        
    }

    
}

?>
