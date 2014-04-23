<?php

namespace Polyplus\Api\Database;

/**
 * A representation of an aggregation created by DatabaseProjections Class
 *
 * @author root
 */
class DatabaseProjection {
    
    private $content;
    
    private $alias;
    
    function __construct($content) {
        $this->content = $content;
    }
    
    public function getAlias() {
        return $this->alias;
    }

    public function setAlias($alias) {
        $this->alias = $alias;
    }

        
    public function toString() {
        return $this->content;
    }
}

?>
