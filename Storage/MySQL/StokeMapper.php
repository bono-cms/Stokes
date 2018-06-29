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
            self::column('id'),
            self::column('start'),
            self::column('end'),
            self::column('published'),
            self::column('seo'),
            self::column('cover'),
            StokeTranslationMapper::column('lang_id'),
            StokeTranslationMapper::column('web_page_id'),
            StokeTranslationMapper::column('name'),
            StokeTranslationMapper::column('title'),
            StokeTranslationMapper::column('introduction'),
            StokeTranslationMapper::column('description'),
            StokeTranslationMapper::column('keywords'),
            StokeTranslationMapper::column('meta_description'),
            WebPageMapper::column('slug')
        );
    }

    /**
     * Update settings
     * 
     * @param array $settings
     * @return boolean
     */
    public function updateSettings($settings)
    {
        return $this->updateColumns($settings, array('published', 'seo'));
    }

    /**
     * Fetch all records filtered by pagination
     * 
     * @param integer $page
     * @param integer $itemsPerPage
     * @param boolean $published Whether to fetch only published stokes
     * @return array
     */
    public function fetchAll($page, $itemsPerPage, $published)
    {
        $db = $this->createWebPageSelect($this->getColumns())
                    // Language ID filter
                    ->whereEquals(StokeTranslationMapper::column('lang_id'), $this->getLangId());

        if ($published === true) {
            $db->andWhereEquals(self::column('published'), '1')
               ->orderBy(self::column('end'))
               ->desc();
        } else {
            $db->orderBy(self::column('id'))
               ->desc();
        }

        if ($page !== null && $itemsPerPage !== null) {
            $db->paginate($page, $itemsPerPage);
        }

        return $db->queryAll();
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
