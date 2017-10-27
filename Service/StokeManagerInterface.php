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

interface StokeManagerInterface
{
    /**
     * Update published states by their associated ids
     * 
     * @param array $pair
     * @return boolean
     */
    public function updatePublished(array $pair);

    /**
     * Returns prepared paginator instance
     * 
     * @return \Krystal\Paginate\Paginator
     */
    public function getPaginator();

    /**
     * Returns last inserted id
     * 
     * @return integer
     */
    public function getLastId();

    /**
     * Adds a stoke
     * 
     * @param array $input Raw input data
     * @return boolean
     */
    public function add(array $input);

    /**
     * Updates a stoke
     * 
     * @param array $input Raw input data
     * @return boolean
     */
    public function update(array $input);

    /**
     * Deletes a stoke by its associated id
     * 
     * @param string $id
     * @return boolean
     */
    public function deleteById($id);

    /**
     * Delete stokes by their associated ids
     * 
     * @param array $ids Collection of ids
     * @return boolean
     */
    public function deleteByIds(array $ids);

    /**
     * Fetches stoke's entity by its associated id
     * 
     * @param string $id
     * @param boolean $withTranslations Whether to fetch translations
     * @return array
     */
    public function fetchById($id, $withTranslations);

    /**
     * Fetches all published stoke entities
     * 
     * @return array
     */
    public function fetchAllPublished();

    /**
     * Fetches all stoke entities filtered by pagination
     * 
     * @param integer $page
     * @param integer $itemsPerPage
     * @param boolean $published Whether to fetch only published ones
     * @return array
     */
    public function fetchAllByPage($page, $itemsPerPage, $published);
}
