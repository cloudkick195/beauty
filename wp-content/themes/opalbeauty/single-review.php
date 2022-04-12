<?php get_header();?>
<?php header_page(__('Comments', 'opalbeauty')); $user_id = get_current_user_id();?>
<?php if (have_posts() ) :  the_post();?>
<div class="wrap question-archive">
    <div class="post-box">
        <div class="post img-des">
        <?php 
            $img_avatar = '
                <img id="avatar-img" class="main avatar-img"
                    src="'.get_theme_path("/assets/images/user-icon.svg").'" alt="opal user icon">
            ';
            $post_author = $post->post_author;
            $author_url = get_author_posts_url($post_author).'?post=review';
            if(get_field('user_avatar', 'user_'.$post_author)){
                $img_avatar = '<img id="avatar-img" class="main avatar-img active"
                src="'.get_field('user_avatar', 'user_'.$post_author).'" alt="opal user icon">';
            }

        ?>
            <div class="author-box">
            <div class="img"><a class="thumb-link" href="<?php echo $author_url?>">
                <?php echo $img_avatar?>
                </a></div>
            <div class="des">
                <div class="excerpt">
                    <a class="author-title" href="<?php echo $author_url?>"><?php the_author()?></a>
                    <?php the_content()?>
                    
                </div>
                <div class="date-span">
                        <span class="calenda-icon"><?php echo opal_dateDiff(get_the_date('Y-m-d H:i:s'));?></span>
                    </div>
            </div>
            </div>
            <div class="comment-section">

                <div class="comment-wrap">
                    <div class="icon-textarea flex-container">
                        <img data-icon="💖" src="<?php theme_path('/assets/images/textarea-icon1.svg') ?>">
                        <img data-icon="🎁" src="<?php theme_path('/assets/images/textarea-icon2.svg') ?>">
                        <img data-icon="🎉" src="<?php theme_path('/assets/images/textarea-icon3.svg') ?>">
                        <img data-icon="😎" src="<?php theme_path('/assets/images/textarea-icon4.svg') ?>">
                        <img data-icon="😍" src="<?php theme_path('/assets/images/textarea-icon5.svg') ?>">
                        <img data-icon="😯" src="<?php theme_path('/assets/images/textarea-icon6.svg') ?>">
                        <img data-icon="😱" src="<?php theme_path('/assets/images/textarea-icon7.svg') ?>">
                    </div>
                    <div class="author-thumb">
                        <?php 
                        $img_avatar = '
                            <img id="avatar-img" class="main avatar-img"
                                src="'.get_theme_path("/assets/images/user-icon.svg").'" alt="opal user icon">
                        ';
                        $comment_avatar = get_field('user_avatar', 'user_'.get_current_user_id() );
                        if($comment_avatar){
                            $img_avatar = '<img id="avatar-img" class="main avatar-img active"
                            src="'.$comment_avatar.'" alt="opal user icon">';
                        }
                        echo $img_avatar;
                    ?>
                    </div>
                    <?php comments_template();?>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- <textarea id="focus-textarea" cols="30" rows="10"></textarea> -->
<?php endif;?>
<?php get_footer();?>
<script type="text/javascript" src="<?php theme_path('/assets/js/validator.min.js')?>"></script>
<script type='text/javascript' src="<?php theme_path('/assets/js/validate.js')?>"></script>
<script>
function getValidation() {
    return {
        'post_id': {
            name: 'Question',
            type: ['required']
        }
    }
}
function handlingForm(form) {
    const arrRequire = [];
    const dataInput = {
        
    };
    
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
    jQuery('.wpd-textarea-wrap .wc_comment ').attr('placeholder', 'Your answer');
    jQuery('.wc_comm_submit').val('Post');
    jQuery(".action-question span").click(function() {
        jQuery(".action-question .popup").toggleClass('active');
    });
    // jQuery(".wpd-textarea-wrap textarea").focus(function() {
    //     jQuery("#focus-textarea").addClass('active');
    // });
    // jQuery(".wpd-textarea-wrap textarea").focusout(function() {
    //     jQuery("#focus-textarea").removeClass('active');
    // });
    // jQuery(".wpd-textarea-wrap textarea").keyup(function(){
    //     jQuery("#focus-textarea").val(jQuery(this).val());
    // });
    // jQuery("#focus-textarea ").keyup(function(){
    //     jQuery(".wpd-textarea-wrap textarea").val(jQuery(this).val());
    // });
 
    jQuery(".icon-textarea img").click(function() {
        var tav    = jQuery('.wpd-textarea-wrap textarea').val(),
        strPos = jQuery('.wpd-textarea-wrap textarea')[0].selectionStart;
        front  = (tav).substring(0,strPos),
        back   = (tav).substring(strPos,tav.length); 
    
        jQuery('.wpd-textarea-wrap textarea').val(front + jQuery(this).data('icon') + back);
        jQuery('.wc_comm_submit').addClass('active');
       
    });
    jQuery('.wpd-textarea-wrap textarea').on('change, keyup', function() {
        jQuery('.wc_comm_submit').removeClass('active');
        if(jQuery(this).val()){
            jQuery('.wc_comm_submit').addClass('active');
        }
    })
    jQuery("#submit_unregister").click(function() {
        const form = jQuery("#delete_question");
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
                    action: 'delete_question',
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
               
                window.location = "<?php create_url('question')?>";

            })
            .fail(function(jqXHR, textStatus) {
                alert('ERROR');
            })
            .always(function() {
                btn_submit.removeClass('loading-btn');
                btn_submit.prop('disabled', false);
            })
    });
    jQuery(".like-comment-like").click(function() {

        jQuery(this).addClass('loading-btn');
        jQuery(this).prop('disabled', true);

        var btn_submit = jQuery(this);
        jQuery.ajax({
                type: "POST",
                url: '<?php echo admin_url('admin-ajax.php');?>',
                data: {
                    action: "likeAction",
                    input: jQuery(this).data('id')
                }
            })
            .done(function(response) {
                if (!response.data) {
                    alert('ERROR');
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