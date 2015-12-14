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

final class Browser extends AbstractController
{
    /**
     * Displays a grid
     * 
     * @param integer $page Current page number
     * @return string
     */
    public function indexAction($page = 1)
    {
        $stokeManager = $this->getModuleService('stokeManager');

        // Fetch stoke entities for display
        $stokes = $stokeManager->fetchAllByPage($page, $this->getSharedPerPageCount(), false);

        // Tweak pagination
        $paginator = $stokeManager->getPaginator();
        $paginator->setUrl('/admin/module/stokes/page/(:var)');

        // Append a breadcrumb
        $this->view->getBreadcrumbBag()
                   ->addOne('Stokes');

        return $this->view->render('browser', array(
            'title' => 'Stokes',
            'stokes' => $stokes,
            'paginator' => $paginator
        ));
    }

    /**
     * Deletes a stoke
     * 
     * @return string
     */
    public function deleteAction()
    {
        if ($this->request->hasPost('id') && $this->request->isAjax()) {
            $id = $this->request->getPost('id');

            $stokeManager = $this->getModuleService('stokeManager');
            $stokeManager->deleteById($id);

            $this->flashBag->set('success', 'The stoke has been removed successfully');
            return '1';
        }
    }

    /**
     * Delete selected stokes
     * 
     * @return string
     */
    public function deleteSelectedAction()
    {
        if ($this->request->hasPost('toDelete') && $this->request->isAjax()) {
            $ids = array_keys($this->request->getPost('toDelete'));

            $stokeManager = $this->getModuleService('stokeManager');
            $stokeManager->deleteByIds($ids);

            $this->flashBag->set('success', 'Selected stokes have been removed successfully');
            return '1';
        }
    }

    /**
     * Saves the table table
     * 
     * @return string
     */
    public function saveAction()
    {
        if ($this->request->isPost() && $this->request->isAjax()) {
        }
    }
}
