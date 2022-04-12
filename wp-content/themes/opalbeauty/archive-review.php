<?php get_header();
$checked = checkQueryCheked('review_category');?>
<?php 
$current_user = wp_get_current_user();
$user_email = $current_user->user_email;
$user_id = $current_user->ID?>
<div class="review-archive">
    <form method="get" id="filter-events" class="opal-forms3">
        <div class="top-element">
            <button type="submit" class="prev-action"><img
                    src="<?php theme_path('/assets/images/search-icon.svg') ?>"></button>
            <input type="text" class="search-input" name="s" id="<?php echo uniqid('s_');?>"
                value="<?php echo esc_attr(get_search_query());?>"
                placeholder="<?php esc_html_e( 'Search review...', 'opalbeauty' ); ?>" />
            <a class="create-action" href="<?php create_url('post-review')?>">
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
            <div class="field checkbox-field review_category field_service">
                <div class="owl-carousel">
                    <?php
                
                
                $taxonomies = get_terms( array(
                    'taxonomy' => 'review_category',
                    'hide_empty' => false,
                ) );
                if ( !empty($taxonomies) ) :?>
                    <label>

                        <!-- <input type="checkbox" onchange="this.form.submit()" name="review_category[]" value="0" <?php echo !get_query_var('review_category') ? 'checked' : ''?>> -->
                        <a class="checkmark <?php echo !get_query_var('review_category') ? 'image-checked' : ''?>"
                            href="<?php create_url('review')?>">
                            <div class="img"><img src="<?php theme_path('/assets/images/review-all.svg') ?>">
                            <img src="<?php theme_path('/assets/images/review-all-active.svg') ?>"></div>
                            <?php _e( 'All', 'opalbeauty' ); ?>
                        </a>
                    </label>
                    <?php foreach( $taxonomies as $tax ) :?>
                    <label>

                        <input type="radio" onchange="this.form.submit()" name="review_category[]"
                            value="<?php echo $tax->term_id ?>"
                            <?php echo isset($checked[$tax->term_id]) ? 'checked' : ''?>>
                        <span class="checkmark">
                            <div class="img"><img
                                    src="<?php the_field('review_category_image', 'term_'.$tax->term_id)?>">
                                    <img
                                    src="<?php the_field('review_category_image_active', 'term_'.$tax->term_id)?>"></div>
                            <?php echo $tax->name?>
                        </span>
                    </label>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </form>

    <div class="wrap wrap-result">
        <div class="post-review">
        <?php  
         $argsQuery = [
            'post_type' => 'review',
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

        $review_category = get_query_var('review_category');
           
        if($review_category){
            $argsQuery['tax_query'] =  array(                     //(array) - Lấy bài viết dựa theo taxonomy
                'relation' => 'OR',
                array(
                    'taxonomy' => 'review_category',                //(string) - Tên của taxonomy
                    'field' => 'id',                    //(string) - Loại field cần xác định term của taxonomy, sử dụng 'id' hoặc 'slug'
                    'terms' => $review_category,    //(int/string/array) - Slug của các terms bên trong taxonomy cần lấy bài
                    'operator' => 'IN'                    //(string) - Toán tử áp dụng cho mảng tham số này. Sử dụng 'IN' hoặc 'NOT IN'
                ),
            );
        }
        $the_query = new WP_Query( $argsQuery );
            // The Query
            if ($the_query->have_posts() ) :
                while ( $the_query->have_posts() ) : $the_query->the_post(); $post_id = get_the_ID();?>
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
                                title="<?php the_title_attribute()?>"><?php the_author()?></a></h5>

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
                        'post_id' => get_the_ID()
                    ));
                    $havedComment = false;
                    foreach($comments as $com){
                        if($user_email == $com->comment_author_email){
                            $havedComment = true;
                            break;
                        }
                    }
                   
                    ?>
                    <a href="<?php the_permalink()?>/#wc-textarea-0_0">
                        <?php if($havedComment):?>
                        <img src="<?php theme_path('/assets/images/chat-active.svg') ?>">
                        <?php else:?>
                        <img src="<?php theme_path('/assets/images/chat-icon.svg') ?>">
                        <?php endif;?>
                    </a>
                    <span class="share-action" data-url="<?php the_permalink()?>" data-title="<?php the_title()?>">
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
                
                <?php if(!empty($comments) && count($comments) > 0):?>
                <div class="view-all-comment">
                    <a href="<?php the_permalink()?>"><?php _e('View all '.count($comments).' comments');?></a>
                </div>
                <?php endif;?>
            </div>

            <?php endwhile;?>
            <?php wp_reset_postdata();?>
            <?php endif;?>
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
                                title="<?php the_title_attribute()?>"><?php the_author()?></a></h5>

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
                        'post_id' => get_the_ID()
                    ));
                    $havedComment = false;
                    foreach($comments as $com){
                        if($user_email == $com->comment_author_email){
                            $havedComment = true;
                            break;
                        }
                    }
                   
                    ?>
                    <a href="<?php the_permalink()?>/#wc-textarea-0_0">
                        <?php if($havedComment):?>
                        <img src="<?php theme_path('/assets/images/chat-active.svg') ?>">
                        <?php else:?>
                        <img src="<?php theme_path('/assets/images/chat-icon.svg') ?>">
                        <?php endif;?>
                    </a>
                    <span class="share-action" data-url="<?php the_permalink()?>" data-title="<?php the_title()?>">
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
                
                <?php if(!empty($comments) && count($comments) > 0):?>
                <div class="view-all-comment">
                    <a href="<?php the_permalink()?>"><?php _e('View all '.count($comments).' comments');?></a>
                </div>
                <?php endif;?>
            </div>

            <?php endwhile;?>
            <?php wp_reset_postdata();?>
            <?php endif;?>
        </div>
    </div>
