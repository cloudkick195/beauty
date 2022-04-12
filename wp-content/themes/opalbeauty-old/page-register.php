<?php /* Template Name: Sign Up  */ ?>
<?php get_header();?>
<?php header_page('');?>
<main class="user-page wrap login-page">
    <h1 class="main-title text-center">Sign up</h1>
    <section class="form-section">
        <form id="form-register" class="opal-forms">
            <?php if(get_query_var( 'u' )):?>
            <input type="hidden" name="u" value="doctor">
            <?php endif;?>
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
            <div class="field password-field confirm_password">
                <label>
                    <input class="input-form require" name="confirm_password" type="password"
                        placeholder="<?php _e('Comfirm Password', 'opalbeauty')?>">
                    <span class="show-pass"><img src="<?php theme_path('/assets/images/eye-icon.svg') ?>"
                            alt="eye icon"></span>
                </label>
                <!-- <p class="mess"></p> -->
            </div>
            <button id="submit-register" type="button" class="btn-style full main-color"><?php _e('Sign up', 'opalbeauty')?></button>
        </form>
    </section>
</main>
<?php get_footer();?>
<script type="text/javascript" src="<?php theme_path('/assets/js/validator.min.js')?>"></script>
<script type='text/javascript' src="<?php theme_path('/assets/js/validate.js')?>"></script>
<script>
jQuery(document).ready(function() {

    jQuery(".show-pass").click(function() {
        var input = jQuery(this).parent().find('input');
        if (input.attr('type') == 'password') {
            input.attr('type', 'text');
            return;
        }

        input.attr('type', 'password');
    });
    jQuery("#submit-register").click(function() {
        const form = jQuery("#form-register");
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
            'confirm_password': {
                name: 'Confirm password',
                type: ['required', 'password']
            },
        }

        const errors = reqValidator(validation, dataInput);



        jQuery(`.opal-forms .mess`).removeClass('active');

        if (Object.keys(errors)[0]) {
            for (const keye in errors) {
                const fielde = jQuery(`.field.${keye} .mess`);
                fielde.addClass('active');
                fielde.text(errors[keye]);
            }
            jQuery(this).removeClass('loading-btn');
            jQuery(this).prop('disabled', false);
            return;
        }

        const last_field = jQuery(`.field.confirm_password .mess`);
        // if(dataInput['password'] !== dataInput['confirm_password']){
        //     last_field.addClass('active');
        //     last_field.text('Wrong password re-entered');
        //     return;    
        // }

        jQuery(this).addClass('loading-btn');
        jQuery(this).prop('disabled', true);
         
        var btn_submit = jQuery(this);
        jQuery.ajax({
                type: "POST",
                url: '<?php echo admin_url('admin-ajax.php');?>',
                data: {
                    action: 'checkExistsUser',
                    input: dataInput
                }
            })
            .done(function(response) {
                if (!response.data || !response.data.success) {
                    last_field.addClass('active');
                    last_field.text(response.data.message);
                    return
                }
                localStorage.setItem('userRegistrationDraft', JSON.stringify(dataInput))
                window.location = "<?php echo get_home_url() ?>/register2";

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