<?php

namespace Polyplus\Api\Database\Drivers\mysql;

use Polyplus\Api\Database\DatabaseSelect;
use Polyplus\Api\Database\DatabaseTable;
use Polyplus\Api\Database\DatabaseConnection;
use Polyplus\Api\Database\DatabaseException;
use Polyplus\Api\Database\DatabaseStatement;
use Polyplus\Api\Database\DatabaseCriteria;
use Polyplus\Api\Database\DatabaseColumn;

/**
 * 
 *
 * @author rodrigohitec
 */
class Select implements DatabaseSelect{
    
    private $columns = array();
    
    private $tables = array();
    
    /* @var $criteria DatabaseCriteria */
    private $criteria;
        
    public function addColumn(DatabaseColumn $column) {
        if(!in_array($column, $this->columns))
            $this->columns[] = $column;
        else
            throw new DatabaseException("Column already exists in query");
    }

    public function addTable(DatabaseTable $table) {
        if(!in_array($table, $this->tables))
            $this->tables[] = $table;
        else
            throw new DatabaseException("Table already exists in query");
    }

    public function getStatement(DatabaseConnection $conn) {
        
        if(count($this->columns) && count($this->tables)) {
            
            $sql = "select ";
            $sql .= current($this->columns)->getColumnName()." ".current($this->columns)->getAlias();;
            while(next($this->columns)) {
                
                $sql .= ", ".current($this->columns)->getColumnName()." ".current($this->columns)->getAlias();
                
                
            }
            
            $sql .= " from ";
            
            $sql .= current($this->tables)->getTableName()." ".current($this->tables)->getAlias();;
            while(next($this->tables)) {
                
                $sql .= current($this->tables)->getTableName()." ".current($this->tables)->getAlias();;
                
            }
            
            $parameters = array();
            if($this->criteria) {
                
                $sql .= $this->criteria->toSqlString();
                if($this->criteria->hasCriterions())
                    $parameters += $this->criteria->getCriterion()->getParameters();
                
            }
            
            return new DatabaseStatement($sql, $conn, $parameters);
            
        } else {
            throw new DatabaseException("Invalid number of columns and/or rows.");
        }
        
    }

    public function setColumnAlias($tableName, $columnName, $alias) {
        
        foreach($this->columns as $column) {
            
            if($column->getColumnName() == $columnName && $colum->getTable()->getTableName == $tableName) {
                $column->setAlias($alias);
                break;
            }
            
        }
        
    }

    public function setCriteria(DatabaseCriteria $criteria) {
        $this->criteria = $criteria;
    }

    public function setTableAlias($tableName, $alias) {
        
        foreach($this->tables as $table) {
            
            if($table->getTableName == $tableName) {
                $table->setAlias($alias);
                break;
            }
            
        }
        
    }


    
}

?>
