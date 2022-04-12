<?php /* Template Name: Setting  */ ?>
<?php 
$user_id = get_current_user_id();
$notification_val = get_field('user_notification', 'user_'.$user_id);
$text_notifi = __('Yes', 'opalbeauty');
if($notification_val == false){
    $text_notifi = __('No', 'opalbeauty');
}

get_header();?>

<?php header_page('Setting');?>
<main class="user-page wrap setting-page">
    <div class="data-wrap">
        <div class="results">
            <div class="post only-des">
                <div class="des">
                    <h6><?php _e('Notification setting', 'opalbeauty');?></h5>
                    <a class="popup-btn" data-id="notification" href="#"><?php echo $text_notifi;?></a>
                </div>
            </div>
            <div class="post only-des">
                <div class="des">
                    <h6><?php _e('Language', 'opalbeauty');?></h5>
                    <a class="popup-btn language-btn" data-id="language" href="#"></a>
                </div>
            </div>
            <a class="btn-style full logout-btn" href="<?php echo wp_logout_url( get_create_url('login') ); ?>"><?php _e('Logout', 'opalbeauty');?></a>
            <div class="popup-box">
                <form method="post" id="notification_form" class="notification-popup popup-setting">
                    <div class="box">
                        <div class="box-row <?php echo $notification_val == true ? 'active' : '' ?>">
                            <label>
                                <input type="radio" name="notification" value="1" <?php echo $notification_val == true ? 'checked' : '' ?>>
                                <?php _e('Yes', 'opalbeauty');?>
                            </label>
                        </div>
                        <div class="box-row <?php echo $notification_val == false ? 'active' : '' ?>">
                            <label>
                                <input type="radio" name="notification" value="0" <?php echo $notification_val == false ? 'checked' : '' ?>>
                                <?php _e('No', 'opalbeauty');?>
                            </label>
                            
                        </div>
                    </div>
                </form>
                <div class="language-popup popup-setting">
                    <div class="box">
                        <?php echo do_shortcode('[language-switcher]'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
</main>
<?php get_footer();?>
<script>
jQuery(document).ready(function() {
    var valChecked = jQuery("input[name=notification]:checked").val();
    jQuery(".setting-page .des .language-btn").text(jQuery(".setting-page .trp-ls-shortcode-language .trp-ls-disabled-language").text());
    jQuery(".popup-btn").click(function() {
       var id = jQuery(this).data('id');
       jQuery(".popup-setting").removeClass('active');
       jQuery("."+id+"-popup").addClass('active');
    });
    jQuery("input[name=notification]").click(function() {
      
        if(valChecked == jQuery(this).val()){
            jQuery(".popup-box").removeClass('active');
            return;
        }
        console.log(22, jQuery(this).val());
        jQuery.ajax({
            type: "POST",
            url: '<?php echo admin_url('admin-ajax.php');?>',
            data: {
                action: 'updateNotification',
                input: jQuery(this).val()
            }
        })
        .done(function(response) {
            
            if (!response.data) {
                alert('ERROR');
            }
           
            location.reload();

        })

    });
});
</script>