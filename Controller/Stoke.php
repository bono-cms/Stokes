<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Stokes\Controller;

use Site\Controller\AbstractController;

final class Stoke extends AbstractController
{
    /**
     * Lists all stokes
     * 
     * @param integer $page
     * @return string
     */
    public function listAction($page = 1)
    {
    }

    /**
     * Views a stoke
     * 
     * @param string $id
     * @return string
     */
    public function indexAction($id)
    {
        $sm = $this->getModuleService('stokeManager');
        $stoke = $sm->fetchById($id, false);

        if ($stoke !== false) {
            $this->loadSitePlugins();

            // Append a breadcrumbs
            $this->view->getBreadcrumbBag()->addOne($stoke->getName());

            return $this->view->render('stoke-single', array(
                'stoke' => $stoke,
                'page' => $stoke,
                'languages' => $sm->getSwitchUrls($id)
            ));

        } else {
            return false;
        }
    }
}
