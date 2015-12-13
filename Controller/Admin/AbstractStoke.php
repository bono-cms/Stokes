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
     * Loads shared view plugins
     * 
     * @return void
     */
    final protected function loadSharedPlugins()
    {
        $this->view->getPluginBag()
                   ->appendScript('@Stokes/admin/stoke.form.js')
                   ->load(array($this->getWysiwygPluginName(), 'datepicker'));
    }

    /**
     * Load breadcrumbs for a view
     * 
     * @param string $title
     * @return void
     */
    final protected function loadBreadcrumbs($title)
    {
        $this->view->getBreadcrumbBag()->addOne('Stokes', 'Stokes:Admin:Browser@indexAction')
                                       ->addOne($title);
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
