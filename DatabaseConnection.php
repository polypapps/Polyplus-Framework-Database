<?php

namespace Polyplus\Api\Database;

/**
 * Description of DatabaseConnection
 * 
 * Represents a connection between the PHP and a Database Server
 *
 * @author rodrigohitec
 */
class DatabaseConnection extends \PDO{
    
    private $connectionName = "base";
    private $driver;


    public function __construct($connectioName = "") {
        
        if($connectioName != "") {
            $this->connectionName = $connectioName;
        }
        
        $dcm = new DatabaseConnectionManager($this->connectionName);
        $this->driver = $dcm->getDriver();
        
        $file = $_SERVER['DOCUMENT_ROOT'].'/Polyplus/Api/Database/Drivers/'.$this->driver;
        if (!is_dir($file)) {
            throw new DatabaseException("Não foi possível encontrar o Driver $this->driver em $file");
        }
        
        try {
            parent::__construct($this->driver.':host='.$dcm->getHost().';dbname='.$dcm->getDatabase(), $dcm->getUsername(),$dcm->getPassword());
            $this->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->exec("set names utf8");
        } catch (\PDOException $e) {
            throw new DatabaseException($e->getMessage(),$e->getCode(),$e->getPrevious());
        }
    }
    
    /**
     * 
     * @return \Polyplus\Api\Database\DatabaseSession
     */
    public function openSession() {
        $class = "\\Polyplus\\Api\\Database\\Drivers\\$this->driver\\DatabaseSessionHandler";
        return new $class($this);
    }
    
}

?>
