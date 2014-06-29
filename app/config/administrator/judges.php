<?php
use TenJava\Authentication\AuthProviderInterface;

/** @var AuthProviderInterface $auth */
$auth = App::make("\\TenJava\\Authentication\\AuthProviderInterface");
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
        'admin' => array(
            'type' => 'bool'
        ),
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
    ),

    'action_permissions' => array(
        'delete' => function ($model) use ($auth) {
                return $auth->isAdmin();
            },
        'create' => function ($model) use ($auth) {
                return $auth->isAdmin();
            },
        'update' => function ($model) use ($auth) {
                return $auth->isAdmin();
            }
    ),
);

