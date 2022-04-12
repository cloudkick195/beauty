<?php get_header();?>
<?php header_page(get_the_title());?>
<div class="single-container">
    <div class="post-top">
        <div class="post-thumb">
            <?php echo wp_get_attachment_image( get_field('beauty_logo'), 'full' )?></a>
        </div>

    </div>

    <section class="wrap info-section">
        <div class="review-meta">
            <a href="#review">
                <?php 
                $p_rate = get_post_rating();
                if($p_rate) :?>
                    <?php echo $p_rate?>/5 </span>
                <?php else:?>
                    <span class="no-reviews"><?php _e('No reviews yet', 'opalbeauty');?></span>
                <?php endif;?>
            <img src="<?php theme_path('/assets/images/full-star.svg') ?>"></a>
        </div>
        <div class="info-contact">
            <p>
                <img src="<?php theme_path('/assets/images/phone-icon.svg') ?>">
                <a class="call-overlay" href="tel:<?php the_field('beauty_phone');?>"><?php the_field('beauty_phone');?></a>
            </p>
            <p>
                <img src="<?php theme_path('/assets/images/home-icon.svg') ?>">
                <?php the_field('beauty_site');?>
            </p>
            <p>
                <img src="<?php theme_path('/assets/images/location-icon.svg') ?>">
                <?php the_field('beauty_address');?>
            </p>
        </div>
        <div class="content">
            <?php the_content();?>
        </div>
    </section>
    <section class="wrap services-section limit-row">
        <h3 class="single-section-title"><?php _e('SERVICES', 'opalbeauty')?></h3>
        <div class="content">
            <?php the_field('beauty_services');?>
        </div>
        <a href="#" data-title="<?php _e('SERVICES', 'opalbeauty')?>" class="see-all btn-style full"><?php _e('See all', 'opalbeauty')?></a>
    </section>
    <section class="wrap slider-section limit-row doctor-team-section">
        <h3 class="single-section-title"><?php _e("DOCTOR'S TEAM", 'opalbeauty')?></h3>
        <div class="post-box1 owl-carousel">
            <?php

            $featured_posts = get_field('beauty_doctors');
            if( $featured_posts ): ?>
            <?php 
                ob_start();
                foreach( $featured_posts as $post ): 

                    // Setup this post for WP functions (variable must be named $post).
                    setup_postdata($post); ?>
            <div class="post" data-id="<?php the_ID()?>" data-title="<?php the_title()?>">
                <a class="thumb-link" href="<?php the_permalink() ?>"
                    title="<?php the_title_attribute()?>"><?php the_post_thumbnail();?></a>
                <div>
                    <h5><a class="box-title" href="<?php the_permalink() ?>"
                            title="<?php the_title_attribute()?>"><?php the_title()?></a></h5>

                    <div class="excerpt">
                        <?php the_field('doctor_beauty_des')?>
                        <div class="detail-content content">
                            <?php the_content()?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php 
                
                // Reset the global post object so that the rest of the page works correctly.
                wp_reset_postdata(); 
                $result = ob_get_clean();?>
            <?php endif; ?>
            <?php echo $result;?>
        </div>
        <div class="post-box1 duplicate box-action">
            <?php echo $result;?>
        </div>
        <a href="#" data-title="<?php _e("DOCTOR'S TEAM", 'opalbeauty')?>" class="see-all btn-style full"><?php _e('See all', 'opalbeauty')?></a>
    </section>
    <section class="wrap gallery-section limit-row">
        <h3 class="single-section-title"><?php _e('Gallery', 'opalbeauty')?></h3>
        <div class="content">
            <?php the_field('beauty_gallery');?>
        </div>
        <a data-title="<?php _e("Gallery", 'opalbeauty')?>" href="#" class="see-all btn-style full"><?php _e('See all', 'opalbeauty')?></a>
    </section>
    <section class="wrap branch-section limit-row">
        <h3 class="single-section-title"><?php _e('Branch', 'opalbeauty')?></h3>
        <div class="content">
            <?php the_field('beauty_branch');?>
        </div>
        <a href="#" data-title="<?php _e("Branch", 'opalbeauty')?>" class="see-all btn-style full"><?php _e('See all', 'opalbeauty')?></a>
    </section>
    <section id="review" class="wrap review-section">
        <h3 class="single-section-title"><?php _e('Review', 'opalbeauty')?> <span class="review-meta"><?php post_rating()?>/5 <img
                    src="<?php theme_path('/assets/images/full-star.svg') ?>"></span></h3>
        <div class="add-review">
            <a data-title="<?php _e('Add a review', 'opalbeauty')?>" class="overlay-btn" href="#"><img
                    src="<?php theme_path('/assets/images/plus-icon.svg') ?>"> <?php _e('Add a review', 'opalbeauty')?></a>
        </div>
        <div class="limit-row">
            <div><?php  comments_template();?></div>
            <a href="#" data-title="<?php _e('Review', 'opalbeauty')?>" class="see-all btn-style full"><?php _e('See all', 'opalbeauty')?></a>
        </div>
    </section>
    <div class="overlay-element">
        <div class="top-element">
            <span class="back-main">
                <img src="<?php theme_path('/assets/images/arrow-left.svg') ?>">
            </span>
            <h2></h2>
        </div>
        <div class="data-wrap">
            <div class="results"></div>
        </div>
    </div>
    <div class="overlay-element-child">
        <div class="top-element">
            <span class="back-main">
                <img src="<?php theme_path('/assets/images/arrow-left.svg') ?>">
            </span>
            <h2></h2>
        </div>
        <div class="data-wrap">
            <div class="results"></div>
        </div>
    </div>
    <div class="overlay-black">
        <div class="bottom-overlay">
            <a class="back-action" href="tel:<?php the_field('beauty_phone');?>"><img src="<?php theme_path('/assets/images/phone-call.svg') ?>"> <?php the_field('beauty_phone');?></a>
            <a href="#" class="cancel-btn ">
                <?php _e('Cancel', 'opalbeauty')?>
            </a>      
        </div>    
    </div>
</div>

<?php get_footer();?>
<script>
    jQuery(document).ready(function() {
       
        jQuery(".share-white-action").click(function(e) {
            e.preventDefault();
            window.appBridge.getLatitude();
        });
        
    });
</script>
