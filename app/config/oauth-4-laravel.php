<?php
return array(

    /*
    |--------------------------------------------------------------------------
    | oAuth Config
    |--------------------------------------------------------------------------
    */

    /**
     * Storage
     */
    'storage' => 'Session',

    /**
     * Consumers
     */
    'consumers' => array(

        /**
         * GitHub
         */
        'GitHub' => array(
            'client_id'     => '',
            'client_secret' => '',
            'scope'         => array('user:email'),
        ),

    )

);