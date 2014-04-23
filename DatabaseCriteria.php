<?php

namespace Polyplus\Api\Database;

/**
 * Creates a criteria to be used in filtered queries
 * 
 * @author rodrigohitec
 */
interface DatabaseCriteria extends DatabaseQuery {
    
    /**
     * 
     * @param DatabaseEntity $entity the entity to be used on the criteria
     * @param DatabaseConnection $conn the connectionn used to make queries
     */
    public function __construct(DatabaseEntity $entity, DatabaseConnection $conn);
    
    /**
     * Add a criterion to the filter
     * @param DatabaseCriterion $criterion the criterion to be added
     */
    public function add(DatabaseCriterion $criterion);
    
    /**
     * check if this criteria has criterions added.
     * @return boolean true if there is at least on criterion added. false otherwise.
     */
    public function hasCriterions();
    
    /**
     * @return DatabaseCriterion The filtered criterion
     */
    public function getCriterion();
    
    /**
     * set the projection of the resultant query.
     * @param DatabaseProjection $projection
     */
    public function setProjection(DatabaseProjection $projection);
    
    /**
     * @return DatabaseProjection The Projection od the Criteria
     */
    public function getProjection();
    
    /**
     * Adds an Ordering to the criteria
     * @param DatabaseOrder $order the order to be added
     */
    public function addOrder(DatabaseOrder $order);
    
    /**
     * check if this criteria is ordened.
     * @return boolean true if at least one order is set to the criteria. False otherwise
     */
    public function hasOrder();
    
    /**
     * Check if this criteria has a result limit.
     * @return boolean true if there is a limit. false otherwise.
     */
    public function hasMaxResults();
    
    /**
     * Set a maximum number of results this criteria can retrieve.
     * @param int $maxResults the maximum number of results
     */
    public function setMaxResults($maxResults);
    
    /**
     * @return string the sql code generated. the where, order by and limit statements
     */
    public function toSqlString();
        
    /**
     * @return DatabaseEntity The entity that is bound to this Criteria
     */
    public function getEntity();
    
}

?>
