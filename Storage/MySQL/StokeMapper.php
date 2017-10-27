<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Stokes\Storage\MySQL;

use Cms\Storage\MySQL\AbstractMapper;
use Cms\Storage\MySQL\WebPageMapper;
use Stokes\Storage\StokeMapperInterface;

final class StokeMapper extends AbstractMapper implements StokeMapperInterface
{
    /**
     * {@inheritDoc}
     */
    public static function getTableName()
    {
        return self::getWithPrefix('bono_module_stokes');
    }

    /**
     * {@inheritDoc}
     */
    public static function getTranslationTable()
    {
        return StokeTranslationMapper::getTableName();
    }

    /**
     * Returns shared columns
     * 
     * @return array
     */
    private function getColumns()
    {
        return array(
            self::getFullColumnName('id'),
            self::getFullColumnName('start'),
            self::getFullColumnName('end'),
            self::getFullColumnName('published'),
            self::getFullColumnName('seo'),
            self::getFullColumnName('cover'),
            StokeTranslationMapper::getFullColumnName('lang_id'),
            StokeTranslationMapper::getFullColumnName('web_page_id'),
            StokeTranslationMapper::getFullColumnName('name'),
            StokeTranslationMapper::getFullColumnName('title'),
            StokeTranslationMapper::getFullColumnName('introduction'),
            StokeTranslationMapper::getFullColumnName('description'),
            StokeTranslationMapper::getFullColumnName('keywords'),
            StokeTranslationMapper::getFullColumnName('meta_description'),
            WebPageMapper::getFullColumnName('slug')
        );
    }

    /**
     * Updates published state of a stoke
     * 
     * @param string $id Stoke id
     * @param string $state The state. Either 1 or 0
     * @return boolean
     */
    public function updatePublishedState($id, $state)
    {
        return $this->updateColumnByPk($id, 'published', $state);
    }

    /**
     * Fetch all records filtered by pagination
     * 
     * @param integer $page
     * @param integer $itemsPerPage
     * @param boolean $published Whether to fetch only published stokes
     * @return array
     */
    public function fetchAllByPage($page, $itemsPerPage, $published)
    {
        $db = $this->createWebPageSelect($this->getColumns())
                    // Language ID filter
                    ->whereEquals(StokeTranslationMapper::getFullColumnName('lang_id'), $this->getLangId());

        if ($published === true) {
            $db->andWhereEquals(self::getFullColumnName('published'), '1')
               ->orderBy(self::getFullColumnName('end'))
               ->desc();
        } else {
            $db->orderBy(self::getFullColumnName('id'))
               ->desc();
        }

        if ($page !== null && $itemsPerPage !== null) {
            $db->paginate($page, $itemsPerPage);
        }

        return $db->queryAll();
    }

    /**
     * Fetch all published
     * 
     * @return array
     */
    public function fetchAllPublished()
    {
        return $this->fetchAllByPage(null, null, true);
    }

    /**
     * Fetches stoke data by its associated id
     * 
     * @param string $id Stoke id
     * @param boolean $withTranslations Whether to fetch translations or not
     * @return array
     */
    public function fetchById($id, $withTranslations)
    {
        return $this->findWebPage($this->getColumns(), $id, $withTranslations);
    }
}
