<?php

/**
 * Router
 * 
 * @category    Rudoman
 * @package     Rudoman_Dailydeal
 * @author      Evgenia Rudoman (evgenia.rudoman@gmail.com)
 */

class Rudoman_Dailydeal_Controller_Router extends Mage_Core_Controller_Varien_Router_Standard 
{


    /**
     * Validate and Match Daily Deals Page and modify request
     *
     * @param Zend_Controller_Request_Http $request
     * @return bool
     */
    public function match(Zend_Controller_Request_Http $request)
    {        
        if (!Mage::isInstalled()) {
            Mage::app()->getFrontController()->getResponse()
                ->setRedirect(Mage::getUrl('install'))
                ->sendResponse();
            exit;
        }
        
        $url = Mage::getStoreConfig(Rudoman_Dailydeal_Helper_Data::CONFIG_DAILYDEAL_COLUMNS . 'url');
        $active = Mage::getStoreConfig(Rudoman_Dailydeal_Helper_Data::CONFIG_DAILYDEAL_COLUMNS . 'display');
        $identifier = trim($request->getPathInfo(), '/');
        
        if ($identifier != $url || !$active)
            return false;
        else {           
            $moduleName = 'Rudoman_Dailydeal';
            $controller = 'index';
            $action = 'index';

            $request->setModuleName($moduleName)
                ->setControllerName($controller)
                ->setActionName($action)
                ->setControllerModule($moduleName)
                ->setRouteName('rudoman_dailydeal');
            
            $controllerClassName = $this->_validateControllerClassName($request->getControllerModule(), $request->getControllerName());
            if (!$controllerClassName)
                return false;

            $controllerInstance = Mage::getControllerInstance($controllerClassName, $request, $this->getFront()->getResponse());
            if (!$controllerInstance->hasAction($action))
                return false;
            
            $request->setDispatched(true);
            $controllerInstance->dispatch($request->getActionName());
            
            return true;
        }
    }

}