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

final class Edit extends AbstractStoke
{
    /**
     * Shows edit form
     * 
     * @param string $id
     * @return string
     */
    public function indexAction($id)
    {
        $stoke = $this->getStokeManager()->fetchById($id);

        if ($stoke !== false) {

            $title = 'Edit the stoke';
            $this->loadBreadcrumbs('Add a stoke');

            return $this->view->render($this->getTemplatePath(), array(
                'title' => $title
            ));

        } else {
            return false;
        }
    }

    /**
     * Updates a stoke
     * 
     * @return string
     */
    public function updateAction()
    {
        if ($this->request->isPost() && $this->request->isAjax()) {
            
            $formValidator = $this->getValidator();
            
            if (1) {
                
                $stokeManager = $this->getStokeManager();
                $stokeManager->update($this->getContainer());
                
                $this->flashMessenger->set('success', 'A stoke has been update successfully');
                
                return '1';
            
            } else {
                
                return $formValidator->getErrors();
            }
        }
    }
}
