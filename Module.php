<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) No Global State Lab
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
        $stokeMapper = $this->getMapper('/Stokes/Storage/MySQL/StokeMapper');
        $stokeManager = new StokeManager($stokeMapper);

        return array(
            'stokeManager' => $stokeManager
        );
    }
}
