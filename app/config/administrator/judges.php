<?php
return array(

    'title' => 'Judges',

    'single' => 'judge',

    'model' => '\\TenJava\\Models\\Judge',

    /**
     * The display columns
     */
    'columns' => array(
        'id',
        'github_name' => array(
            'title' => 'GitHub Username',
        ),
        'github_id' => array(
            'title' => 'GitHub ID',
        ),
        'admin',
        'created_at',
        'updated_at',
    ),

    /**
     * The filter set
     */
    'filters' => array(
        'id',
        'github_name' => array(
            'title' => 'GitHub Username',
        ),
        'github_id' => array(
            'title' => 'GitHub ID',
        ),
        'admin'
    ),

    /**
     * The editable fields
     */
    'edit_fields' => array(
        'github_name' => array(
            'title' => 'GitHub Username',
        ),
        'github_id' => array(
            'title' => 'GitHub ID',
        ),
        'admin' => array(
            'title' => 'Admin',
            'type' => 'bool'
        )
    )
);

