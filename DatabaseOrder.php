<?php

namespace Polyplus\Api\Database;

/**
 * Description of DatabaseOrder
 *
 * @author rodrigohitec
 */
class DatabaseOrder {
    
    private $string;
    
    function __construct($propertyName, $ascending = true) {
        $this->string = "$propertyName";
        if (!$ascending) {
            $this->string .= " desc";
        }
    }
    
    function toString() {
        return $this->string;
    }

    
}

?>
