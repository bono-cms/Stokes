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

final class Add extends AbstractStoke
{
    /**
     * Shows adding form
     * 
     * @return string
     */
    public function indexAction()
    {
        $title = 'Add a stoke';
        
        return $this->view->render($this->getTemplatePath(), (array(
            'breadcrumbs' => array(
                '#' => $title
            ),
            
            'title' => $title
        )));
    }

    /**
     * Adds a record
     * 
     * @return string
     */
    public function addAction()
    {
        if ($this->request->isPost() && $this->request->isAjax()) {
            
            $formValidator = $this->getValidator();
            //...
        }
    }
}
