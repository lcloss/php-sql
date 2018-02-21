<?php

namespace LCloss\Sql;

class Sql {

    private $config;
    private $conn;
    private $stmt;
    
    public function __construct($config = [
        'dbdriver' => '', 
        'dbhost' => '', 
        'dbname' => '', 
        'dbuser' => '', 
        'dbpass' => '',
    ])
    {
        if (!isset($config['dbdriver'])) {
            throw new \Exception("DB Driver is not defined.");
        }
        if (!isset($config['dbhost'])) {
            throw new \Exception("DB Host is not defined.");
        }
        if (!isset($config['dbname'])) {
            throw new \Exception("DB Name is not defined.");
        }
        
        if ($config['dbdriver'] != 'sqlite' ) {
            if (!isset($config['dbuser'])) {
                throw new \Exception("DB User is not defined.");
            }
            if (!isset($config['dbpass'])) {
                throw new \Exception("DB Password is not defined.");
            }
        }
        
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_EMULATE_PREPARES => false
        ];
        
        switch ($config['dbdriver']) {
            case 'mysql':
                $dsn = "mysql:dbname=".$config['dbname'].";host=".$config['dbhost'];
                $this->conn = new \PDO(
                    $dsn,
                    $config['dbuser'],
                    $config['dbpass'],
                    $options
                    );
                break;
                
            case 'mssql':
                $dsn = "sqlsrv:Server=".$config['dbhost'].";Database=".$config['dbname'];
                $this->conn = new \PDO(
                    $dsn,
                    $config['dbuser'],
                    $config['dbpass']
                );
                break;
                
            case 'sqlite':
                $dsn = "sqlite2:".$config['dbname'];
                $this->conn = new \PDO($dsn);
                break;
                
            default:
                throw new \Exception("DB Driver " . $config['dbdriver'] . " is not defined." );
        }
    }
        
    private function _setParams($statement, $parameters = array())
    {
        
        foreach ($parameters as $key => $value) {
            
            $this->_bindParam($statement, $key, $value);
            
        }
        
    }
    
    private function _bindParam($statement, $key, $value)
    {
        
        $statement->bindParam($key, $value);
        
    }
    
    public function query($rawQuery, $params = array())
    {
        
        $this->stmt = $this->conn->prepare($rawQuery);
        
        $this->_setParams($this->stmt, $params);
        
        $this->stmt->execute();
        
    }
    
    public function select($rawQuery, $params = array()):array
    {
        
        $this->stmt = $this->conn->prepare($rawQuery);
        
        $this->_setParams($this->stmt, $params);
        
        $this->stmt->execute();
        
        return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
        
    }
    
    public function getLastInsertedId()
    {
        return $this->conn->lastInsertId();
    }
    
    public function beginTransaction() 
    {
        $this->conn->beginTransaction();
    }
    
    public function commit()
    {
        $this->conn->commit();
    }
    
    public function rollback()
    {
        $this->conn->rollBack();
    }
}