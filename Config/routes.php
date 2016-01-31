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
    '/admin/module/stokes' => array(
        'controller' => 'Admin:Stoke@gridAction'
    ),
    
    '/admin/module/stokes/page/(:var)' => array(
        'controller' => 'Admin:Stoke@gridAction'
    ),
    
    '/admin/module/stokes/add' => array(
        'controller' => 'Admin:Stoke@addAction'
    ),
    
    '/admin/module/stokes/edit/(:var)' => array(
        'controller' => 'Admin:Stoke@editAction'
    ),
    
    '/admin/module/stokes/save' => array(
        'controller' => 'Admin:Stoke@saveAction'
    ),
    
    '/admin/module/stokes/delete' => array(
        'controller' => 'Admin:Stoke@deleteAction'
    )
);