<?php get_header();?>
<?php 
if (have_posts() ) :  the_post();?>
<?php header_thumb(get_the_post_thumbnail());?>
<?php 
    $fieldRegistered = get_field('event_users_register');
    $registeredCount = 0;
    $user_current = '';
    $checkRegister = false;
    $authorIds = [];
    $user_id = get_current_user_id();
    if(get_field('event_users_register') && isset(get_field('event_users_register')[0])){
        $registeredCount = count($fieldRegistered);
       
        foreach ( $fieldRegistered as $frVal ){
            $authorIds[$frVal->post_author] = $frVal;
        } 
    }
    if(isset($authorIds[$user_id])){
        $checkRegister = true;
    }
    
?>
<div class="post-container">
    <div class="wrap">
        <?php if(!$checkRegister):?>
        <div class="register-event-btn overlay-btn"><?php _e('Register', 'opalbeauty');?></div>
        <?php else:?>
        <div class="register-event-btn unregister-event popup-btn"><?php _e('Unregister', 'opalbeauty');?></div>
        <div class="popup-box">
            <div class="box">
                <p><?php _e('Are you sure to unregister?', 'opalbeauty');?></p>
                <div>
                    <span class="cancel-popup"><?php _e('Cancel', 'opalbeauty');?></span>
                    <form method="post" id="unregister_form" class="popup_form">
                        <input type="hidden" name="post_id" value="<?php the_ID()?>">
                        <button id="submit_unregister" type="button"><?php _e('Yes', 'opalbeauty');?></button>
                    </form>
                   <span class="cleared"></span>
                </div>
            </div>
        </div>
        <?php endif;?>
        <div class="post">
            <?php  
            // The Query
            $price = 'Free';
            if(!get_field('event_ticket_free')){
                $price = get_field('event_ticket_price');
            }
            
            $date = get_field('event_date_time');
            if($date){
                $date =  str_replace("sáng", "am", $date);
                $date =  str_replace("chiều", "pm", $date);  
                $dateCheck = DateTime::createFromFormat('d/m/Y g:i a',$date);
                if($dateCheck->format('d/m/Y') == date("d/m/Y") ){
                    $date = __('Today ', 'opalbeauty').$dateCheck->format('H:i:s A');
                }
            }
            
            ?>
            <div class="meta">
                <div class="time"><?php echo  $date?></div>
                <div class="cleared"></div>
            </div>

            <h5><a class="box-title" href="<?php the_permalink() ?>"
                    title="<?php the_title_attribute()?>"><?php the_title()?></a></h5>
            <div class="excerpt"><?php the_field('event_veunue');?></div>
            <div class="des">
                <?php 
                $beauty_id = get_field('account_event_beauty', 'user_'.get_the_author_meta('ID'));?>
                <div class="by"><?php _e('Event by', 'opalbeauty')?> 
                    <a href="<?php echo get_post_permalink($beauty_id)?>"><?php echo get_the_author_meta('display_name');?></a>
                </div>
            </div>

        </div>

    </div>
    <div class="post-content wrap">
        <div class="des-strong">
            <p><?php _e('Price', 'opalbeauty')?> <span><?php echo $price?></span></p>
            <p><?php _e('Service', 'opalbeauty')?> <span><?php echo get_field('event_service') ? implode(", ", get_field('event_service')) : '';?></span></p>
        </div>
        <div class="content">
            <p><img src="<?php theme_path('/assets/images/user-icon.svg')?>"> <?php the_field('event_host_info');?></p>
            <p><img src="<?php theme_path('/assets/images/des-icon.svg')?>"> <?php the_content();?></p>
        </div>
    </div>
    <div class="post-content wrap">
        <div class="des">
            <div class="registered"><img src="<?php theme_path('/assets/images/double-user.svg')?>"> <span><?php echo $registeredCount?></span>
                <?php _e('Registered', 'opalbeauty')?></div>
        </div>
    </div>
</div>

