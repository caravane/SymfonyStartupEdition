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
 * Note: Not tested with ORM, MongoDB only (feedback welcome)


Update vendors
``` bash
    $ php composer.phar update
```
Edit config files:

- ODM only:
in app/config/config.yml
```
    doctrine_mongodb:
        connections:
            default:
                server: mongodb://127.0.0.1:27017 //or any
                options: {}
        default_database: xxxxxxxxxxxxxxxxxx
        document_managers:
            default:
                auto_mapping: true
```

- ORM 
in app/config/parameters.yml
```
    parameters:
        ...
        database_host: localhost // or any
        database_name: xxxxxxx
        database_user: xxxxxxx
        database_password: xxxxxxx
        ...
```


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
Warning: use CaravaneBootsrap version (as in composer.json, to allow app to get variables from the bundle resources folder)
- Edit file src/Caravane/NooneatBundle/resources/public/css/variables.less (or http://www.boottheme.com/#generatetheme ? )
- Clean up
``` bash
   php app/console assets:install
   php app/console assetic:dump
   php app/console cache:clear
```

Screenshot
========================
![ScreenShot](http://github.com/caravane/SymfonyStartupEdition/raw/master/web/images/screenshot.png)