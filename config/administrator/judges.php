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
        'web_team' => array(
            'type' => 'bool'
        ),
        'enabled' => array(
            'type' => 'bool'
        ),
        'show_on_judge_page' => array(
            'type' => 'bool',
            'title' => 'Show on stats'
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
        'admin',
        'enabled'
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
        'web_team' => array(
            'title' => 'Is web team?',
            'type' => 'bool'
        ),
        'admin' => array(
            'title' => 'Is organizer?',
            'type' => 'bool'
        ),
        'enabled' => array(
            'type' => 'bool'
        ),
        'show_on_judge_page' => array(
            'type' => 'bool',
            'title' => 'Show on stats'
        ),
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

