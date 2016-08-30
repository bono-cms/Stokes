<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

return array(
    '/%s/module/stokes' => array(
        'controller' => 'Admin:Stoke@gridAction'
    ),
    
    '/%s/module/stokes/page/(:var)' => array(
        'controller' => 'Admin:Stoke@gridAction'
    ),
    
    '/%s/module/stokes/add' => array(
        'controller' => 'Admin:Stoke@addAction'
    ),
    
    '/%s/module/stokes/edit/(:var)' => array(
        'controller' => 'Admin:Stoke@editAction'
    ),
    
    '/%s/module/stokes/save' => array(
        'controller' => 'Admin:Stoke@saveAction'
    ),
    
    '/%s/module/stokes/tweak' => array(
        'controller' => 'Admin:Stoke@tweakAction'
    ),
    
    '/%s/module/stokes/delete' => array(
        'controller' => 'Admin:Stoke@deleteAction'
    )
);