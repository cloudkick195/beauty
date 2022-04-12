<?php 
$countPost = $args['countPost'];
$user_id = $args['user_id'];
$user = get_userdata($user_id);
?>
<?php get_header();?>
<?php header_author();?>
<?php 

    $img_avatar = '
        <img id="avatar-img" class="main avatar-img"
            src="'.get_theme_path("/assets/images/user-icon.svg").'" alt="opal user icon">
    ';
    $fieldAvatar = get_field('user_avatar', 'user_'.$user_id);
    if($fieldAvatar){
        $img_avatar = '<img id="avatar-img" class="main avatar-img active"
        src="'.$fieldAvatar.'" alt="opal user icon">';
    }
?>
<div class="author-header-fixed">
<div class="avatar-center">
    <span class="box-circle">
        <?php echo $img_avatar?>
    </span>
    <p><?php echo $user->display_name?></p>
</div>
<div class="nav-author-link flex-container">
    <a href="<?php echo get_author_posts_url($user_id)?>"><?php _e('Profile', 'opalbeauty');?></a>
    <a class="active" href="<?php echo get_author_posts_url($user_id)?>?post=review"><?php _e('Review', 'opalbeauty');?></a>
    <a href="<?php echo get_author_posts_url($user_id)?>?post=question"><?php _e('Question', 'opalbeauty');?></a>
    <a href="<?php echo get_author_posts_url($user_id)?>?post=event"><?php _e('Event', 'opalbeauty');?></a>
    
</div>
</div>
<div class="review-archive">

    <div class="wrap wrap-result">
        <div class="post-review">
            <?php  
            // The Query
            if (have_posts() ) :
                while ( have_posts() ) : the_post(); $post_id = get_the_ID();?>
            <div class="post">
                <div class="img-des">
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
                    <div class="img"><a class="thumb-link" href="<?php echo get_author_posts_url($post_author) ?>"
                            title="<?php the_title_attribute()?>">
                            <?php echo $img_avatar?>
                        </a></div>
                    <div class="des">
                        <h5><a class="box-title" href="<?php echo get_author_posts_url($post_author) ?>"
                                title="<?php the_title_attribute()?>"><?php the_author()?></a>
                            <div class="popup-box">
                                <div class="box">
                                    <p><?php _e('Are you sure to delete review ?', 'opalbeauty');?></p>
                                    <div>
                                        <span class="cancel-popup"><?php _e('Cancel', 'opalbeauty');?></span>
                                        <form method="post" id="delete_question" class="popup_form">
                                            <input type="hidden" name="post_id" value="<?php the_ID()?>">
                                            <button class="submit_unregister"
                                                type="button"><?php _e('Yes', 'opalbeauty');?></button>
                                        </form>
                                        <span class="cleared"></span>
                                    </div>
                                </div>
                            </div>
                        </h5>

                        <div class="meta-span">
                            <div class="date-span">
                                <?php echo get_the_date()?>
                            </div>

                            <div class="cleared"></div>
                        </div>

                    </div>
                </div>
                <div class="thumb-des ib-cols">
                    <div class="box">
                        <img src="<?php the_field('review_before')?>">
                        <div class="sub-thumb"><?php _e('Before', 'opalbeauty');?></div>
                    </div>
                    <div class="box">
                        <img src="<?php the_field('review_after')?>">
                        <div class="sub-thumb"><?php _e('After', 'opalbeauty');?></div>
                    </div>
                </div>
                <div class="like-comment">
                    <?php $user_like = checkLike(get_the_ID(), 'review')?>
                    <span class="like-comment-like <?php echo $user_like['liked'] ? 'active' : ''?>" data-id="<?php the_ID()?>">
                        <img src="<?php theme_path('/assets/images/heart-active.svg') ?>">
                        <img src="<?php theme_path('/assets/images/heart-gray.svg') ?>">
                    </span>
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
                    </span>
                    <span class="share-action">
                        <img src="<?php theme_path('/assets/images/share-icon.svg') ?>">
                    </span>
                </div>
                <div class="like-text"><?php echo '<span>'.$user_like['count'].'</span> '. __('Likes', 'opalbeauty')?></div>
                <div class="excerpt">
                    <div class="excerpt-all">
                        <?php the_excerpt()?>

                    </div>
                    <div class="content-all"><?php the_content()?></div>
                </div>
                <div class="view-all-comment">
                    <a href="<?php the_permalink()?>"><?php _e('View all '.count($comments).' comments');?></a>
                </div>
            </div>

            <?php endwhile;?>
            <?php wp_reset_postdata();?>
            <?php endif;?>
        </div>
    </div>
</div>

<?php get_footer();?>
<script type="text/javascript" src="<?php theme_path('/assets/js/validator.min.js')?>"></script>
<script type='text/javascript' src="<?php theme_path('/assets/js/validate.js')?>"></script>
<script>
function getValidation() {
    return {
        'post_id': {
            name: 'Review',
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
    jQuery(".action-question span").click(function() {
        jQuery(this).closest('.des').find(".action-question .popup").toggleClass('active');
    });
    jQuery(".submit_unregister").on('click', function() {
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
    jQuery(".more-content").on('click', function(e) {
        var parent = jQuery(this).closest('.excerpt');
        parent.find('.content-all').show();
        parent.find('.excerpt-all').hide();

    });
    jQuery(".like-comment-like").click(function() {

        //jQuery(this).addClass('loading-btn');
        jQuery(this).prop('disabled', true);

        var btn_submit = jQuery(this);
        var textLike = btn_submit.closest('.post').find('.like-text span');
        if(btn_submit.hasClass('active')){
            btn_submit.removeClass('active');
            textLike.text(parseInt(textLike.text()) - 1);
            
        }else{
            btn_submit.addClass('active');
            textLike.text(parseInt(textLike.text()) + 1);

        }


        jQuery.ajax({
                type: "POST",
                url: '<?php echo admin_url('admin-ajax.php');?>',
                data: {
                    action: "likeActionKey",
                    input: {
                        'id': jQuery(this).data('id'),
                        'key': 'review'
                    },

                }
            })
            .done(function(response) {
                if (!response.data) {
                    alert('ERROR');
                }
                
                //location.reload();
            })
            .fail(function(jqXHR, textStatus) {
                alert('ERROR');
            })
            .always(function() {
                //btn_submit.removeClass('loading-btn');
                btn_submit.prop('disabled', false);
            })
        });
    });
</script>