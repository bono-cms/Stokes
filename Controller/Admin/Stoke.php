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
     * @param \Krystal\Stdlib\VirtualEntity|array $stoke
     * @return string
     */
    private function createForm($stoke, $title)
    {
        // Load view plugins
        $this->view->getPluginBag()
                   ->appendScript('@Stokes/admin/stoke.form.js')
                   ->load(array($this->getWysiwygPluginName(), 'datetimepicker'));

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
        $stoke->setPublished(true)
              ->setSeo(true);

        return $this->createForm($stoke, 'Add a stoke');
    }

    /**
     * Renders edit form
     * 
     * @param string $id
     * @return string
     */
    public function editAction($id)
    {
        $stoke = $this->getStokeManager()->fetchById($id, true);

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
        $paginator->setUrl($this->createUrl('Stokes:Admin:Stoke@gridAction', array(), 1));

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
     * @param string $id
     * @return string
     */
    public function deleteAction($id)
    {
        $service = $this->getModuleService('stokeManager');

        // Batch removal
        if ($this->request->hasPost('toDelete')) {
            $ids = array_keys($this->request->getPost('toDelete'));

            $service->deleteByIds($ids);
            $this->flashBag->set('success', 'Selected elements have been removed successfully');

        } else {
            $this->flashBag->set('warning', 'You should select at least one element to remove');
        }

        // Single removal
        if (!empty($id)) {
            $service->deleteById($id);
            $this->flashBag->set('success', 'Selected element has been removed successfully');
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
        $stokeManager = $this->getModuleService('stokeManager');
        $stokeManager->updateSettings($this->request->getPost());

        $this->flashBag->set('success', 'Configuration has been updated successfully');
        return '1';
    }

    /**
     * Persists a stoke
     * 
     * @return string
     */
    public function saveAction()
    {
        $input = $this->request->getPost();

        $formValidator = $this->createValidator(array(
            'input' => array(
                'source' => $input,
                'definition' => array(
                    'name' => new Pattern\Name(),
                    'introduction' => new Pattern\IntroText(),
                    'description'  => new Pattern\FullText(),
                )
            )
        ));

        if (1) {
            $service = $this->getModuleService('stokeManager');

            // Update
            if (!empty($input['stoke']['id'])) {
                if ($service->update($input)) {
                    $this->flashBag->set('success', 'The element has been updated successfully');
                    return '1';
                }

            } else {
                // Create
                if ($service->add($input)) {
                    $this->flashBag->set('success', 'The element has been created successfully');
                    return $service->getLastId();
                }
            }

        } else {
            return $formValidator->getErrors();
        }
    }
}
