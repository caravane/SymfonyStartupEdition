Symfony Startup Edition
========================

A symfony ready to use empty app with
- jquery (http://jquery.com)
- jquery-ui (http://jquery-ui.com)
- twitter bootstrap (http://twitter.github.com/bootstrap/)
- lessphp (https://github.com/leafo/lessphp)
- js routing (FOSJsRoutingBundle https://github.com/FriendsOfSymfony/FOSJSRoutingBundle)
- user (FOSUserBundle https://github.com/FriendsOfSymfony/FOSFUserBundle)
- facebook login (FOSFacebookBundle https://github.com/FriendsOfSymfony/FOSFacebookBundle)
- google login (FOSGoogleBundle https://https://github.com/bitgandtter/FOSGoogleBundle)
- twitter login (FOSTwitterBundle https://github.com/FriendsOfSymfony/FOSTwitterBundle)
- and some more...


Prerequisites
========================
This version requires Symfony 2.1

Installation
========================
 * Note: MongoDB only configuration by now, but easy to port to ORM *


Update vendors
``` bash
$ php composer.phar update
```
Edit config files:
- app/config/parameters.facebook.ini
```
[parameters]
    facebookAppID =     "xxxxxxx"
    facebookAppSecret=  "xxxxxxx"
    facebookAppUrl=     "http://apps.facebook.com/example/"
    facebookServerUrl=  "http://example.com"
    facebookLocale=    "en_US"
```

- app/config/parameters.twitter.ini
```
[parameters]
    twitterConsumer_key="xxxxxx"
    twitterConsumer_secret="xxxxxx"
    twitterCallback_url="http://example.com/app_dev.php/login_twitter_check"
```
- app/config/parameters.google.ini
```
[parameters]
    googleApp_name="example"
    googleClient_id="xxxxxxx.apps.googleusercontent.com"
    googleClient_secret="xxxxx-xxxxxxxx"
    googleCallback_url="http://example.com/app_dev.php/login_google_check"
```


Generate User Document
``` bash
php app/console doctrine:mongodb:generate:documents CaravaneUserBundle
```

Create MongoDB schema
``` bash
php app/console doctrine:mongodb:schema:create
```



Customize TwitterBootstrap
========================
- Edit file src/Caravane/NooneatBundle/resources/public/css/variables.less
- dump assets, clear cache



![ScreenShot](https://github.com/caravane/SymfonyStartupEdition/blob/master/web/images/screenshot.png)