<?php /* Template Name: Login  */ ?>

<?php if(is_user_logged_in()): ?>

    <script type="text/javascript">
        //alert('login');
        var expire = new Date();
        expire.setDate(expire.getDate() + 1000);
        cookies = "APP_LOGIN" + '=' + escape('true') + ';'
        cookies += ';expires=' + expire.toGMTString() + ';';
        document.cookie = cookies;

        window.appBridge.startMain();
        setInterval(function(){
            window.appBridge.startMain();
        },2000)
    </script>

    <?php else: ?>

    <script>
		window.appBridge.logout();
		window.appBridge.clearCookie();
		var expire = new Date();
		expire.setDate(expire.getDate() + 1000);
		cookies = "APP_LOGIN" + '=' + escape('false') + ';'
		cookies += ';expires=' + expire.toGMTString() + ';';
		document.cookie = cookies;
	</script>

<?php endif; ?>

<?php get_header();?>

<main class="user-page wrap login-page">
    <h1 class="logo"><a href="<?php create_url('')?>"><img src="<?php theme_path('/assets/images/opal-logo.png') ?>" alt="opal logo"></a></h1>
    <section class="form-section">
        <form id="form-login" class="opal-forms">
            <div class="field email-field email">
                <label>
                    <input class="input-form require" name="email" type="email" placeholder="<?php _e('Email', 'opalbeauty')?>">
                </label>
                <!-- <p class="mess"></p> -->
            </div>
            <div class="field password-field password">
                <label>
                    <input class="input-form require" name="password" type="password" placeholder="<?php _e('Password', 'opalbeauty')?>">
                    <span class="show-pass"><img src="<?php theme_path('/assets/images/eye-icon.svg') ?>"
                            alt="eye icon"></span>
                </label>
                <!-- <p class="mess"></p> -->
            </div>
            <p class="forgot-password"><a href="<?php create_url('forgot-password')?>"><?php _e('Forgot password', 'opalbeauty')?></a></p>
            <button id="submit-login" type="button" class="btn-style full main-color"><?php _e('Login', 'opalbeauty')?></button>
        </form>
        <p><?php _e("Don't have an account.", 'opalbeauty')?> <a href="<?php create_url('register')?>"><?php _e('Sign up', 'opalbeauty')?></a></p>
    </section>
    <section class="social-btn-section">
        <p><?php _e("Or log in with social media", 'opalbeauty')?></p>
        <input type="hidden" name="web_token" value="<?php echo wp_create_nonce(opalbeauty_NONCE_KEY.'applogin')?>">
        <a class="btn-style full red login-social" data-type="G" href="#"><img
                src="<?php theme_path('/assets/images/google-icon.svg') ?>" alt="eye icon"> Google</a>
        <a class="btn-style full dark-blue login-social" data-type="F"  href="#"><img
                src="<?php theme_path('/assets/images/facebook-icon.svg') ?>" alt="eye icon"> Facebook</a>
        <a class="btn-style full blue login-social" data-type="Z"  href="#"><img
                src="<?php theme_path('/assets/images/zalo-icon.svg') ?>" alt="eye icon"> Zalo</a>
    </section>
    <p class="p-url-doctor"><?php _e("Are you doctor? Sign up as doctor", 'opalbeauty')?> <a href="<?php create_url('register?u=doctor')?>"><?php _e("here", 'opalbeauty')?></a></p>
</main>

<?php
    get_template_part(
        'template-parts/overlay',
        'welcome'
    );
?>
<?php get_footer();?>
<script type="text/javascript" src="<?php theme_path('/assets/js/validator.min.js')?>"></script>
<script type='text/javascript' src="<?php theme_path('/assets/js/validate.js')?>"></script>
<script>
    function callbackLoginFail(message) {
        alert('callbackLoginFail');
        alert(message);
        jQuery('.login-social').removeClass('loading-btn');
        jQuery('.login-social').prop('disabled', false);
    }

    function callbackLoginSuccess(type, token, information) {
        //alert('callbackLoginSuccess');
        jQuery.ajax({
            type: "POST",
            url: '<?php echo admin_url('admin-ajax.php');?>',
            data: {
                action: 'app_social_login',
                type: type,
                token: token,
                web_token: jQuery('input[name=web_token]').val()
            }
        })
        .done(function(response, textStatus, request) {
            if(response == "success"){
                var id = request.getResponseHeader('user_id')
                if ( window.appBridge &&  window.appBridge.setUserToken && id){
                    window.appBridge.setUserToken(id)
                }
                window.appBridge.startMain();
                location.href = "/";
            }else if(response == "next"){
                location.href = "<?php create_url('register2')?>";
            }

            return;

            // if(response == "success"){
            //     var id = request.getResponseHeader('user_id')
            //     if ( window.appBridge &&  window.appBridge.setUserToken && id){
            //         window.appBridge.setUserToken(id)
            //     }
            //     window.appBridge.startMain();
            //     location.href = "/";
            // }

            // return;
            // if (response.success) {
            //     if (response.data.login_success) {
            //         if(window.appBridge){
            //             window.appBridge.startMain();
            //         }
            //         window.location = response.data.url;
            //     } else {
            //         // const err = response.data.data.errors[Object.keys(response.data.data
            //         //     .errors)][0]
            //         const fielde =  jQuery(`.field.password .mess`);
            //         fielde.addClass('active');
            //         fielde.text(response.data.messenger);
            //     }
            // }
        })
        .fail(function(jqXHR, textStatus) {
            alert('ERROR');
        })
        .always(function() {
            jQuery('.login-social').removeClass('loading-btn');
            jQuery('.login-social').prop('disabled', false);
            
        })
    }
