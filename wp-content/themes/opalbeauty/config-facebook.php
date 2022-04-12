<?php

function facebookLoginUrl(){
   
    require_once('Facebook/autoload.php' );
    require_once( 'fb-connect.php' );
    
    $helper = $fb->getRedirectLoginHelper();
    if (isset($_GET['state'])) {
        $helper->getPersistentDataHandler()->set('state', $_GET['state']);
    }
    
    $permissions = ['email'];
    
    $loginUrl = $helper->getLoginUrl(
        get_template_directory_uri().'/fb-callback.php',
    // get_home_url(),
    $permissions);
    return $loginUrl;
}
