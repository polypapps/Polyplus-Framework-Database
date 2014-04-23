<?php

namespace Polyplus\Api\Database;

/**
 *
 * @author rodrigohitec
 */
interface DatabaseInsert {
    
    
    public function setTable(DatabaseTable $table);
    
    public function addColumn(DatabaseColumn $column);
    
    public function getStatement(DatabaseConnection $conn);
    
    
}

?>
