<?php

namespace Polyplus\Api\Database\Drivers\mysql;

use Polyplus\Api\Database\DatabaseCriteria;
use Polyplus\Api\Database\DatabaseEntity;
use Polyplus\Api\Database\DatabaseConnection;
use Polyplus\Api\Database\DatabaseCriterion;
use Polyplus\Api\Database\DatabaseProjection;
use Polyplus\Api\Database\DatabaseOrder;
use Polyplus\Api\Database\DatabaseTable;
use Polyplus\Api\Database\DatabaseColumn;
use Polyplus\Api\Database\DatabaseRestrictions;

/**
 * Description of Criteria
 *
 * @author rodrigohitec
 */
class Criteria implements DatabaseCriteria{
    
    private $conn;
    
    private $entity;
    
    private $mainCriterion;
    
    private $mainProjection;
    
    private $mainOrder;
    
    private $maxResults;
    
    function __construct(DatabaseEntity $entity, DatabaseConnection $conn) {
        $this->conn = $conn;
        $this->entity = $entity;
    }

    
    public function add(DatabaseCriterion $criterion) {
        
        if(!$this->mainCriterion) {
            $this->mainCriterion = $criterion;
        } else {
            $this->mainCriterion = DatabaseRestrictions::conjunction(array($this->mainCriterion, $criterion));
        }
        
    }
    
    public function hasCriterions() {
        if($this->mainCriterion) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getCriterion() {
        return $this->mainCriterion;
    }
    
    public function setProjection(DatabaseProjection $projection) {
        $this->mainProjection = $projection;
    }
    
    public function getProjection() {
        return $this->mainProjection;
    }

    public function addOrder(DatabaseOrder $order) {
        
        if(!$this->hasOrder()) {
            
            $this->mainOrder = $order->toString();
            
        } else {
            
            $this->mainOrder .= ", ".$order->toString();
            
        }
        
    }
    
    public function hasOrder() {
        if($this->mainOrder) {
            return true;
        } else {
            return false;
        }
    }

    public function setMaxResults($maxResults) {
        $this->maxResults = $maxResults;
    }
    
    public function hasMaxResults() {
        if($this->maxResults) {
            return true;
        } else {
            return false;
        }
    }
    
    public function toSqlString() {
        
        $sql = "";
        
        if ($this->mainCriterion) {
            
            $sql .= " where ".$this->mainCriterion->toString();
            
        }
        
        if($this->hasOrder()) {

            $sql.= " order by ".$this->mainOrder;

        }

        if($this->hasMaxResults()) {
            $sql.= " limit $this->maxResults";
        }

        return $sql;
            
        
    }

    public function toArray() {
        
        $stmt = $this->getSelectStatement();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, get_class($this->entity));
        
    }
    
    public function uniqueResult() {
        $stmt = $this->getSelectStatement();
        return $stmt->fetch($this->entity);
    }
    
    public function getSelectStatement() {
        $table = new DatabaseTable($this->entity->getEntityName());
        
        $select = new Select();
        
        if(!$this->mainProjection) {
            foreach ($this->entity->getColumnList() as $column) {
                $select->addColumn($column);
            }
        } else {
            $select->addColumn(new DatabaseColumn($table, $this->mainProjection->toString(), $this->mainProjection->getAlias()));
        }
        $select->addTable($table);
        $select->setCriteria($this);
        
        return $select->getStatement($this->conn);
    }

    public function getEntity() {
        return $this->entity;
    }


    
}

?>
