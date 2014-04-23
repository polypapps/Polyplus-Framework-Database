<?php

namespace Polyplus\Api\Database;

/**
 * Description of DatabaseConnectionManager
 *
 * @author rodrigohitec
 */
class DatabaseConnectionManager {
    
    private $driver;
    private $host;
    private $database;
    private $username;
    private $password;
    
    function __construct($connectionName) {
        
        $file = $_SERVER['DOCUMENT_ROOT']."/Polyplus/Api/Database/connections/$connectionName.xml";
        if(file_exists($file)) {
            
            $xml = new \DOMDocument();
            $xml->load($file);
            foreach (get_object_vars($this) as $property=>$value) {
                $this->$property = $xml->getElementsByTagName($property)->item(0)->nodeValue;
            }
            
            
        } else {
            
        }
        //$this->driver = "mysql";
        
    }
    
    public function getDriver() {
        return $this->driver;
    }

    public function getHost() {
        return $this->host;
    }

    public function getDatabase() {
        return $this->database;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }



    
}

?>
