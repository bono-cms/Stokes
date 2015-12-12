<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) 2014 Bono Team
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Stokes\Storage\MySQL;

use Kernel\Storage\MySQL\AbstractMapper;
use Stokes\Storage\StokeMapperInterface;
use stdclass;

final class StokeMapper extends AbstractMapper implements StokeMapperInterface
{
	/**
	 * {@inheritDoc}
	 */
	protected $table = 'bono_module_stokes';

	/**
	 * Count all records
	 * 
	 * @return integer
	 */
	private function countAll()
	{
		return $this->db->count($this->table, array(
			'langId' => $this->getLangId()
		));
	}

	/**
	 * Count all published records
	 * 
	 * @return integer
	 */
	private function countAllPublished()
	{
		return $this->db->count($this->table, array(
			
			'langId'	=> $this->getLangId(),
			'published'	=> '1'
		));
	}

	/**
	 * Fetch all records filtered by pagination
	 * 
	 * @param integer $page
	 * @param integer $itemsPerPage
	 * @return array
	 */
	public function fetchAllByPage($page, $itemsPerPage)
	{
		// Tweak paginator's instance
		$this->paginator->setTotalAmount($this->countAll())
						->setItemsPerPage($itemsPerPage)
						->setCurrentPage($page);
		
		// Now build a query
		$query = sprintf('SELECT * FROM `%s` WHERE `langId` = :langId LIMIT %s, %s', 
			$this->table, 
			$this->paginator->countOffset(), 
			$this->paginator->getItemsPerPage()
		);
		
		return $this->db->queryAll($query, array(
			':langId' => $this->getLangId()
		));
	}

	/**
	 * Fetch all published
	 * 
	 * @param integer $page
	 * @param integer $itemsPerPage
	 * @return array
	 */
	public function fetchAllPublishedByPage($page, $itemsPerPage)
	{
		// Tweak paginator's instance
		$this->paginator->setTotalAmount($this->countAllPublished())
						->setItemsPerPage($itemsPerPage)
						->setCurrentPage($page);
		
		// Now build a query
		$query = sprintf('SELECT * FROM `%s` WHERE `langId` =:langId AND `published` =:published LIMIT %s, %s', 
			$this->table, 
			$this->paginator->countOffset(), 
			$this->paginator->getItemsPerpage()
		);
		
		return $this->db->queryAll($query, array(
			':langId' => $this->getLangId(),
			':published' => '1'
		));
	}

	/**
	 * Fetch all published
	 * 
	 * @return array
	 */
	public function fetchAllPublished()
	{
		// Build a query
		$query = sprintf('SELECT * FROM `%s` WHERE `langId` = :langId AND `published` = :published', $this->table);
		
		return $this->db->queryAll($query, array(
			':langId' => $this->getLangId(),
			':published' => '1'
		));
	}

	/**
	 * Fetches a record by its associated id
	 * 
	 * @param string $id
	 * @return array
	 */
	public function fetchById($id)
	{
		$query = sprintf('SELECT * FROM `%s` WHERE `id` =:id', $this->table);
		return $this->db->query($query, array(
			':id' => $id
		));
	}

	/**
	 * Delete a record by its associated id
	 * 
	 * @param string $id
	 * @return string
	 */
	public function deleteById($id)
	{
		return $this->db->delete($this->table, array(
			'id' => $id
		));
	}
	
	/**
	 * Inserta a record
	 * 
	 * @param stdclass $container
	 * @return boolean
	 */
	public function insert(stdclass $container)
	{
		return $this->db->insert($this->table, array(
			
		));
	}

	/**
	 * Updates a record
	 * 
	 * @param stdclass $container
	 * @return void
	 */
	public function update(stdclass $container)
	{
		return $this->db->update($this->table, array(
			
			
		), array('id' => $container->id));
	}
}
