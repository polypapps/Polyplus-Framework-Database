<?php

namespace Polyplus\Api\Database;

/**
 * Description of Restricions
 *
 * @author rodrigohitec
 */
class DatabaseRestrictions {
    
    public static function group(array $criterions, $constraint) {
        $content = "";
        
        $parameters = array();
        foreach ($criterions as $criterion) {
            
            $criterionContent = $criterion->toString();
            $content .= "($criterionContent) $constraint ";
            $parameters = array_merge($parameters, $criterion->getParameters());
        }
        $positionsToCut = (strlen($constraint)+2)*-1;
        $content = substr($content, 0, $positionsToCut);
        
        return new DatabaseCriterion($content, $parameters);
    }
    
    public static function compare($param1, $param2, $constraint) {
        return new DatabaseCriterion("$param1 $constraint ?", array($param2));
    }


    public static function conjunction(array $criterions) {
        return DatabaseRestrictions::group($criterions, "and");
    }
    
    public static function disjunction(array $criterions) {
        return DatabaseRestrictions::group($criterions, "or");
    }
    
    public static function eq($property, $value) {
        return DatabaseRestrictions::compare($property, $value, "=");
    }
    
    public static function eqProperty($property1, $property2) {
        return DatabaseRestrictions::compare($property1, $property2, "=");
    }
    
    public static function ge($property, $value) {
        return DatabaseRestrictions::compare($property, $value, ">=");
    }
    
    public static function geProperty($property1, $property2) {
        return DatabaseRestrictions::compare($property1, $property2, ">=");
    }
    
    public static function gt($property, $value) {
        return DatabaseRestrictions::compare($property, $value, ">");
    }
    
    public static function gtProperty($property1, $property2) {
        return DatabaseRestrictions::compare($property1, $property2, ">");
    }
    
    public static function le($property, $value) {
        return DatabaseRestrictions::compare($property, $value, "<=");
    }
    
    public static function leProperty($property1, $property2) {
        return DatabaseRestrictions::compare($property1, $property2, "<=");
    }
    
    public static function lt($property, $value) {
        return DatabaseRestrictions::compare($property, $value, "<");
    }
    
    public static function ltProperty($property1, $property2) {
        return DatabaseRestrictions::compare($property1, $property2, "<");
    }
    
    public static function ne($property, $value) {
        return DatabaseRestrictions::compare($property, $value, "!=");
    }
    
    public static function neProperty($property1, $property2) {
        return DatabaseRestrictions::compare($property1, $property2, "!=");
    }
    
    public static function not(DatabaseCriterion $criterion) {
        $content = $criterion->toString();
        return new DatabaseCriterion("not ($content)", $criterion->getParameters());
    }
    
    public static function like($property, $value) {
        return DatabaseRestrictions::compare($property, "'$value'", "like");
    }
    
}

?>
