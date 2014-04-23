<?php

namespace Polyplus\Api\Database;

/**
 * Description of DatabaseTable
 *
 * @author rodrigohitec
 */
class DatabaseTable {
    
    private $tableName;
    
    private $alias;
    
    function __construct($tableName, $alias = "") {
        $this->tableName = $tableName;
        $this->alias = $alias;
    }
    
    public function getTableName() {
        return $this->tableName;
    }

    public function setTableName($tableName) {
        $this->tableName = $tableName;
    }

    public function getAlias() {
        return $this->alias;
    }

    public function setAlias($alias) {
        $this->alias = $alias;
    }



    
}

?>
