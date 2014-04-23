<?php

namespace Polyplus\Api\Database;

/**
 *
 * @author rodrigohitec
 */
interface DatabaseSelect {
        
    public function addColumn(DatabaseColumn $column);
    
    public function setColumnAlias($tableName, $columnName, $alias);
    
    public function addTable(DatabaseTable $table);
    
    public function setTableAlias($tableName, $alias);
    
    public function setCriteria(DatabaseCriteria $criteria);
    
    public function getStatement(DatabaseConnection $conn);
    
}

?>
