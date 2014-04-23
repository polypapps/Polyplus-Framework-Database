<?php

namespace Polyplus\Api\Database;

/**
 * A Representation of a filter created by the DatabaseRestrictions Class.
 *
 * @author rodrigohitec
 */
class DatabaseCriterion {
    
    private $content;
    private $parameters;
    
    function __construct($content, $parameters) {
        $this->content = $content;
        $this->parameters = $parameters;
    }
    
    public function getParameters() {
        return $this->parameters;
    }
    
    public function toString() {
        return $this->content;
    }

    
}

?>
