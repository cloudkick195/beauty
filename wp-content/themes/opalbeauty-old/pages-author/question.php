<?php 
$countPost = $args['countPost'];
$user_id = $args['user_id'];
?>
<?php get_header();?>
<?php header_page(__('My posts', 'opalbeauty')); 
$postOther = count_post_type('review');?>
<div class="nav-author">
    <a class="active"
        href="<?php echo get_author_posts_url($user_id)?>?post=question"><?php _e('Question', 'opalbeauty'); echo ' ('.$countPost.')'?></a>
    <a
        href="<?php echo get_author_posts_url($user_id)?>?post=review"><?php _e('Review', 'opalbeauty'); echo ' ('.$postOther.')'?></a>
</div>
<a class="author-create-action" href="<?php create_url('post-question')?>">
    <img src="<?php theme_path('/assets/images/plus-circle.svg')?>">
</a>
<div class="question-archive">
    <div class="wrap wrap-result">
        <div class="post-box">
            <?php  
            // The Query
            if (have_posts() ) :
                while ( have_posts() ) : the_post();?>
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
                    <h5><a class="box-title" href="<?php the_permalink() ?>"
                            title="<?php the_title_attribute()?>"><?php the_title()?></a></h5>

                    <div class="excerpt"><?php the_excerpt()?></div>

                    <div class="meta-span">
                        <div class="date-span">
                            <img
                                src="<?php theme_path('/assets/images/calenda-black.svg') ?>"><?php echo get_the_date()?>
                        </div>
                        <div class="like-comment">
                            <span class="like-comment-like" data-id="<?php the_ID()?>">
                                <?php $user_like = checkLike(get_the_ID())?>
                                <?php if($user_like['liked']):?>
                                <img src="<?php theme_path('/assets/images/heart-active.svg') ?>">
                                <?php else:?>
                                <img src="<?php theme_path('/assets/images/heart-gray.svg') ?>">
                                <?php endif;?>
                                <?php echo $user_like['count']?>
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
                                <?php echo get_comments_number();?>
                            </span>

                        </div>
                        <div class="cleared"></div>
                    </div>

                </div>
            </div>
            <?php endwhile;?>
            <?php wp_reset_postdata();?>
            <?php endif;?>
        </div>
    </div>
</div>

<?php get_footer();?>
<script>
jQuery(document).ready(function() {
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
