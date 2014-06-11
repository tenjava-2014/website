ten.java website
================

ten.java 2014 official site!

Contributing
------------

Please make PRs to the `redesign` branch so we can test stuff in beta first :smile:.

Environment
-----------

You must define an environment config if you wish to run this application locally!

````php
<?php
return array(
    "GITHUB_PASSWORD" => "",
    "MAIL_SMTP_USERNAME" => "",
    "MAIL_SMTP_PASSWORD" => "",
    "MAIL_PRETEND" => true,
    "OAUTH_CLIENT_ID" => "",
    "OAUTH_CLIENT_SECRET" => "",
    "BEANSTALK_QUEUE" => "",
    "TWITTER_KEY" => "",
    "TWITTER_SECRET" => "",
    "TWITTER_ACCESS_TOKEN" => "",
    "TWITTER_ACCESS_SECRET" => "",
    "DATABASE_USERNAME" => "",
    "DATABASE_PASSWORD" => "",
    "DATABASE_SCHEMA" => "",
    "APP_ENCRYPTION_KEY" => "",
    "ENVIRONMENT_NAME" => "local"
);
````