<?php

/**
 * @package application
 * @subpackage controllers
 */
class IndexController extends Zend_Controller_Action {

    public function indexAction()
    {
   $this->_helper->layout->setLayout('login');
    }

}
