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

use Kernel\Storage\MySQL\AbstractMapper;
use Stokes\Storage\StokeMapperInterface;

final class StokeMapper extends AbstractMapper implements StokeMapperInterface
{
    /**
     * {@inheritDoc}
     */
    public static function getTableName()
    {
        return 'bono_module_stokes';
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
        $db = $this->db->select('*')
                        ->from(self::getTableName())
                        ->whereEquals('lang_id', $this->getlang_id());

        if ($published === true) {
            $db->andWhereEquals('published', '1');
        }

        return $db->paginate($page, $itemsPerPage)
                  ->queryAll();
    }

    /**
     * Fetch all published
     * 
     * @return array
     */
    public function fetchAllPublished()
    {
        return $this->db->select('*')
                        ->from(self::getTableName())
                        ->whereEquals('lang_id', $this->getlang_id())
                        ->andWhereEquals('published', '1')
                        ->queryAll();
    }

    /**
     * Fetches a record by its associated id
     * 
     * @param string $id
     * @return array
     */
    public function fetchById($id)
    {
        return $this->findByPk($id);
    }

    /**
     * Delete a record by its associated id
     * 
     * @param string $id
     * @return string
     */
    public function deleteById($id)
    {
        return $this->deleteByPk($id);
    }

    /**
     * Insert a record
     * 
     * @param array $input Raw input data
     * @return boolean
     */
    public function insert(array $input)
    {
        return $this->persist($this->getWithLang($input));
    }

    /**
     * Updates a record
     * 
     * @param array $input Raw input data
     * @return void
     */
    public function update(array $input)
    {
        return $this->persist($input);
    }
}
