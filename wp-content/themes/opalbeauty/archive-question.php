<?php get_header();
$checked = checkQueryCheked('question_category', '36');?>
<?php $user_id = get_current_user_id()?>
<div class="question-archive">
<form method="get" id="filter-events" class="opal-forms3">
    <div class="top-element">
        <button type="submit" class="prev-action"><img src="<?php theme_path('/assets/images/search-icon.svg') ?>"></button>
        <input type="text" class="search-input" name="s" id="<?php echo uniqid('s_');?>"
            value="<?php echo esc_attr(get_search_query());?>"
            placeholder="<?php esc_html_e( 'Search question...', 'opalbeauty' ); ?>" />
        <a class="create-action" href="<?php create_url('post-question')?>">
            <img src="<?php theme_path('/assets/images/plus-circle.svg')?>">
        </a>
        <a class="next-action notification-number" href="<?php create_url('notification')?>">
            <img src="<?php theme_path('/assets/images/notification.svg')?>">
            <?php $notification_val = get_field('user_notification', 'user_'.$user_id);?>
            <?php if($notification_val == true):?>
            <span class="number-notification"><?php echo count_unread_notification();?></span>
            <?php endif?>
        </a>
    </div>
    <div class="wrap wrap-form">
        <div class="field field_service">
            <div class="slick-carousel">
            <div class="item-slider checkbox-field">
            <label>
                <input type="radio" onchange="this.form.submit()" name="question_category[]"
                    value="0" 
                    <?php echo isset($checked['0']) ? 'checked' : ''?>>
                <span class="checkmark"><?php _e('All', 'beauty');?></span>
            </label>
            </div>
            <?php
                $taxonomies = get_terms( array(
                    'taxonomy' => 'question_category',
                    'hide_empty' => false,
                ) );
                if ( !empty($taxonomies) ) :
                    foreach( $taxonomies as $tax ) :?>
               <div class="item-slider checkbox-field">
                <label>
                    <input type="radio" onchange="this.form.submit()" name="question_category[]"
                     value="<?php echo $tax->term_id ?>" 
                     <?php echo isset($checked[$tax->term_id]) ? 'checked' : ''?>>
                    <span class="checkmark"><?php echo $tax->name?></span>
                </label>
                </div>
                <?php endforeach; ?>
                 <?php endif; ?>
            </div>
        </div>
    </div>
    
</form>

<div class="wrap wrap-result">
    <div class="post-box post-box-first">
    <?php  
            $argsQuery = [
                'post_type' => 'question',
                'author' => $user_id,
                'orderby' =>'date',
                'posts_per_page' => get_option( 'posts_per_page' ),
                'order' =>'DESC',
                'date_query' => array( 
                    array(
                        'after'     => date('Y-m-d H:i:s', strtotime(' -1 day')),
                        'inclusive' => true,                
                        'column' => 'post_date',   
                        'relation' => 'AND',
                    )
                )
            ];
            $the_query = new WP_Query( $argsQuery );
            // The Query
            if ($the_query->have_posts() ) :
                while ( $the_query->have_posts() ) : $the_query->the_post();?>
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

                        <a href="<?php the_permalink() ?>" class="excerpt excerpt-url"><?php the_excerpt()?></a>

                        <div class="meta-span">
                            <div class="date-span">
                                <img src="<?php theme_path('/assets/images/calenda-black.svg') ?>"><?php echo get_the_date()?>
                            </div>
                            <div class="like-comment">
                                <?php $user_like = checkLike(get_the_ID())?>
                                <span class="like-comment-like <?php echo $user_like['liked'] ? 'active' : ''?>"  data-id="<?php the_ID()?>">
                                    <img src="<?php theme_path('/assets/images/heart-active.svg') ?>">
                                    <img src="<?php theme_path('/assets/images/heart-gray.svg') ?>">
                                    <span><?php echo $user_like['count']?></span>
                                </span>
                                <?php 
                                $comments = get_comments(array(
                                    'post_id' => get_the_ID(),
                                    'user_id' => $user_id
                                ));
                                ?>
                                <a href="<?php the_permalink() ?>">
                                    <?php if(count($comments) > 0):?>
                                        <img src="<?php theme_path('/assets/images/chat-active.svg') ?>">
                                    <?php else:?>
                                        <img src="<?php theme_path('/assets/images/chat-icon.svg') ?>">
                                    <?php endif;?>
                                    <?php echo get_comments_number();?>
                                </a>
                                
                            </div>
                            <div class="cleared"></div>
                        </div>
                       
                    </div>
                </div>
        <?php endwhile;?>
        <?php wp_reset_postdata();?>
        <?php endif;?>
    </div>
    <div class="post-box post-box-question">
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

                        <a href="<?php the_permalink() ?>" class="excerpt excerpt-url"><?php the_excerpt()?></a>

                        <div class="meta-span">
                            <div class="date-span">
                                <img src="<?php theme_path('/assets/images/calenda-black.svg') ?>"><?php echo get_the_date()?>
                            </div>
                            <div class="like-comment">
                                <?php $user_like = checkLike(get_the_ID())?>
                                <span class="like-comment-like <?php echo $user_like['liked'] ? 'active' : ''?>"  data-id="<?php the_ID()?>">
                                    <img src="<?php theme_path('/assets/images/heart-active.svg') ?>">
                                    <img src="<?php theme_path('/assets/images/heart-gray.svg') ?>">
                                    <span><?php echo $user_like['count']?></span>
                                </span>
                                <?php 
                                $comments = get_comments(array(
                                    'post_id' => get_the_ID(),
                                    'user_id' => $user_id
                                ));
                                ?>
                                <a href="<?php the_permalink() ?>">
                                    <?php if(count($comments) > 0):?>
                                        <img src="<?php theme_path('/assets/images/chat-active.svg') ?>">
                                    <?php else:?>
                                        <img src="<?php theme_path('/assets/images/chat-icon.svg') ?>">
                                    <?php endif;?>
                                    <?php echo get_comments_number();?>
                                </a>
                                
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

        // jQuery(this).addClass('loading-btn');
        jQuery(this).prop('disabled', true);

        
        var btn_submit = jQuery(this);
        var textLike = btn_submit.find('span');
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
                action: "likeAction",
                input: jQuery(this).data('id')
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
            // btn_submit.removeClass('loading-btn');
            btn_submit.prop('disabled', false);
        })
    });
});
</script>
