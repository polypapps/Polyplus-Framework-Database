<?php

namespace Polyplus\Api\Database\Drivers\mysql;

use Polyplus\Api\Database\DatabaseTable;
use Polyplus\Api\Database\DatabaseConnection;
use Polyplus\Api\Database\DatabaseException;
use Polyplus\Api\Database\DatabaseStatement;
use Polyplus\Api\Database\DatabaseCriteria;
use Polyplus\Api\Database\DatabaseColumn;
use Polyplus\Api\Database\DatabaseEntity;

/**
 * Description of Update
 *
 * @author rodrigohitec
 */
class Update implements \Polyplus\Api\Database\DatabaseUpdate{
    
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
    
    /**
     *
     * @var DatabaseCriteria 
     */
    private $criteria;
    
    public function __construct(DatabaseEntity $entity) {
        if(!is_null($entity)) {
            foreach ($entity->getColumnList() as $column) {
                $this->addColumn($column);
            }
            $this->setTable(new DatabaseTable($entity->getEntityName()));
        }
    }
    
    public function addColumn(DatabaseColumn $column) {
        $this->columns[] = $column;
    }

    public function getStatement(DatabaseConnection $conn) {
        
        $sql = "update ".$this->table->getTableName()." set ";
        
        if(current($this->columns)->getValue() !== NULL)
            $sql .= current($this->columns)->getColumnName()." = '".current($this->columns)->getValue()."'";
        else
            $sql .= current($this->columns)->getColumnName()." = NULL";
        while(next($this->columns)) {
            
            if(current($this->columns)->getValue() !== NULL)
            $sql .= ", ".current($this->columns)->getColumnName()." = '".current($this->columns)->getValue()."'";
        else
            $sql .= ", ".current($this->columns)->getColumnName()." = NULL";
            
        }
        
        $parameters = array();
        if($this->criteria) {

            $sql .= $this->criteria->toSqlString();
            $parameters += $this->criteria->getCriterion()->getParameters();

        }

        return new DatabaseStatement($sql, $conn, $parameters);
        
    }

    public function setCriteria(DatabaseCriteria $criteria) {
        if(!$criteria->hasOrder() && !$criteria->hasMaxResults())
            $this->criteria = $criteria;
        else
            throw new DatabaseException("Ordering or limiting not allowed on Update");
    }

    public function setTable(DatabaseTable $table) {
        $this->table = $table;
    }

    
}

?>
