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
        'controller' => 'Admin:Browser@indexAction'
    ),
    
    '/admin/module/stokes/add' => array(
        'controller' => 'Admin:Add@indexAction'
    ),
    
    '/admin/module/stokes/add.ajax' => array(
        'controller' => 'Admin:Add@addAction'
    ),
    
    '/admin/module/stokes/edit/(:var)' => array(
        'controller' => 'Admin:Edit@indexAction'
    ),
    
    '/admin/module/stokes/edit.ajax' => array(
        'controller' => 'Admin:Edit@updateAction'
    ),
    
    '/admin/module/stokes/delete.ajax' => array(
        'controller' => 'Admin:Browser@deleteAction'
    ),
    
    '/admin/module/stokes/delete-selected.ajax' => array(
        'controller' => 'Admin:Browser@deleteSelectedAction'
    )
);
