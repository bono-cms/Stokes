<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Stokes\Storage;

interface StokeMapperInterface
{
    /**
     * Updates published state of a stoke
     * 
     * @param string $id Stoke id
     * @param string $state The state. Either 1 or 0
     * @return boolean
     */
    public function updatePublishedState($id, $state);

    /**
     * Fetch all records filtered by pagination
     * 
     * @param integer $page
     * @param integer $itemsPerPage
     * @param boolean $published Whether to fetch only published stokes
     * @return array
     */
    public function fetchAllByPage($page, $itemsPerPage, $published);

    /**
     * Fetch all published
     * 
     * @return array
     */
    public function fetchAllPublished();

    /**
     * Fetches a record by its associated id
     * 
     * @param string $id
     * @return array
     */
    public function fetchById($id);

    /**
     * Delete a record by its associated id
     * 
     * @param string $id
     * @return string
     */
    public function deleteById($id);

    /**
     * Insert a record
     * 
     * @param array $input Raw input data
     * @return boolean
     */
    public function insert(array $input);

    /**
     * Updates a record
     * 
     * @param array $input Raw input data
     * @return void
     */
    public function update(array $input);
}
