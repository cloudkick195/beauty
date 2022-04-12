<?php /* Template Name: Change Password  */ ?>
<?php get_header();?>
<?php header_page(get_the_title());?>
<main class="user-page wrap change-password-page">
    <section class="form-section">
    <form id="form-update-password" class="opal-forms opal-forms-password">
        <div class="field password-field current_password">
                <label>
                    <input class="input-form require" name="current_password" type="password" >
                    <p><?php _e('Current Password', 'opalbeauty')?></p>
                    <span class="show-pass"><img src="<?php theme_path('/assets/images/eye-icon.svg') ?>"
                            alt="eye icon"></span>
                </label>
                <!-- <p class="mess"></p> -->
            </div>
            <div class="field password-field password">
                <label>
                   
                    <input class="input-form require" name="password" type="password" >
                    <p><?php _e('New Password', 'opalbeauty')?></p>
                    <span class="show-pass"><img src="<?php theme_path('/assets/images/eye-icon.svg') ?>"
                            alt="eye icon"></span>
                </label>
                <!-- <p class="mess"></p> -->
            </div>
            <div class="field password-field confirm_password">
                <label>
                    
                    <input class="input-form require" name="confirm_password" type="password">
                    <p><?php _e('Confirm password', 'opalbeauty')?></p>
                    <span class="show-pass"><img src="<?php theme_path('/assets/images/eye-icon.svg') ?>"
                            alt="eye icon"></span>
                </label>
                <p class="mess"></p>
            </div>
            <button id="update-password" type="button" class="btn-style full main-color fixed-action-btn"><?php _e('Save', 'opalbeauty')?></button>
        </form>
    </section>
</main>
<?php get_footer();?>
<script type="text/javascript" src="<?php theme_path('/assets/js/validator.min.js')?>"></script>
<script type='text/javascript' src="<?php theme_path('/assets/js/validate.js')?>"></script>
<script>
function handlingForm(form){
    const arrRequire = [];
        const dataInput = {};
       
        jQuery.each(form.serializeArray(), function(index, obj) {
            dataInput[obj.name] = obj.value;
        });
       
        const validation = getValidation();
        
        const errors = reqValidator(validation, dataInput);

        jQuery(`.opal-forms .mess`).removeClass('active');
       
        const btn = form.find('button');
        
        btn.prop('disabled', true);
        btn.removeClass('active');
        if (Object.keys(errors)[0]) {
            for (const keye in errors) {
                // const fielde = jQuery(`.field.${keye} .mess`);
                // fielde.addClass('active');
                // fielde.text(errors[keye]);
            }
            btn.removeClass('loading-btn');
            return;
        }
        if(dataInput['password'] !== dataInput['confirm_password']){
            return;    
        }
       
        btn.addClass('active');
        btn.prop('disabled', false);
       
        return dataInput;
}
function getValidation() {
    return {
            'current_password': {
                type: ['required', 'password']
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
}
jQuery(document).ready(function() {
    jQuery(".opal-forms-password input").focus(function() {
        jQuery(this).parent().addClass('active');
    });
    jQuery(".opal-forms-password input").focusout(function() {
        if(!jQuery(this).val()){
            jQuery(this).parent().removeClass('active');
        }
        
    });
    jQuery(".show-pass").click(function() {
        var input = jQuery(this).parent().find('input');
        if (input.attr('type') == 'password') {
            input.attr('type', 'text');
            return;
        }

        input.attr('type', 'password');
    });

    jQuery('body').on('change', '#form-update-password', function() {

        const form = jQuery(this);
        const dataInput = handlingForm(form);

        if(!dataInput){
            return;
        }

        

    });
    jQuery("#update-password").click(function() {
        const form = jQuery("#form-update-password");
        
        const dataInput = handlingForm(form);

        if(!dataInput){
            return;
        }

        jQuery(this).addClass('loading-btn');
        jQuery(this).prop('disabled', true);
        const last_field = jQuery(`.field.confirm_password .mess`);

        var btn_submit = jQuery(this);
        jQuery.ajax({
            type: "POST",
            url: '<?php echo admin_url('admin-ajax.php');?>',
            data: {
                action: 'updatePassword',
                input: dataInput
            }
        })
        .done(function(response) {
            if (!response.data || !response.data.success) {
                last_field.addClass('active');
                last_field.text(response.data.message);
                return
            }
            window.location = "<?php echo get_home_url() ?>/change-password?appt=X";

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