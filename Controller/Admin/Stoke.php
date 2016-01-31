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
use Krystal\Validate\Pattern;
use Krystal\Stdlib\VirtualEntity;

final class Stoke extends AbstractController
{
    /**
     * Returns stoke manager
     * 
     * @return \Stokes\Service\StokeManager
     */
    private function getStokeManager()
    {
        return $this->getModuleService('stokeManager');
    }

    /**
     * Creates a form
     * 
     * @param \Krystal\Stdlib\VirtualEntity $stoke
     * @return string
     */
    private function createForm(VirtualEntity $stoke, $title)
    {
        // Load view plugins
        $this->view->getPluginBag()
                   ->appendScript('@Stokes/admin/stoke.form.js')
                   ->load(array($this->getWysiwygPluginName(), 'datepicker'));

        // Append breadcrumbs
        $this->view->getBreadcrumbBag()->addOne('Stokes', 'Stokes:Admin:Stoke@gridAction')
                                       ->addOne($title);

        return $this->view->render('stoke.form', array(
            'stoke' => $stoke
        ));
    }

    /**
     * Renders empty form
     * 
     * @return string
     */
    public function addAction()
    {
        $stoke = new VirtualEntity();
        $stoke->setPublished(true);

        return $this->createForm($stoke, 'Add a stoke');
    }

    /**
     * Renders edit form
     * 
     * @param string $id
     * @return string
     */
    public function editForm($id)
    {
        $stoke = $this->getStokeManager()->fetchById($id);

        if ($stoke !== false) {
            return $this->createForm($stoke, 'Edit the stoke');
        } else {
            return false;
        }
    }

    /**
     * Renders a grid
     * 
     * @param integer $page Current page number
     * @return string
     */
    public function gridAction($page = 1)
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
        // Batch removal
        if ($this->request->hasPost('toDelete') && $this->request->isAjax()) {
            $ids = array_keys($this->request->getPost('toDelete'));

            $stokeManager = $this->getModuleService('stokeManager');
            $stokeManager->deleteByIds($ids);

            $this->flashBag->set('success', 'Selected stokes have been removed successfully');
        }

        // Single removal
        if ($this->request->hasPost('id') && $this->request->isAjax()) {
            $id = $this->request->getPost('id');

            $stokeManager = $this->getModuleService('stokeManager');
            $stokeManager->deleteById($id);

            $this->flashBag->set('success', 'The stoke has been removed successfully');
        }

        return '1';
    }

    /**
     * Save changes
     * 
     * @return string
     */
    public function tweakAction()
    {
        if ($this->request->isPost() && $this->request->isAjax()) {
            $published = $this->request->getPost('published');

            $stokeManager = $this->getModuleService('stokeManager');
            $stokeManager->updatePublished($published);

            $this->flashBag->set('success', 'Configuration has been updated successfully');
            return '1';
        }
    }

    /**
     * Persists a stoke
     * 
     * @return string
     */
    public function saveAction()
    {
        $input = $this->request->getPost('stoke');

        $formValidator = $this->validatorFactory->build(array(
            'input' => array(
                'source' => $input,
                'definition' => array(
                    'title' => new Pattern\Title(),
                    'introduction' => new Pattern\IntroText(),
                    'full'  => new Pattern\FullText(),
                )
            )
        ));

        if ($formValidator->isValid()) {
            $stokeManager = $this->getModuleService('stokeManager');

            if ($input['id']) {
                $stokeManager->update($this->request->getPost('stoke'));
                $this->flashMessenger->set('success', 'The stoke has been update successfully');
                return '1';

            } else {

                $stokeManager->add($input);
                $this->flashBag->set('success', 'A stoke has been added successfully');
                return $stokeManager->getLastId();
            }

        } else {
            return $formValidator->getErrors();
        }
        
    }
}
