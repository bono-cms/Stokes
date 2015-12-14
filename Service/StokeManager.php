<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Stokes\Service;

use Cms\Service\AbstractManager;
use Stokes\Storage\StokeMapperInterface;
use Krystal\Stdlib\VirtualEntity;

final class StokeManager extends AbstractManager implements StokeManagerInterface
{
    /**
     * Any compliant stoke mapper
     * 
     * @var \Stokes\Storage\StokeMapperInterface
     */
    private $stokeMapper;

    /**
     * State initialization
     * 
     * @param \Stokes\Storage\StokeMapperInterface $stokeMapper
     * @return void
     */
    public function __construct(StokeMapperInterface $stokeMapper)
    {
        $this->stokeMapper = $stokeMapper;
    }

    /**
     * {@inheritDoc}
     */
    protected function toEntity(array $stoke)
    {
        $entity = new VirtualEntity();
        // @TODO: to be populated
        return $entity;
    }

    /**
     * Returns prepared paginator instance
     * 
     * @return \Krystal\Paginate\Paginator
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
     * @param array $input Raw input data
     * @return boolean
     */
    public function add(array $input)
    {
        return $this->stokeMapper->insert($input);
    }

    /**
     * Updates a record
     * 
     * @param array $input Raw input data
     * @return boolean
     */
    public function update(array $input)
    {
        return $this->stokeMapper->update($input);
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
