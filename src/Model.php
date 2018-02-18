<?php

namespace LCloss\Sql;

class Model {
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
    
}