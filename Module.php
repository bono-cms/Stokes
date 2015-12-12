<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) 2014 Bono Team
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Stokes;

use Bono\Application\Module\AbstractModule;
use Stokes\Service\StokeManager;

final class Module extends AbstractModule
{
	/**
	 * {@inheritDoc}
	 */ 
	public function getServiceProviders()
	{
		$admin = $this->moduleManager->getModule('Admin');
		
		$mapperFactory	 = $admin->getService('mapperFactory');
		$languageManager = $admin->getService('languageManager');
		
		$stokeMapper = $mapperFactory->build('/Stokes/Storage/MySQL/StokeMapper');
		$stokeMapper->setLangId($languageManager->getCurrentId());
		
		$stokeManager = new StokeManager($stokeMapper);
		
		return array(
			'stokeManager' => $stokeManager
		);
	}
}
