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
use Krystal\Stdlib\ArrayUtils;

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
        $entity->setId((int) $stoke['id'])
               ->setLangId($stoke['lang_id'])
               ->setTimestampStart($stoke['timestamp_start'])
               ->setTimestampEnd($stoke['timestamp_end'])
               ->setName($stoke['name'])
               ->setTitle($stoke['title'])
               ->setIntroduction($stoke['introduction'])
               ->setDescription($stoke['description'])
               ->setKeywords($stoke['keywords'])
               ->setMetaDescription($stoke['meta_description'])
               ->setCover($stoke['cover']);

        return $entity;
    }

    /**
     * Update published states by their associated ids
     * 
     * @param array $pair
     * @return boolean
     */
    public function updatePublished(array $pair)
    {
        foreach ($pair as $id => $state) {
            if (!$this->stokeMapper->updatePublishedState($id, $state)) {
                return false;
            }
        }

        return true;
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
     * Adds a stoke
     * 
     * @param array $input Raw input data
     * @return boolean
     */
    public function add(array $input)
    {
        return $this->stokeMapper->insert(ArrayUtils::arrayWithout($input, array('slug')));
    }

    /**
     * Updates a stoke
     * 
     * @param array $input Raw input data
     * @return boolean
     */
    public function update(array $input)
    {
        return $this->stokeMapper->update(ArrayUtils::arrayWithout($input, array('slug')));
    }

    /**
     * Deletes a stoke by its associated id
     * 
     * @param string $id
     * @return boolean
     */
    public function deleteById($id)
    {
        return $this->stokeMapper->deleteById($id);
    }

    /**
     * Delete stokes by their associated ids
     * 
     * @param array $ids Collection of ids
     * @return boolean
     */
    public function deleteByIds(array $ids)
    {
        foreach ($ids as $id) {
            if ($this->stokeMapper->deleteById($id)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Fetches stoke's entity by its associated id
     * 
     * @param string $id
     * @return array
     */
    public function fetchById($id)
    {
        return $this->prepareResult($this->stokeMapper->fetchById($id));
    }

    /**
     * Fetches all published stoke entities
     * 
     * @return array
     */
    public function fetchAllPublished()
    {
        return $this->prepareResult($this->stokeMapper->fetchAllPublished());
    }

    /**
     * Fetches all stoke entities filtered by pagination
     * 
     * @param integer $page
     * @param integer $itemsPerPage
     * @param boolean $published Whether to fetch only published ones
     * @return array
     */
    public function fetchAllByPage($page, $itemsPerPage, $published)
    {
        return $this->prepareResults($this->stokeMapper->fetchAllByPage($page, $itemsPerPage, $published));
    }
}
