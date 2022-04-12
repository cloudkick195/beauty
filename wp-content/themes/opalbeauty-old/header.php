<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="ltr" lang="vi" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="ltr" lang="vi" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<?php if(is_user_logged_in()): ?>
    <?php if (is_front_page()): ?>
        <script>
        window.appBridge.startMain(); 
        setInterval(function(){
            window.appBridge.startMain();
        },2000)
        </script>
    <?php endif; ?>
<?php endif; ?>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700&display=swap" rel="stylesheet">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <link rel="shortcut icon" type="image/gif" href="/favicon.gif" />

    <?php wp_head();?>
</head>
<body <?php body_class(); ?>>
<header>
    <div class="wrap header-home">
        <h1 class="logo"><a href="<?php create_url('')?>"><img src="<?php theme_path('/assets/images/opal-logo.png') ?>" alt="opal logo"></a></h1>
        <a href="<?php create_url('notification')?>"><img class="bell-icon" src="<?php theme_path('/assets/images/bell-icon.svg') ?>" alt="opal bell icon"></a>
    </div>
</header>
<script>
    function GoBackWithRefresh(e) {
       
        var pathName = window.location.pathname
        if(pathName){
            var checkPath= pathName.split("/setting/");
           
            if(checkPath.length > 1){

                window.location = window.location.protocol + '//' + window.location.hostname + checkPath[0];
            }
        }
       
        window.history.go(-1);
        
    }
</script>