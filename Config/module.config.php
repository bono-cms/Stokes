<?php

/**
 * Module configuration container
 */

return array(
    'name'  => 'Stokes',
    'description' => 'Stoke module allows you to add random stuff that has data of expiration',
    'menu' => array(
        'name' => 'Stokes',
        'icon' => 'far fa-money-bill-alt',
        'items' => array(
            array(
                'route' => 'Stokes:Admin:Stoke@gridAction',
                'name' => 'View all stokes'
            )
        )
    )
);