<?php

namespace Polyplus\Api\Database;


/**
 *
 * @author rodrigohitec
 */
interface DatabaseUpdate {
    
    public function setTable(DatabaseTable $table);
    
    public function addColumn(DatabaseColumn $column);
    
    public function setCriteria(DatabaseCriteria $criteria);
    
    public function getStatement(DatabaseConnection $conn);
    
}

?>
