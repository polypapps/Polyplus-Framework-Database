<?php

namespace Polyplus\Api\Database;

/**
 * run a delete command on the database
 * 
 * 
 * @author rodrigohitec
 */
interface DatabaseDelete {
    
    /**
     * Sets the table when the row will be deleted
     * @param DatabaseTable $table
     */
    public function setTable(DatabaseTable $table);
    
    /**
     * adds an filter to the delete. If the criteria is not set, the delete will probaly drop all the table contents.
     * @param DatabaseCriteria $criteria
     */
    public function setCriteria(DatabaseCriteria $criteria);
    
    /**
     * 
     * @param DatabaseConnection $conn Teh connection to create the statement.
     * @return DatabaseStatement The delete statement generated
     */
    public function getStatement(DatabaseConnection $conn);
    
}

?>
