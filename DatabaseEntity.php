<?php

namespace Polyplus\Api\Database;

/**
 *
 * @author rodrigohitec
 */
interface DatabaseEntity {
    
    public function getEntityName();
    
    public function getIdentifier();
    
    public function getColumnList();
    
}

?>
