<?php
use TenJava\Authentication\AuthProviderInterface;

/** @var AuthProviderInterface $auth */
$auth = App::make("\\TenJava\\Authentication\\AuthProviderInterface");
return array(

    'title' => 'Participants',

    'single' => 'participant',

    /** @see  \TenJava\Models\Application */
    'model' => '\\TenJava\\Models\\Application',

    /**
     * The display columns
     */
    'columns' => array(
        'id',
        '$gh_username' => array(
            'title' => 'GitHub',
        ),
        'dbo_username' => array(
            'title' => 'BukkitDev',
        ),
        'twitch_username' => array(
            'title' => 'twitch.tv'
        ),
        'github_email' => array(
            'title' => 'Emails'
        ),
        'irc_username' => array(
            'title' => 'IRC Nick'
        ),
        'mc_username' => array(
            'title' => 'Minecraft'
        ),
        'gmail' => array(
            'title' => 'GMail'
        ),
        'judge' => array(
            'title' => 'Judge app?'
        ),
        'created_at',
        'updated_at',
    ),

    /**
     * The filter set
     */
    'filters' => array(
        'id',
        '$gh_username' => array(
            'title' => 'GitHub',
        ),
        'dbo_username' => array(
            'title' => 'BukkitDev',
        ),
        'twitch_username' => array(
            'title' => 'twitch.tv'
        ),
        'github_email' => array(
            'title' => 'Emails'
        ),
        'irc_username' => array(
            'title' => 'IRC Nick'
        ),
        'mc_username' => array(
            'title' => 'Minecraft'
        ),
        'gmail' => array(
            'title' => 'GMail'
        ),
        'judge' => array(
            'title' => 'Judge app?'
        ),
        'created_at',
        'updated_at',
    ),

    /**
     * The editable fields
     */
    'edit_fields' => array(
        '$gh_username' => array(
            'title' => 'GitHub',
        ),
        'dbo_username' => array(
            'title' => 'BukkitDev',
        ),
        'twitch_username' => array(
            'title' => 'twitch.tv'
        ),
        'github_email' => array(
            'title' => 'Emails'
        ),
        'irc_username' => array(
            'title' => 'IRC Nick'
        ),
        'mc_username' => array(
            'title' => 'Minecraft'
        ),
        'gmail' => array(
            'title' => 'GMail'
        ),
        'judge' => array(
            'title' => 'Judge app?',
            'type' => 'bool'
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
            },
        'view' => function ($model) use ($auth) {
                return $auth->isAdmin();
            }
    ),
);