jQuery(document).ready(function() {
    jQuery('#forgotPasswordBTN').click(function() {
        jQuery('#form-password-reset').submit()
    })

    jQuery(".show-pass").click(function() {
        var input = jQuery(this).parent().find('input');
        if(input.attr('type') == 'password'){
            input.attr('type', 'text');
            return;
        }
        
        input.attr('type', 'password');
    });

    function socialLogin(type) {
       
        jQuery('.login-social').addClass('loading-btn');
        jQuery('.login-social').prop('disabled', true);
        try {
            window.appBridge.socialLogin(type);
        } catch {
            jQuery('.login-social').removeClass('loading-btn');
            jQuery('.login-social').prop('disabled', false);
        }

    }
    jQuery(".login-social").click(function(e) {
        e.preventDefault();
        jQuery(this).addClass('loading-btn');
        jQuery(this).prop('disabled', true);
        
        try {
            
            //var checkLogin = window.appBridge.socialLogin(jQuery(this).data('type'));
            //alert('socialLogin', checkLogin);
            let type = jQuery(this).data('type');
            window.appBridge.socialLogin(type);
        } catch {
            jQuery(this).removeClass('loading-btn');
            jQuery(this).prop('disabled', false);
        }

    });

 

    // jQuery(".login-social").click(function(e) {
    //     e.preventDefault()
    //     var type = jQuery(this).data('type');
        
    //     jQuery(this).addClass('loading-btn');
    //     jQuery(this).prop('disabled', true);
        
    //     var btn_submit = jQuery('login-social');
    //     jQuery.ajax({
    //         type: "POST",
    //         url: '<?php echo admin_url('admin-ajax.php');?>',
    //         data: {
    //             action: 'app_social_login'
    //         }
    //     })
    //     .done(function(response) {
    //         if (response.success) {
    //             if (response.data.login_success) {
    //                 if(window.appBridge){
    //                     window.appBridge.startMain();
    //                 }
    //                 window.location = response.data.url;
    //             } else {
    //                 // const err = response.data.data.errors[Object.keys(response.data.data
    //                 //     .errors)][0]
    //                 const fielde =  jQuery(`.field.password .mess`);
    //                 fielde.addClass('active');
    //                 fielde.text(response.data.messenger);
    //             }
    //         }
    //     })
    //     .fail(function(jqXHR, textStatus) {
    //         alert('ERROR');
    //     })
    //     .always(function() {
    //         btn_submit.removeClass('loading-btn');
    //         btn_submit.prop('disabled', false);
    //     })
    // });
   
    jQuery("#submit-login").click(function() {
        const form = jQuery("#form-login");
        const arrRequire = [];
        const dataInput = {};

        jQuery.each(form.serializeArray(), function(index, obj) {
            dataInput[obj.name] = obj.value;
        });

        const validation = {
            'email': {
                type: ['required', 'email']
            },
            'password': {
                name: 'Password',
                type: ['required', 'password']
            },
        }

        const errors = reqValidator(validation, dataInput);

        jQuery(`.opal-forms .mess`).removeClass('active');
        if (Object.keys(errors)[0]) {
            for (const keye in errors) {
                const fielde =  jQuery(`.field.${keye} .mess`);
                fielde.addClass('active');
                fielde.text(errors[keye]);
            }
            jQuery(this).removeClass('loading-btn');
            jQuery(this).prop('disabled', false);
            return;
        }
        
        jQuery(this).addClass('loading-btn');
        jQuery(this).prop('disabled', true);
        
        var btn_submit = jQuery(this);
        jQuery.ajax({
            type: "POST",
            url: '<?php echo admin_url('admin-ajax.php');?>',
            data: {
                action: 'submitLoginUser',
                input: dataInput
            }
        })
        .done(function(response) {
            console.log(response);
            if (response == 'success') {
                window.appBridge.startMain();
                location.href = "/";
            }
            return;

            if (response.success) {
                if (response.data.login_success) {
                    console.log(22, window.appBridge);
                    if(window.appBridge){
                        window.appBridge.startMain();
                    }
                    if (getQueryParams('redirect_to') === null) {
                        window.location = "<?php echo get_home_url() ?>/";
                    } else {
                        window.location = "<?php echo get_home_url() ?>/" +
                            getQueryParams('redirect_to');
                    }
                } else {
                    // const err = response.data.data.errors[Object.keys(response.data.data
                    //     .errors)][0]
                    const fielde =  jQuery(`.field.password .mess`);
                    fielde.addClass('active');
                    fielde.text('Vui lòng kiểm tra lại thông tin đăng nhập');
                }
            }
        })
        .fail(function(jqXHR, textStatus) {
            alert('ERROR');
        })
        .always(function() {
            btn_submit.removeClass('loading-btn');
            btn_submit.prop('disabled', false);
        })
    });
});
</script>