<?php if(!$checkRegister):?>
<div class="overlay-element">
    <div class="top-element">
        <span class="back-main">
            <img src="<?php theme_path('/assets/images/arrow-left.svg') ?>">
        </span>
        <h2><?php _e('Register event', 'opalbeauty')?></h2>
    </div>

    <div class="form-wrap">
        <form id="subscribe_form" action="POST" class="opal-forms opal-forms4 form-action">
            <input type="hidden" name="post_id" value="<?php the_ID()?>">
            <div class="form-group wrap">
                <div class="field text-field subscribe_name">
                    <label>
                        <input class="input-form require" name="subscribe_name" type="text" placeholder="<?php _e('Name', 'opalbeauty')?>">
                    </label>
                    <!-- <p class="mess"></p> -->
                </div>
                <div class="field text-field subscribe_phone">
                    <label>
                        <input class="input-form require" name="subscribe_phone" type="text" placeholder="<?php _e('Phone', 'opalbeauty')?>">
                    </label>
                    <!-- <p class="mess"></p> -->
                </div>
                <p class="form-des-text"><img src="<?php theme_path('/assets/images/service-icon.svg')?>"> <?php _e('Which
                    service are you interested in?', 'opalbeauty')?></p>
                <div class="field checkbox-field field_service">
                    <div>
                        <?php foreach(field_service() as $key => $value) {?>
                        <label>
                            <input type="checkbox" name="field_service" value="<?php echo $key?>">
                            <span class="checkmark"></span>
                            <?php echo $value[0]?>
                        </label>
                        <?php } ?>
                        <!-- <p class="mess"></p> -->
                    </div>
                </div>
            </div>
            <button id="submit-subscribe" type="button"
                class="sticky-action-btn"><?php _e('Send', 'opalbeauty');?></button>
        </form>
    </div>

</div>
<?php endif;?>
<?php endif;?>
<?php get_footer();?>
<script type="text/javascript" src="<?php theme_path('/assets/js/validator.min.js')?>"></script>
<script type='text/javascript' src="<?php theme_path('/assets/js/validate.js')?>"></script>
<script>
function getValidation() {
    <?php if(!$checkRegister):?>
    return {
        'subscribe_name': {
            name: 'Name',
            type: ['required']
        },
        'post_id': {
            name: 'Event',
            type: ['required']
        },
        'subscribe_phone': {
            name: 'Phone',
            type: ['required', 'phone']
        },
        'field_service': {
            name: 'Service',
            type: ['mutiple']
        }

    }
    <?php else:?>
        return {
            'post_id': {
                name: 'Event',
                type: ['required']
            }

        }
    <?php endif;?>
}
jQuery(document).ready(function() {
    function handlingForm(form) {
        const arrRequire = [];
        const dataInput = {
            field_service: []
        };
       
        jQuery.each(form.serializeArray(), function(index, obj) {
            if (obj.name == 'field_service') {
                dataInput[obj.name].push(obj.value);
            } else {
                dataInput[obj.name] = obj.value;
            }

        });
       
        const validation = getValidation();
        
        const errors = reqValidator(validation, dataInput);


        jQuery(`.opal-forms .mess`).removeClass('active');
       
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

    jQuery('.subscribe_name, .subscribe_phone').on('keyup', function() {
        const dataInput = handlingForm(jQuery('#subscribe_form'));
        if(!dataInput){
            return;
        }
    })
   
    jQuery('body').on('change', '#subscribe_form', function() {

        const form = jQuery(this);
        const dataInput = handlingForm(form);
       
        if(!dataInput){
            return;
        }

        const last_field = jQuery(`.field.interested_in .mess`);

    });
    jQuery("#submit_unregister").click(function() {
        const form = jQuery("#unregister_form");
        const dataInput = handlingForm(form);
        if(!dataInput){
            return;
        }

        const last_field = jQuery(`.field.field_service .mess`);

        jQuery(this).addClass('loading-btn');
        jQuery(this).prop('disabled', true);

        var btn_submit = jQuery(this);
        jQuery.ajax({
                type: "POST",
                url: '<?php echo admin_url('admin-ajax.php');?>',
                data: {
                    action: 'userUnregister',
                    input: dataInput
                }
            })
            .done(function(response) {
                
                if (!response.data) {
                    alert('ERROR');
                }
                if (response.data.success === false) { // user not exists
                    last_field.addClass('active');
                    last_field.text(response.data.message);
                    return
                }
               
                location.reload();

            })
            .fail(function(jqXHR, textStatus) {
                alert('ERROR');
            })
            .always(function() {
                btn_submit.removeClass('loading-btn');
                btn_submit.prop('disabled', false);
            })
    });
    
    jQuery("#submit-subscribe").click(function() {
        const form = jQuery("#subscribe_form");
        const dataInput = handlingForm(form);
        if(!dataInput){
            return;
        }

        const last_field = jQuery(`.field.field_service .mess`);

        jQuery(this).addClass('loading-btn');
        jQuery(this).prop('disabled', true);

        var btn_submit = jQuery(this);
        jQuery.ajax({
                type: "POST",
                url: '<?php echo admin_url('admin-ajax.php');?>',
                data: {
                    action: 'userSubscribe',
                    input: dataInput
                }
            })
            .done(function(response) {
                
                if (!response.data) {
                    alert('ERROR');
                }
                if (response.data.success === false) { // user not exists
                    last_field.addClass('active');
                    last_field.text(response.data.message);
                    return
                }
               
                location.reload();

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