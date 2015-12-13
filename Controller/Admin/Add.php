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

use Krystal\Stdlib\VirtualEntity;

final class Add extends AbstractStoke
{
    /**
     * Shows adding form
     * 
     * @return string
     */
    public function indexAction()
    {
        $this->loadBreadcrumbs('Add a stoke');

        $stoke = new VirtualEntity();
        $stoke->setPublished(true);

        return $this->view->render($this->getTemplatePath(), array(
            'title' => 'Add a stoke',
            'stoke' => $stoke
        ));
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
