<?php

namespace Polyplus\Api\Database;

/**
 *
 * @author intelimen18
 */
interface DatabaseQuery {
        
    /**
     * retrieve the list entities based on the filters of the criteria
     * @return array all the results of the query based on the filters.
     */
    public function toArray();
    
    /**
     * @return DatabaseEntity a single entity matching the filters.
     */
    public function uniqueResult();
    
    /**
     * @return DatabaseStatement the Select statement generated with this criteria.
     */
    public function getSelectStatement();
    
}

?>
