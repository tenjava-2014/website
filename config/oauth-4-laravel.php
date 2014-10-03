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
            'client_id'     => $_ENV['OAUTH_CLIENT_ID'],
            'client_secret' => $_ENV['OAUTH_CLIENT_SECRET'],
            'scope'         => array('user:email'),
        ),

    )

);