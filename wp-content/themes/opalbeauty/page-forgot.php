<?php /* Template Name: Forgot Password Page  */ ?>
<?php get_header();?>


<main id="forgot-page" class="user-page wrap forgot-pass-page step1">
<a href="<?php create_url('login')?>"class="forgot-back">
    <img src="<?php theme_path('/assets/images/arrow-left.svg')?>">
</a>  
<section class="form-section">
    <form id="forgot-password" class="opal-forms active">
        <div class="img-bg-circle">
            <img src="<?php theme_path('/assets/images/lock-password.svg') ?>" alt="opal logo">
        </div>
        <h3 class="title"><?php _e('Forgot password', 'opalbeauty');?></h3>
        <p><?php _e('Please enter your email address to receive a Verification Code', 'opalbeauty');?></p>
        <div class="field email-field email">
            <label>
                <input class="input-form require" name="email" type="email" placeholder="<?php _e('Email', 'opalbeauty')?>">
            </label>
            <!-- <p class="mess"></p> -->
        </div>
        <div class="error-notifi"></div>
        <div class="fixed-btn"><button><?php _e('Send', 'opalbeauty');?></button></div>
    </form>
    <form id="verify-email" class="opal-forms">
        <input type="hidden" name="email" class="set-email" value="">
        <div class="img-bg-circle">
            <img src="<?php theme_path('/assets/images/mail-send.svg') ?>" alt="opal logo">
        </div>
        <h3 class="title"><?php _e('Verify your Email', 'opalbeauty');?></h3>
        <p><?php _e('Please enter the 4 digit code sent to', 'opalbeauty');?> <span class="text-email"></span></p>
        <div class="field number-paging-field number-paging">
            <label>
                <input id="number-paging1" name="number-paging1" type="number" maxlength="1" />
                <input id="number-paging2" name="number-paging2" type="number" maxlength="1" />
                <input id="number-paging3" name="number-paging3" type="number" maxlength="1" />
                <input id="number-paging4" name="number-paging4" type="number" maxlength="1" />
            </label>
            <!-- <p class="mess"></p> -->
        </div>
        <div class="error-notifi"></div>
        <div class="center-btn"><a href="#" class="button-resend"><?php _e('Resend code', 'opalbeauty');?></a></div>
        <div class="fixed-btn"><button><?php _e('Verify', 'opalbeauty');?></button></div>
    </form>
    <form id="create-password" class="opal-forms">
        <input type="hidden" name="email" class="set-email" value="">
        <input type="hidden" name="code" class="set-code"  value="">
        <div class="img-bg-circle">
            <img src="<?php theme_path('/assets/images/unlock-password.svg') ?>" alt="opal logo">
        </div>
        <h3 class="title"><?php _e('Create new password', 'opalbeauty');?></h3>
        <p><?php _e('Your new password must be different from previously used password.', 'opalbeauty');?></p>
        <div class="field password-field password">
            <label>
                <input class="input-form require" name="password" type="password" placeholder="<?php _e('New Password', 'opalbeauty')?>">
                <span class="show-pass"><img src="<?php theme_path('/assets/images/eye-icon.svg') ?>"
                        alt="eye icon"></span>
            </label>
            <!-- <p class="mess"></p> -->
        </div>
        <div class="field password-field confirm_password">
            <label>
                <input class="input-form require" name="confirm_password" type="password"
                    placeholder="<?php _e('Comfirm New Password', 'opalbeauty')?>">
                <span class="show-pass"><img src="<?php theme_path('/assets/images/eye-icon.svg') ?>"
                        alt="eye icon"></span>
            </label>
            <!-- <p class="mess"></p> -->
        </div>
        <div class="error-notifi"></div>
        <div class="fixed-btn"><button><?php _e('Save', 'opalbeauty');?></button></div>
    </form>
