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
     * Update settings
     * 
     * @param array $settings
     * @return boolean
     */
    public function updateSettings($settings);

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
     * Fetches stoke data by its associated id
     * 
     * @param string $id Stoke id
     * @param boolean $withTranslations Whether to fetch translations or not
     * @return array
     */
    public function fetchById($id, $withTranslations);
}
