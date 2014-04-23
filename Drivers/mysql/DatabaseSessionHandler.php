<?php

namespace Polyplus\Api\Database\Drivers\mysql;

use Polyplus\Api\Database\DatabaseSession;
use Polyplus\Api\Database\DatabaseConnection;
use Polyplus\Api\Database\DatabaseEntity;
use Polyplus\Api\Database\DatabaseTable;

/**
 * Description of SessionHandler
 *
 * @author rodrigohitec
 */
class DatabaseSessionHandler implements DatabaseSession{
    
    private $conn;
    
    public function __construct(DatabaseConnection $conn) {
        $this->conn = $conn;
    }

    public function delete(DatabaseEntity $entity) {
        
        $crit = $this->createFilteredCriteria($entity);
        
        $delete = new Delete();
        $delete->setTable(new DatabaseTable($entity->getEntityName()));
        $delete->setCriteria($crit);
        $delete->getStatement($this->conn)->execute();
        
    }

    public function save(DatabaseEntity $entity) {
        
        $crit = $this->createFilteredCriteria($entity);
        $entities = $crit->toArray();
        
        if(!$entities) {
            $insert = new Insert($entity);
            $insert->getStatement($this->conn)->execute();
        } else {
            $update = new Update($entity);
            $update->setCriteria($crit);
            $update->getStatement($this->conn)->execute();
        }
        
    }
    
    public function createCriteria(DatabaseEntity $entity) {
        return new Criteria($entity, $this->conn);
    }
    
    public function createFilteredCriteria(DatabaseEntity $entity) {
        
        $entityIdentifier = $entity->getIdentifier();
        $crit = $this->createCriteria($entity);
        
        foreach($entityIdentifier as $column=>$value) {
            $crit->add(\Polyplus\Api\Database\DatabaseRestrictions::eq($column, $value));
        }   
        
        return $crit;
        
    }

    public function createQuery($sql) {
        
        return new Query($sql, $this->conn);
        
    }

    public function close() {
    }

    
}

?>