</div>
<div class="overlay-black">
    <div class="bottom-overlay">
        <h5 class="text-center"><?php _e('Share', 'opalbeauty');?></h5>
        <div class="share-socials">
            <a href="#" class="share-link">
                <img src="<?php theme_path('/assets/images/share-link.png') ?>">
                <span class="tooltip-text"><?php _e('Copied', 'opalbeauty');?></span>
            </a> 
            <a href="https://www.facebook.com/sharer/sharer.php"
   onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
   target="_blank" title="Share on Facebook" class="share-facebook">
                <img src="<?php theme_path('/assets/images/share-facebook.png') ?>">
            </a>
            <a href="#" class="share-zalo">
                <img src="<?php theme_path('/assets/images/share-zalo.png') ?>">
            </a>
            <a href="http://www.twitter.com/intent/tweet" class="share-twitter">
                <img src="<?php theme_path('/assets/images/share-twitter.png') ?>">
            </a>
        </div>
        <a href="#" class="cancel-btn">
            <?php _e('Cancel', 'opalbeauty')?>
        </a>      
    </div>    
</div>
<?php get_footer();?>
<script>
    // return a promise
function copyToClipboard(textToCopy) {
    // navigator clipboard api needs a secure context (https)
    if (navigator.clipboard && window.isSecureContext) {
        // navigator clipboard api method'
        return navigator.clipboard.writeText(textToCopy);
    } else {
        // text area method
        let textArea = document.createElement("textarea");
        textArea.value = textToCopy;
        // make the textarea out of viewport
        textArea.style.position = "fixed";
        textArea.style.left = "-999999px";
        textArea.style.top = "-999999px";
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        return new Promise((res, rej) => {
            // here the magic happens
            document.execCommand('copy') ? res() : rej();
            textArea.remove();
        });
    }
}
jQuery(document).ready(function() {
    
    var checkClick = true;
 
    // jQuery('.share-action').click(function(e) {
    //         e.preventDefault();
    //         var dataAttr = jQuery(this).data();
            
    //         var data = {
    //             'url': dataAttr.url,
    //             'title': dataAttr.title
    //         }
            
    //         jQuery('.share-socials a.share-facebook').attr(
    //             'href',
    //             jQuery('.share-socials a.share-facebook').attr('href')+
    //             `?u=${data.url}&t=${data.title}`
    //         )
    //         jQuery('.share-socials a.share-twitter').attr(
    //             'href',
    //             jQuery('.share-socials a.share-twitter').attr('href')+
    //             `?url=${data.url}&text=${data.title}`
    //         )

    //         jQuery('.share-link').attr(
    //             'href',
    //             data.url
    //         )
    //         jQuery('.overlay-black').addClass('active');
    // });
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