<?php
/**
 * Description of Generica
 *
 * @author Felipe
 */
class App_Model_Map_Adapter_Db implements App_Model_Map_Adapter_Interface {
    
    /**
     * @var Zend_Db_Table_Abstract Storage
     */
    protected $_dbTable;

    /**
     * @var array Identity map
     */
    protected $_loadedMap;
 
    public function __construct(Zend_Db_Table_Abstract $dbTable){
        $this->_dbTable = $dbTable;
    }       
    
    public function getAdapter(){
        return $this->_dbTable;
    }
    
    /**
     * Save colete
     * @param  Application_Model_AbstractDomain
     * @return Application_Model_Mapper
     */
    public function save( App_Model_AbstractDomain $model )
    {                              
        if (NULL === ($id = $model->retornarId())) {
            $table = $this->getDbTable();
            // save
            $id = $table->insert($data);

            $model->informarId($id);

            $this->_loadedMap[$id] = $model;
            
        } else {
            $this->getDbTable()->update($data, $classeModel->retornarArrayId());
        }

        return $this;
    }

    /**
     * Find one user by ID
     * @param  $id
     * @return Application_Model_User|null
     */
    public function find($id)
    {
        if (!$id)
            return NULL;

        if (isset($this->_loadedMap[$id]))
            return $this->_loadedMap[$id];

        $classeModel = $model->retornarClasseModelDado();
        
        $data = $classeModel->retornarMapeamentoDado();
        
        $rowset = $this->getDbTable()->find($id);

        if ($rowset->count() == 0)
            return NULL;

        $row = $rowset->current();                                 

        $this->_loadedMap[$id] = $classeModel->retornarMapeamentoDadoDb($row);

        return $this->_loadedMap[$id];
    }

    /**
     * Delete a user
     * @param Application_Model_User $user
     * @return void
     */
    public function delete($id)
    {
        if (NULL === ($id =$model->retornarId())) {
            throw new Exception('Object ID not set');
        } else {
            unset($this->_loadedMap[$id]);
            $classeModel = $model->retornarClasseModelDado();
            $this->getDbTable()->delete($classeModel->retornarArrayId());
        }
    }  
}