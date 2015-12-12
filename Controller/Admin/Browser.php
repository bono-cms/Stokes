<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) 2014 Bono Team
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Stokes\Controller\Admin;

use Admin\Controller\Admin\AbstractController;
use stdclass;

final class Browser extends AbstractController
{
	/**
	 * Default action
	 * 
	 * @param integer $page
	 * @return string
	 */
	public function indexAction($page = 1)
	{
		return $this->view->render('browser', array(
			'breadcrumbs' => array(
				'#' => 'Stokes'
			)
		));
	}

	/**
	 * Deletes a record
	 * 
	 * @return string
	 */
	public function deleteAction()
	{
		if ($this->request->hasPost('id') && $this->request->isAjax()) {
			$id = $this->request->getPost('id');
		}
	}

	/**
	 * Delete selected records
	 * 
	 * @return string
	 */
	public function deleteSelectedAction()
	{
		if ($this->request->hasPost('toDelete') && $this->request->isAjax()) {
			
			$ids = $this->request->getPost('toDelete');
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
			
			$container = new stdclass;
		}
	}
}
