Symfony Startup Edition
========================

A symfony ready to use empty app with
- jquery
- jquery-ui
- twitter bootstrap
- lessphp
- js routing (FOSJsRoutingBundle)
- user (FOSUserBundle)
- facebook login (FOSFacebookBundle https://github.com/FriendsOfSymfony/FOSFacebookBundle)
- google login (FOSGoogleBundle)
- twitter login (FOSTwitterBundle)



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
