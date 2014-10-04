![We're awesome](http://img.shields.io/badge/Pull%20Requests%20Closed%20In-less%20than%20a%20minute-brightgreen.svg?style=flat)

ten.java website
================

ten.java 2014 official site!

Contributing
------------

Please make PRs to the `redesign` branch so we can test stuff in beta first :smile:.

In terms of actual code, you'll find most things you need in app/TenJava/.
I really don't care too much about our controllers being coupled too tightly to Laravel. It's unlikely Laravel is going
to disappear before the contest starts and this site will not have a lot of use while the contest is not running/about
to start.

Environment
-----------

You must define an environment config if you wish to run this application locally!
Store this as `.env.dev.php` in the root.

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
    "DATABASE_HOST" => "localhost",
    "DATABASE_SCHEMA" => "",
    "APP_ENCRYPTION_KEY" => "",
    "ENVIRONMENT_NAME" => "local",
    "FLAREBOT_URL" => "",
    "FLAREBOT_SECRET" => ""
);
````
