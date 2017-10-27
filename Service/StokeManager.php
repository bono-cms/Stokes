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
use Cms\Service\WebPageManagerInterface;
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
     * Web page manager to manage slugs
     * 
     * @var \Cms\Service\WebPageManagerInterface
     */
    private $webPageManager;

    /**
     * State initialization
     * 
     * @param \Stokes\Storage\StokeMapperInterface $stokeMapper
     * @param \Cms\Service\WebPageManagerInterface $webPageManager
     * @return void
     */
    public function __construct(StokeMapperInterface $stokeMapper, WebPageManagerInterface $webPageManager)
    {
        $this->stokeMapper = $stokeMapper;
        $this->webPageManager = $webPageManager;
    }

    /**
     * Returns a collection of switching URLs
     * 
     * @param string $id Stock ID
     * @return array
     */
    public function getSwitchUrls($id)
    {
        return $this->stokeMapper->createSwitchUrls($id, 'Stokes', 'Stokes:Stoke@indexAction');
    }

    /**
     * {@inheritDoc}
     */
    protected function toEntity(array $stoke)
    {
        $entity = new VirtualEntity();
        $entity->setId($stoke['id'], VirtualEntity::FILTER_INT)
               ->setLangId($stoke['lang_id'], VirtualEntity::FILTER_INT)
               ->setWebPageId($stoke['web_page_id'], VirtualEntity::FILTER_INT)
               ->setStart($stoke['start'], VirtualEntity::FILTER_INT)
               ->setEnd($stoke['end'], VirtualEntity::FILTER_INT)
               ->setName($stoke['name'], VirtualEntity::FILTER_HTML)
               ->setTitle($stoke['title'], VirtualEntity::FILTER_HTML)
               ->setPublished($stoke['published'], VirtualEntity::FILTER_BOOL)
               ->setSeo($stoke['seo'], VirtualEntity::FILTER_BOOL)
               ->setIntroduction($stoke['introduction'], VirtualEntity::FILTER_SAFE_TAGS)
               ->setDescription($stoke['description'], VirtualEntity::FILTER_SAFE_TAGS)
               ->setKeywords($stoke['keywords'], VirtualEntity::FILTER_HTML)
               ->setMetaDescription($stoke['meta_description'], VirtualEntity::FILTER_HTML)
               ->setCover($stoke['cover'], VirtualEntity::FILTER_HTML)
               ->setSlug($stoke['slug'], VirtualEntity::FILTER_TAGS)
               ->setUrl($this->webPageManager->surround($entity->getSlug(), $entity->getLangId()));

        return $entity;
    }

    /**
     * Update settings
     * 
     * @param array $settings
     * @return boolean
     */
    public function updateSettings($settings)
    {
        return $this->stokeMapper->updateSettings($settings);
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
     * Save a page
     * 
     * @param array $input
     * @return boolean
     */
    private function savePage(array $input)
    {
        $data = ArrayUtils::arrayWithout($input['stoke'], array('slug'));
        $translation = $input['translation'];

        return $this->stokeMapper->savePage('Stokes', 'Stokes:Stoke@indexAction', $data, $translation);
    }

    /**
     * Adds a stoke
     * 
     * @param array $input Raw input data
     * @return boolean
     */
    public function add(array $input)
    {
        return $this->savePage($input);
    }

    /**
     * Updates a stoke
     * 
     * @param array $input Raw input data
     * @return boolean
     */
    public function update(array $input)
    {
        return $this->savePage($input);
    }

    /**
     * Deletes a stoke by its associated id
     * 
     * @param string $id
     * @return boolean
     */
    public function deleteById($id)
    {
        return $this->stokeMapper->deletePage($id);
    }

    /**
     * Delete stokes by their associated ids
     * 
     * @param array $ids Collection of ids
     * @return boolean
     */
    public function deleteByIds(array $ids)
    {
        $this->stokeMapper->deletePage($ids);
        return true;
    }

    /**
     * Fetches stoke's entity by its associated id
     * 
     * @param string $id
     * @param boolean $withTranslations Whether to fetch translations
     * @return array
     */
    public function fetchById($id, $withTranslations)
    {
        if ($withTranslations === true) {
            return $this->prepareResults($this->stokeMapper->fetchById($id, true));
        } else {
            return $this->prepareResult($this->stokeMapper->fetchById($id, false));
        }
    }

    /**
     * Fetches all stoke entities filtered by pagination
     * 
     * @param integer $page
     * @param integer $itemsPerPage
     * @param boolean $published Whether to fetch only published ones
     * @return array
     */
    public function fetchAll($page, $itemsPerPage, $published)
    {
        return $this->prepareResults($this->stokeMapper->fetchAll($page, $itemsPerPage, $published));
    }
}
