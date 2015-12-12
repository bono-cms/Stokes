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
                        ->whereEquals('langId', $this->getLangId());

        if ($published === true) {
            $db->andWhereEquals('published', '1');
        }

        return $db->paginate($page, $itemsPerPage)
                  ->queryAll();
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
            self::getTableName(), 
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
        $query = sprintf('SELECT * FROM `%s` WHERE `langId` = :langId AND `published` = :published', self::getTableName());
        
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
        $query = sprintf('SELECT * FROM `%s` WHERE `id` =:id', self::getTableName());
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
        return $this->db->delete(self::getTableName(), array(
            'id' => $id
        ));
    }
    
    /**
     * Inserta a record
     * 
     * @param array $container
     * @return boolean
     */
    public function insert(array $container)
    {
        return $this->db->insert(self::getTableName(), array(
            
        ));
    }

    /**
     * Updates a record
     * 
     * @param array $container
     * @return void
     */
    public function update(array $container)
    {
        return $this->db->update(self::getTableName(), array(
            
            
        ), array('id' => $container->id));
    }
}
