<?php

namespace LCloss\Sql;

class Model {
    const MSG_ERROR = 'MSG_ERROR';
    const MSG_SUCCESS = 'MSG_SUCCESS';
    
    private $values =  [];

    /**
     * Magic Function when call <Class>->set<column>(<args>) or <Class>->get<column>(<args>)
     * 
     * @param method name $name
     * @param args passed to the method $args
     * @return NULL|mixed
     */
    public function __call($name, $args)
    {
        $method = substr($name, 0, 3);
        $columnName = substr($name, 3, strlen($name) - 3);
        
        switch ($method)
        {
            case 'get':
                return (isset($this->values[$columnName]) ? $this->values[$columnName] : NULL);
                break;
                
            case 'set':
                $this->values[$columnName] = $args[0];
                break;
        }
    }
    
    /**
     * Set all data to the Model
     * 
     * @param array of columns $data
     */
    public function setData($data)
    {
        foreach ($data as $key => $value)
        {
            $this->{"set" . $key}($value);
        }
    }
    
    /**
     * Get all values from the Model
     * 
     * @return array
     */
    public function getValues()
    {
        return $this->values;
    }
 
    public static function clearMsgError()
    {
        $_SESSION[Model::MSG_ERROR] = NULL;
    }
    
    public static function clearMsgSuccess()
    {
        $_SESSION[Model::MSG_SUCCESS] = NULL;
    }
    
    public static function setMsgError($msg)
    {
        $_SESSION[Model::MSG_ERROR] = $msg;
    }
    
    public static function setMsgSuccess($msg)
    {
        $_SESSION[Model::MSG_SUCCESS] = $msg;
    }
    
    public static function getMsgError()
    {
        $msg = ( isset($_SESSION[Model::MSG_ERROR]) && $_SESSION[Model::MSG_ERROR] != '' ? $_SESSION[Model::MSG_ERROR] : '' );
        self::clearMsgError();
        return $msg;
    }
    
    public static function getMsgSuccess()
    {
        $msg = ( isset($_SESSION[Model::MSG_SUCCESS]) && $_SESSION[Model::MSG_SUCCESS] != '' ? $_SESSION[Model::MSG_SUCCESS] : '' );
        self::clearMsgSuccess();
        return $msg;
    }
}