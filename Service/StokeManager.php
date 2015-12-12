<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) 2014 Bono Team
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Stokes\Service;

use Admin\Service\AbstractManager;
use Stokes\Storage\StokeMapperInterface;
use stdclass;

final class StokeManager extends AbstractManager implements StokeManagerInterface
{
	/**
	 * @var StokeMapperInterface
	 */
	private $stokeMapper;

	/**
	 * State initialization
	 * 
	 * @param StokeMapperInterface $stokeMapper Any mapper that implements this interface
	 * @return void
	 */
	public function __construct(StokeMapperInterface $stokeMapper)
	{
		$this->stokeMapper = $stokeMapper;
	}

	/**
	 * {@inheritDoc}
	 */
	protected function toObject(array $stoke)
	{
		$container = new stdclass();
		
		return $container;
	}

	/**
	 * Returns prepared paginator instance
	 * 
	 * @return Paginator
	 */
	public function getPaginator()
	{
		return $this->stokeMapper->getPaginator();
	}

	/**
	 * Returns last inserted id
	 * 
	 * @return integer
	 */
	public function getLastId()
	{
		return $this->stokeMapper->getLastId();
	}

	/**
	 * Add one more stoke
	 * 
	 * @param stdclass $container
	 * @return boolean
	 */
	public function add(stdclass $container)
	{
		return $this->stokeMapper->insert($container);
	}

	/**
	 * Updates a record
	 * 
	 * @param stdclass $container
	 * @return boolean
	 */
	public function update(stdclass $container)
	{
		return $this->stokeMapper->update($container);
	}

	/**
	 * Delete a record by its associated id
	 * 
	 * @param string $id
	 * @return boolean
	 */
	public function deleteById($id)
	{
		return $this->stokeMapper->deleteById($id);
	}

	/**
	 * Fetches a record by its associated id
	 * 
	 * @param string $id
	 * @return array
	 */
	public function fetchById($id)
	{
		return $this->prepareResult($this->stokeMapper->fetchById($id));
	}

	/**
	 * Fetch all published stokes
	 * 
	 * @return array
	 */
	public function fetchAllPublished()
	{
		return $this->prepareResult($this->stokeMapper->fetchAllPublished());
	}

	/**
	 * Fetch all published by page
	 * 
	 * @param integer $page
	 * @param integer $itemsPerPage
	 * @return array
	 */
	public function fetchAllPublishedByPage($page, $itemsPerPage)
	{
		return $this->prepareResults($this->stokeMapper->fetchAllPublishedByPage($page, $itemsPerPage));
	}
}