</section>
</main>
<?php get_footer();?>
<script type="text/javascript" src="<?php theme_path('/assets/js/validator.min.js')?>"></script>
<script type='text/javascript' src="<?php theme_path('/assets/js/validate.js')?>"></script>
<script>
 function handlingForm(form, validationStr) {
        const arrRequire = [];
        const dataInput = {};

        jQuery.each(form.serializeArray(), function(index, obj) {
            dataInput[obj.name] = obj.value;
            
        });

        const validation = validationStr;
      
        const errors = reqValidator(validation, dataInput);
       
        const btn = form.find('button');

        btn.prop('disabled', true);
        btn.removeClass('active');
        if (Object.keys(errors)[0]) {
            for (const keye in errors) {
                const fielde = jQuery(`.field.${keye} .mess`);
                fielde.addClass('active');
                fielde.text(errors[keye]);
            }
            btn.removeClass('loading-btn');
            return;
        }

        btn.addClass('active');
        btn.prop('disabled', false);
       
        return dataInput;

}
jQuery(document).ready(function() {
    
    jQuery('.forgot-pass-page button').prop('disabled', true);

    jQuery("#forgot-password input[name=email]").on('change, keyup', function() {
        const form = jQuery("#forgot-password");
        const dataInput = handlingForm(form, {
            'email': {
                type: ['required', 'email']
            }
        });
        if(!dataInput){
            return;
        }
    });
    jQuery("#number-paging1, #number-paging2, #number-paging3, #number-paging4").on('change, keyup', function() {
       
        const form = jQuery("#verify-email");
        const dataInput = handlingForm(form, {
            'email': {
                type: ['required', 'email']
            },
            'number-paging1': {
                type: ['required']
            },
            'number-paging2': {
                type: ['required']
            },
            'number-paging3': {
                type: ['required']
            },
            'number-paging4': {
                type: ['required']
            }
        });
        if(!dataInput){
            return;
        }
    });
    
    jQuery(".button-resend").click(function(e) {
        e.preventDefault();
        jQuery(this).addClass('loading-btn');
        jQuery(this).prop('disabled', true);
        jQuery("#forgot-password button").trigger("click");
    });
    jQuery("#forgot-password button").click(function() {
        const button = jQuery(this);
        const form =  jQuery(this).closest('form');
        const errorDiv = form.find('.error-notifi');
        const dataInput = handlingForm(form, {
            'email': {
                type: ['required', 'email']
            }
        });
        if(!dataInput){
            return;
        }

        button.addClass('loading-btn');
        button.prop('disabled', true);
        errorDiv.text('');
        dataInput['step'] = 1;
       
        jQuery.ajax({
            type: "POST",
            url: '<?php echo admin_url('admin-ajax.php');?>',
            data: {
                action: 'forgot_password_action',
                input: dataInput
            }
        })
        .done(function(response) {
            if (!response.data || !response.data.success || !response.data.email) {
                errorDiv.text(response.data.message);
                return;
            }
            
            jQuery('#forgot-page').addClass('step2');
            jQuery('#forgot-page').removeClass('step1');
            jQuery('#forgot-page').removeClass('step3');
            jQuery('.set-email').val(response.data.email);
            jQuery('.text-email').text(response.data.email);
        })
        .fail(function(jqXHR, textStatus) {
            alert('ERROR');
            location.reload();
        })
        .always(function() {
            button.removeClass('loading-btn');
            button.prop('disabled', false);
            jQuery(".button-resend").removeClass('loading-btn');
            jQuery(".button-resend").prop('disabled', false);
        })
    });
    jQuery("#verify-email button").click(function() {
        const button = jQuery(this);
        const form =  jQuery(this).closest('form');
        const errorDiv = form.find('.error-notifi');
        const dataInput = handlingForm(form, {
            'email': {
                type: ['required', 'email']
            },
            'number-paging1': {
                type: ['required']
            },
            'number-paging2': {
                type: ['required']
            },
            'number-paging3': {
                type: ['required']
            },
            'number-paging4': {
                type: ['required']
            }
        });
        if(!dataInput){
            return;
        }


        button.addClass('loading-btn');
        button.prop('disabled', true);
        errorDiv.text();
        dataInput['step'] = 2;
        dataInput['code'] = dataInput['number-paging1'] 
                            + dataInput['number-paging2'] 
                            + dataInput['number-paging3']
                            + dataInput['number-paging4'];


        jQuery.ajax({
            type: "POST",
            url: '<?php echo admin_url('admin-ajax.php');?>',
            data: {
                action: 'forgot_password_action',
                input: dataInput
            }
        })
        .done(function(response) {
            if (!response.data || !response.data.success || !response.data.email || !response.data.code) {
                errorDiv.text(response.data.message);
                return;
            }
            
            jQuery('#forgot-page').addClass('step3');
            jQuery('#forgot-page').removeClass('step1');
            jQuery('#forgot-page').removeClass('step2');
            jQuery('.set-email').val(response.data.email);
            jQuery('.set-code').val(response.data.code);
        })
        .fail(function(jqXHR, textStatus) {
            alert('ERROR');
            location.reload();
        })
        .always(function() {
            button.removeClass('loading-btn');
            button.prop('disabled', false);
        })
    });
    jQuery("input[name=password], input[name=confirm_password]").on('change, keyup', function() {
        const form = jQuery("#create-password");
        const dataInput = handlingForm(form, {
            'email': {
                type: ['required', 'email']
            },
            'code': {
                type: ['required']
            },
            'password': {
                type: ['required', 'password']
            },
            'confirm_password': {
                type: ['required', 'password']
            }
        });
       
        if(!dataInput){
            return;
        }
        
        if(dataInput['password'] !== dataInput['confirm_password']){
            const btn=form.find('button');
            btn.prop('disabled', true);
            btn.removeClass('active');
            return;    
        }
    });
    
    jQuery(".forgot-back").click(function(e) {
        e.preventDefault();
        if(jQuery("#forgot-page").hasClass('step2')){
            jQuery("#forgot-page").addClass('step1');
            jQuery("#forgot-page").removeClass('step2');
            jQuery("#forgot-page").removeClass('step3');
        }else if(jQuery("#forgot-page").hasClass('step3')){
            jQuery("#forgot-page").removeClass('step1');
            jQuery("#forgot-page").addClass('step2');
            jQuery("#forgot-page").removeClass('step3');
        }else{
            location.href=jQuery(this).attr('href');
        }
    });
    jQuery("#create-password button").click(function() {
        const button = jQuery(this);
        const form =  jQuery(this).closest('form');
        const errorDiv = form.find('.error-notifi');
        const dataInput = handlingForm(form, {
            'email': {
                type: ['required', 'email']
            },
            'code': {
                type: ['required']
            },
            'password': {
                type: ['required', 'password']
            },
            'confirm_password': {
                type: ['required', 'password']
            }
        });
        if(!dataInput){
            return;
        }
        
        if(dataInput['password'] !== dataInput['confirm_password']){
            const btn=form.find('button');
            btn.prop('disabled', true);
            btn.removeClass('active');
            return;    
        }
        errorDiv.text('');
        button.addClass('loading-btn');
        button.prop('disabled', true);
        dataInput['step'] = 3;
       
        jQuery.ajax({
            type: "POST",
            url: '<?php echo admin_url('admin-ajax.php');?>',
            data: {
                action: 'forgot_password_action',
                input: dataInput
            }
        })
        .done(function(response) {
            if (!response.data || !response.data.success) {
                errorDiv.text(response.data.message);
                return;
            }
            
            location.href = "<?php create_url('login')?>";
        })
        .fail(function(jqXHR, textStatus) {
            alert('ERROR');
            location.reload();
        })
        .always(function() {
            button.removeClass('loading-btn');
            button.prop('disabled', false);
        })
    });
});
</script>
<script>
    jQuery(document).ready(function() {
        jQuery('.number-paging-field input').on('keyup', function (event) {
            var i = jQuery(this).index();
            var inputs = jQuery('.number-paging-field input')
            if (event.key === "Backspace") {
                inputs[i].value = '';
                if (i !== 0){
                    inputs[i - 1].focus();
                }
            } else {
                if (i === inputs.length - 1 && inputs[i].value !== '') {
                    return true;
                } else if (event.keyCode > 47 && event.keyCode < 58) {
                    inputs[i].value = event.key;
                if (i !== inputs.length - 1)
                    inputs[i + 1].focus();
                    event.preventDefault();
                } else if (event.keyCode > 64 && event.keyCode < 91) {
                    inputs[i].value = String.fromCharCode(event.keyCode);
                    if (i !== inputs.length - 1)
                        inputs[i + 1].focus();
                    event.preventDefault();
                }
            }
            
        });
    });
</script>