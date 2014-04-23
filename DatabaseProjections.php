<?php

namespace Polyplus\Api\Database;

/**
 * Description of DatabaseProjections
 *
 * @author root
 */
class DatabaseProjections {
    
    public static function alias(DatabaseProjection &$projection, $alias) {
        $projection->setAlias($alias);
    }


    public static function avg($property) {
        
        return new DatabaseProjection("avg($property)");
        
    }
    
    public static function max($property) {
        
        return new DatabaseProjection("max($property)");
        
    }
    
    public static function min($property) {
        
        return new DatabaseProjection("min($property)");
        
    }
    
    public static function count($property) {
        
        return new DatabaseProjection("count($property)");
        
    }
    
    public static function sum($property) {
        
        return new DatabaseProjection("sum($property)");
        
    }
    
}

?>
