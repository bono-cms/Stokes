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

use Cms\Controller\Admin\AbstractController;

abstract class AbstractStoke extends AbstractController
{
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
        return 'stoke.form';
    }

    /**
     * Returns stoke manager
     * 
     * @return \Stokes\Service\StokeManager
     */
    final protected function getStokeManager()
    {
        return $this->getModuleService('stokeManager');
    }
}
