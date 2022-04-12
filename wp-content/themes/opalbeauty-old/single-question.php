<?php get_header();?>
<?php header_page(__('Detail question', 'opalbeauty')); $user_id = get_current_user_id();?>
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
                
                if(get_field('user_avatar', 'user_'.$post_author)){
                    $img_avatar = '<img id="avatar-img" class="main avatar-img active"
                    src="'.get_field('user_avatar', 'user_'.$post_author).'" alt="opal user icon">';
                }
            ?>
            <div class="img"><a class="thumb-link" href="<?php the_permalink() ?>"
                    title="<?php the_title_attribute()?>">
                    <?php echo $img_avatar?>
                </a></div>
            <div class="des">
                <h5 class="box-title">
                    <?php the_author()?>
                    <?php  
                    $author_post = get_author_question(get_the_ID());
                    if(count($author_post['post']) > 0):?>
                    <div class="action-question">
                        <span>...</span>
                        <div class="popup">
                            <a href="<?php create_url('edit-question?qid='.get_the_ID())?>"><?php _e('Edit', 'opalbeauty')?></a>
                            <a class="popup-btn" href="#"><?php _e('Delete', 'opalbeauty')?></a>
                        </div>
                    </div>
                    <div class="popup-box">
                        <div class="box">
                            <p><?php _e('Are you sure to delete question ?', 'opalbeauty');?></p>
                            <div>
                                <span class="cancel-popup"><?php _e('Cancel', 'opalbeauty');?></span>
                                <form method="post" id="delete_question" class="popup_form">
                                    <input type="hidden" name="post_id" value="<?php the_ID()?>">
                                    <button id="submit_unregister" type="button"><?php _e('Yes', 'opalbeauty');?></button>
                                </form>
                            <span class="cleared"></span>
                            </div>
                        </div>
                    </div>
                    <?php endif;?>
                   
                </h5>

                <div class="meta-span">
                    <div class="date-span">
                        <?php echo get_the_date()?>
                    </div>
                </div>

            </div>

            <h5 class="box-title"><?php the_title()?></h5>
            <div class="content"><?php the_content()?></div>
            <div class="single-question-images">
                <?php the_field('question_images');?>
            </div>
            <div class="meta-span">
                <div class="like-comment">
                    <span class="like-comment-like" data-id="<?php the_ID()?>">
                        <?php $user_like = checkLike(get_the_ID())?>
                        <?php if($user_like['liked']):?>
                        <img src="<?php theme_path('/assets/images/heart-active.svg') ?>">
                        <?php else:?>
                        <img src="<?php theme_path('/assets/images/heart-gray.svg') ?>">
                        <?php endif;?>
                        <?php echo $user_like['count'].' '.__('liked', 'opalbeauty')?>
                    </span>
                    <span>
                        <?php 
                            $comments = get_comments(array(
                                'post_id' => get_the_ID(),
                                'user_id' => $user_id
                            ));
                            ?>
                        <span>
                            <?php if(count($comments) > 0):?>
                            <img src="<?php theme_path('/assets/images/chat-active.svg') ?>">
                            <?php else:?>
                            <img src="<?php theme_path('/assets/images/chat-icon.svg') ?>">
                            <?php endif;?>
                            <?php echo get_comments_number() .' '.__('answers', 'opalbeauty')?>
                        </span>

                </div>
                <div class="cleared"></div>
            </div>
            <div class="comment-section">

                <div class="comment-wrap">
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
<textarea id="focus-textarea" cols="30" rows="10"></textarea>
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

    jQuery(".wpd-textarea-wrap textarea").focus(function() {
        jQuery("#focus-textarea").addClass('active');
    });
    jQuery(".wpd-textarea-wrap textarea").focusout(function() {
        jQuery("#focus-textarea").removeClass('active');
    });
    jQuery(".wpd-textarea-wrap textarea").keyup(function(){
        jQuery("#focus-textarea").val(jQuery(this).val());
    });
    jQuery("#focus-textarea ").keyup(function(){
        jQuery(".wpd-textarea-wrap textarea").val(jQuery(this).val());
    });
     
    jQuery("textarea.wc_comment").on('change, keyup', function() {
        if(jQuery(this).val()){
            jQuery('.wc_comm_submit').addClass('active');
        }else{
            jQuery('.wc_comm_submit').removeClass('active');
        }
       
    });
    
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