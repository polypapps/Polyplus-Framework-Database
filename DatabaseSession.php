<?php

namespace Polyplus\Api\Database;

/**
 *
 * @author rodrigohitec
 */
interface DatabaseSession {
    
    public function save(DatabaseEntity $entity);
    
    public function delete(DatabaseEntity $entity);
    
    /**
     * 
     * @param \Polyplus\Api\Database\DatabaseEntity $entity
     * @return \Polyplus\Api\Database\DatabaseCriteria The criteria created.
     */
    public function createCriteria(DatabaseEntity $entity);

    public function createFilteredCriteria(DatabaseEntity $entity);
    
    /**
     * 
     * @param type $sql
     * @return DatabaseQuery Description
     */
    public function createQuery($sql);
    
    public function close();
    
}

?>
