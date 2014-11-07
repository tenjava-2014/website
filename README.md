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
Store this as `.env` in the root and fill in the details.

````php
GITHUB_PASSWORD=
MAIL_SMTP_USERNAME=
MAIL_SMTP_PASSWORD=
MAIL_PRETEND=
OAUTH_CLIENT_ID=
OAUTH_CLIENT_SECRET=
BEANSTALK_QUEUE=
TWITTER_KEY=
TWITTER_SECRET=
TWITTER_ACCESS_TOKEN=
TWITTER_ACCESS_SECRET=
DATABASE_HOST=
DATABASE_USERNAME=
DATABASE_PASSWORD=
DATABASE_SCHEMA=
APP_ENCRYPTION_KEY=
ENVIRONMENT_NAME=
USER_VERIFICATION_KEY=
STRIPE_KEY=
APP_ENV=
````
