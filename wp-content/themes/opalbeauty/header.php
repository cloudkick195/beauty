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
<?php $user_id = get_current_user_id()?>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <!-- <meta name="viewport" content="width=device-width,initial-scale=1"> -->
    <meta name="viewport" 
      content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700&display=swap" rel="stylesheet">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

    <?php wp_head();?>
</head>
<body <?php body_class(); ?>>
<header>
    <div class="wrap header-home">
        <h1 class="logo"><a href="<?php create_url('')?>"><img src="<?php theme_path('/assets/images/opal-logo.png') ?>" alt="opal logo"></a></h1>
        <?php if(is_page_template( 'page-home.php' )):?>
        <a href="<?php create_url('notification')?>">
            <img class="bell-icon" src="<?php theme_path('/assets/images/bell-icon.svg') ?>" alt="opal bell icon">
            <?php $notification_val = get_field('user_notification', 'user_'.$user_id);?>
            <?php if($notification_val == true):?>
            <span class="number-notification"><?php echo count_unread_notification();?></span>
            <?php endif?>
        </a>
        <?php endif?>
    </div>
</header>
<script>
    // function GoBackWithRefresh(e) {
       
    //     var pathName = window.location.pathname
    //     if(pathName){
    //         var checkPath= pathName.split("/setting/");
           
    //         if(checkPath.length > 1){
    //             var checkPath= pathName.split("vi");
    //             if(checkPath.length > 1){
    //                 window.location = window.location.protocol + '//' + window.location.hostname + checkPath[0];
    //             }

    //             window.location.href = "<?php create_url('')?>";
    //         }
    //     }
       
    //     window.history.go(-1);
        
    // }
   
    function setCookie(cname,cvalue,exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires=" + d.toGMTString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }
      
    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i < ca.length; i++) {
          var c = ca[i];
          while (c.charAt(0) == ' ') {
            c = c.substring(1);
          }
          if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
          }
        }
        return "";
    }
    function goBackPage() {
        var cookiePage = getCookie('pages_history');
        var arrPage = cookiePage.split(",");

        var urlHome = "<?php create_url('')?>";
        if(arrPage && '/'+arrPage[0]+'/' == location.pathname){
            window.location.href = urlHome;
        }else if(arrPage && arrPage.length > 1){
            var slugBack = arrPage.reverse()[1]; 
            setCookie('pages_history', arrPage.pop().toString(),1);

            window.location.href = urlHome + slugBack;
        }else{
            setCookie('pages_history', '',-1);
            window.location.href = urlHome;
        }
    }
   
</script>