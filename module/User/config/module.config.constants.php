<?php

return array(
    'ctv' => array (
        'administrator' => array (
            'tablecolumns' => array(
                'infoscript' => array(
                    'id'     => 'id',
                    'userId' => 'fk_user_id',
                    'urlId'  => 'fk_url_id',
                ),
                'url' => array(
                    'id'      => 'id',
                    'start'   => 'start',
                    'ende'    => 'ende',
                    'aktiv'   => 'aktiv',
                ),
//                'user' => array(
//
//                ),
            ),
        ),
    ),
);
