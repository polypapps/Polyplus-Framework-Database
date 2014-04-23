<?php

namespace Polyplus\Api\Database\Drivers\mysql;

use Polyplus\Api\Database\DatabaseTable;
use Polyplus\Api\Database\DatabaseColumn;
use Polyplus\Api\Database\DatabaseStatement;
use Polyplus\Api\Database\DatabaseInsert;
use Polyplus\Api\Database\DatabaseConnection;
use Polyplus\Api\Database\DatabaseEntity;

/**
 * Description of Insert
 *
 * @author rodrigohitec
 */
class Insert implements DatabaseInsert{
    
    /**
     *
     * @var DatabaseTable 
     */
    private $table;
    
    /**
     *
     * @var DatabaseColumn[] 
     */
    private $columns = array();
    
    public function __construct(DatabaseEntity $entity = null) {
        
        if(!is_null($entity)) {
            foreach ($entity->getColumnList() as $column) {
                $this->addColumn($column);
            }
            $this->setTable(new DatabaseTable($entity->getEntityName()));
        }
        
    }

    
    public function setTable(DatabaseTable $table) {
        $this->table = $table;
    }
    
    public function addColumn(DatabaseColumn $column) {
        $this->columns[] = $column;
    }

    public function getStatement(DatabaseConnection $conn) {
        
        $sql = "insert into ".$this->table->getTableName()." (";
        
        $sql .= current($this->columns)->getColumnName();
        while (next($this->columns)) {
            
            $sql .= ", ".current($this->columns)->getColumnName();
            
        }
        $sql .= ") values (";
        reset($this->columns);
        
        if(current($this->columns)->getValue() !== NULL)
            $sql .= "'".current($this->columns)->getValue()."'";
        else
            $sql .= "NULL";
        while (next($this->columns)) {
            
            if(current($this->columns)->getValue() !== NULL)
                $sql .= ", '".current($this->columns)->getValue()."'";
            else
                $sql .= ", NULL";
            
        }
        $sql .= ")";
        
        return new DatabaseStatement($sql, $conn);
        
    }

}

?>
