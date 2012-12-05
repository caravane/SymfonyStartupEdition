
function fb_login(){
    FB.login(function(response) {

        if (response.authResponse) {
            console.log('Welcome!  Fetching your information.... ');
            //console.log(response); // dump complete info
            access_token = response.authResponse.accessToken; //get access token
            user_id = response.authResponse.userID; //get FB UID

            FB.api('/me', function(response) {
                user_email = response.email; //get user email
          // you can store this data into your database
            });

        } else {
            //user hit cancel button
            console.log('User cancelled login or did not fully authorize.');

        }
    }, {
        scope: 'read_stream,email,user_photos'
    });
}
/*
(function() {
    var e = document.createElement('script');
    e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
    e.async = true;
    //document.getElementById('fb-root').appendChild(e);
}());
*/

 function goLogIn(){

                window.location = Routing.generate('fos_login_fb_check');
            }

            function onFbInit() {
                if (typeof(FB) != 'undefined' && FB != null ) {
                    FB.Event.subscribe('auth.statusChange', function(response) {
                        if (response.session || response.authResponse) {
                            setTimeout(goLogIn, 500);
                        } else {
                            window.location = Routing.generate('fos_logout');
                        }
                    });
                }
            }
