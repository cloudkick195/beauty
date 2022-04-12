<?php /* Template Name: Home  */ ?>
<?php get_header();?>
<script> window.appBridge.startMain(); </script>
<?php $user = opal_get_current_user();?>
<section class="banner-slider">
    <?php the_content();?>
</section>
<section class="user-section wrap">
    <div class="img-des">
        <div class="img">
            <?php 
                $img_avatar = '
                    <img src="'.get_theme_path("/assets/images/user-bg.svg").'">
                ';
                if($user['avatar']){
                    $img_avatar = '<img src="'.$user['avatar'].'">';
                }
            ?>
            <?php echo $img_avatar ?>
        </div>
        <div class="des">
            <h5 class="name"><?php echo $user['display']?>
                <?php if($user['is_doctor']):?>
                    <span class="alert-warning">
                    <img src="<?php theme_path('/assets/images/plus-plus.svg') ?>">
                    <?php _e('Doctor', 'opalbeauty')?>
                    </span>
                <?php endif?>
            </h5>
            <a href="<?php create_url('account')?>"><?php _e('Edit profile', 'opalbeauty')?> <img src="<?php theme_path('/assets/images/row-right.svg') ?>">
            </a>
            <a href="<?php create_url('setting')?>" class="setting-icon"><img src="<?php theme_path('/assets/images/setting-icon.svg') ?>"></a>
        </div>
        <div class="cleared"></div>
    </div>
    <div class="list-span">
    <?php  
        $querys = user_event_register();
        $my_posts = new WP_Query([
            'post_type' => ['review', 'question'],
            'author' => $user['id']
        ]);
        $count_my_posts = 0;
       
        if(!empty($my_posts)){
            $count_my_posts = $my_posts->found_posts;
            wp_reset_postdata();
        }
        
    ?>
        <p><a href="<?php create_url('my-event')?>"><span><?php echo $querys['count']?></span> <?php _e('My event', 'opalbeauty');?></a></p>
        <p><a href="<?php echo get_author_posts_url($user['id'])?>?post=question"><span><?php echo $count_my_posts;?></span> <?php _e('My post', 'opalbeauty')?></a></p>
        <div class="cleared"></div>
    </div>
</section>
<div class="wrap">
    <a class="search-btn home-overlay-btn" href="#"><img src="<?php theme_path('/assets/images/search-icon.svg') ?>"> <?php _e('Search spa & clinic...', 'opalbeauty')?></a>
    <h3 class="section-title"><?php _e('Skin spa', 'opalbeauty')?> <a href="<?php echo get_term_link('skin-spa', 'type_beauty')?>" class="read-more"><?php _e('See all', 'opalbeauty')?></a></h3>
    <div class="slider-section slider1">
        <div class="post-box1  owl-carousel">

            <?php  
            $args = array(
                'post_type'    =>  'beauty',
                'posts_per_page' => 3,
                'orderby' => 'date',
                'order' => 'DESC',
                'ignore_sticky_posts' => false,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'type_beauty',
                        'field'    => 'slug',
                        'terms'    => 'skin-spa',
                    ),
                ),
            );

            // The Query
            $the_query = new WP_Query( $args );
            if ( $the_query->have_posts() ) :
                while ( $the_query->have_posts() ) : $the_query->the_post();?>
            <div class="post">
                <a class="thumb-full" href="<?php the_permalink() ?>"></a>
                <a class="thumb-link" href="<?php the_permalink() ?>"
                    title="<?php the_title_attribute()?>"><?php the_post_thumbnail();?></a>
                <div>
                <h5><a class="box-title" href="<?php the_permalink() ?>"
                        title="<?php the_title_attribute()?>"><?php the_title()?></a></h5>
               
                <div class="excerpt"><?php the_excerpt()?></div>
                <div class="review-meta">
                    <?php post_rating_html()?>
                </div>
                <a class="readmore" href="<?php the_permalink() ?>" title="<?php the_title_attribute()?>"><?php _e('Show more', 'opalbeauty')?></a>
                </div>
            </div>
            <?php endwhile;?>
            <?php wp_reset_postdata();?>
            <?php endif;?>
        </div>
    </div>
    <h3 class="section-title"><?php _e('Plastic surgery clinic', 'opalbeauty')?> <a href="<?php echo get_term_link('plastic-surgery-clinic', 'type_beauty')?>" class="read-more"><?php _e('See all', 'opalbeauty')?></a></h3>
    <div class="list-post">
        <div class="post-box">
    
                <?php  
            $args = array(
                'post_type'    =>    'beauty',
                'posts_per_page' => 3,
                'orderby' => 'date',
                'order' => 'DESC',
                'ignore_sticky_posts' => false,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'type_beauty',
                        'field'    => 'slug',
                        'terms'    => 'plastic-surgery-clinic',
                    ),
                ),
            );

            // The Query
            $the_query = new WP_Query( $args );
            if ( $the_query->have_posts() ) :
                while ( $the_query->have_posts() ) : $the_query->the_post();?>
                <div class="post img-des">
                    <a class="thumb-full" href="<?php the_permalink() ?>"></a>
                    <div class="img"><a class="thumb-link" href="<?php the_permalink() ?>"
                            title="<?php the_title_attribute()?>"><?php the_post_thumbnail();?></a></div>
                    <div class="des">
                        <h5><a class="box-title" href="<?php the_permalink() ?>"
                                title="<?php the_title_attribute()?>"><?php the_title()?></a></h5>

                        <div class="excerpt"><?php the_field('beauty_address')?></div>

                        <div class="review-meta">
                        <img src="<?php theme_path('/assets/images/star-icon.svg') ?>"> <?php post_rating()?>/5
                        </div>
                       
                    </div>
                </div>
                <?php endwhile;?>
                <?php wp_reset_postdata();?>
                <?php endif;?>
     
        </div>
    </div>
    <h3 class="section-title"><?php _e('News', 'opalbeauty')?> <a href="<?php create_url('news')?>" class="read-more"><?php _e('See all', 'opalbeauty')?></a></h3>
    <div class="slider-section slider2 news-section">
        <div class="post-box2 owl-carousel">
        <?php  
            $args = array(
                'post_type'    =>    'post',
                'posts_per_page' => 3,
                'orderby' => 'date',
                'order' => 'DESC',
                'ignore_sticky_posts' => false,
            );

            // The Query
            $the_query = new WP_Query( $args );
            if ( $the_query->have_posts() ) :
                while ( $the_query->have_posts() ) : $the_query->the_post();?>
            <div class="post">
                <a class="thumb-link" href="<?php the_permalink() ?>"
                    title="<?php the_title_attribute()?>"><?php the_post_thumbnail();?></a>
                <div>
                <div class="meta-span">
                    <img src="<?php theme_path('/assets/images/calenda-white.svg') ?>">
                    <?php echo get_the_Date()?>
                </div>
                <h5><a class="box-title" href="<?php the_permalink() ?>"
                        title="<?php the_title_attribute()?>"><?php the_title()?></a></h5>
                </div>
            </div>
            <?php endwhile;?>
            <?php wp_reset_postdata();?>
            <?php endif;?>
        </div>
    </div>
