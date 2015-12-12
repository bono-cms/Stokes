<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Stokes\Controller\Admin;

use Admin\Controller\Admin\AbstractController;
use stdclass;

abstract class AbstractStoke extends AbstractController
{
    /**
     * Returns request container
     * 
     * @return \stdclass
     */
    final protected function getContainer()
    {
        $container = new stdclass;
        
        return $container;
    }

    /**
     * Returns configured validator instance
     * 
     * @return Validator
     */
    final protected function getValidator()
    {
        
    }

    /**
     * Returns template path
     * 
     * @return string
     */
    final protected function getTemplatePath()
    {
        
    }

    /**
     * Returns stoke manager
     * 
     * @return \Stokes\Service\StokeManager
     */
    final protected function getStokeManager()
    {
        return $this->moduleManager->getModule('Stokes')->getService('stokeManager');
    }
    
}
