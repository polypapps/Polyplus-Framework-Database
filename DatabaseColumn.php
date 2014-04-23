<?php

namespace Polyplus\Api\Database;

/**
 * Description of DatabaseColumn
 *
 * @author rodrigohitec
 */
class DatabaseColumn {
    
    private $table;
    
    private $columnName;
    
    private $value;
    
    private $alias;
    
    function __construct(DatabaseTable $table, $columnName, $alias = "") {
        $this->table = $table;
        $this->columnName = $columnName;
        $this->alias = $alias;
    }
    
    public function getTable() {
        return $this->table;
    }

    public function setTable(DatabaseTable $table) {
        $this->table = $table;
    }

    public function getColumnName() {
        return $this->columnName;
    }

    public function setColumnName($columnName) {
        $this->columnName = $columnName;
    }
    
    public function getValue() {
        return $this->value;
    }

    public function setValue($value) {
        $this->value = $value;
    }

    
    public function getAlias() {
        return $this->alias;
    }

    public function setAlias($alias) {
        $this->alias = $alias;
    }



    
}

?>