</div>
<div class="overlay-element">
    <div class="top-element">
        <span class="back-main">
        <img src="<?php theme_path('/assets/images/arrow-left.svg') ?>">
        </span>
        <form onSubmit="return false" method="POST" class="searchform" id="<?php echo uniqid('s_');?>">
            <input type="text" class="search-input" name="s" id="<?php echo uniqid('s_');?>" value="<?php echo esc_attr(get_search_query());?>" placeholder="<?php esc_html_e( 'Search spa & clinic...', 'opalbeauty' ); ?>" />
        </form>
    </div>
    <div class="data-wrap">
        <div class="results"></div>
    </div>
</div>

<?php get_footer();?>
<!-- <script>
    (function($) {
    'use strict';
    $(document).ready(function () {
            /******************/
            var _reqAnimationSearch = window.requestAnimationFrame    ||
        window.mozRequestAnimationFrame     ||
        window.webkitRequestAnimationFrame  ||
        window.msRequestAnimationFrame      ||
        window.oRequestAnimationFrame       ;

        var _cancelAnimationFrameSearch = window.cancelAnimationFrame || window.mozCancelAnimationFrame;

        var start;
        var myReq;
        var searchElement;
        var strSearch;


        function delayRequestAnimationFrameSearch( timestamp ) {
            if (!start) start = timestamp;
            
            var progress = timestamp - start;

            if (progress < 500) {
                // it's important to update the requestId each time you're calling requestAnimationFrame
                myReq = _reqAnimationSearch(delayRequestAnimationFrameSearch);
            }else{
                searchKey(strSearch,searchElement);
            }

        }

        function delaySetimeOutSearch(element) {
            clearTimeout(start);
            start = setTimeout(function(){
                searchKey(strSearch, searchElement);
            }, 500);
        }

        function searchKey(str, $results){
          
            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php');?>',
                type: 'POST',
                data: {
                    action: 'search_beauty',
                    input: str
                }
            }) 
            .done(function(response) {
               console.log(response);

            })
            .fail(function(jqXHR, textStatus) {
                console.log(jqXHR, textStatus);
                alert('ERROR');
            })
            .always(function() {
                // btn_submit.removeClass('loading-btn');
                // btn_submit.prop('disabled', false);
            })
        }

        var $input = $('.search-input');
        $input.bind('keyup change paste propertychange', function() {
           
            var key = $(this).val()
            searchElement = $(this).closest('.searchform').next('.data-wrap');

            if(key.length > 0 ){
                strSearch = `s=${key}`;

                if(_reqAnimationSearch){
                    start = null;
                    _cancelAnimationFrameSearch(myReq);
                    _reqAnimationSearch(delayRequestAnimationFrameSearch);
                }
                else{
                    delaySetimeOutSearch(strSearch, searchElement);
                }
                
                searchElement.fadeIn();
            }else{
                searchElement.fadeOut();
            }
        })

        
    });
})(jQuery);
</script> -->
