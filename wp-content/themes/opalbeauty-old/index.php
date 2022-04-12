<?php get_header();?>
<?php header_page('News');?>
<div class="wrap">
<div class="post-box2">
    <?php  
        if (have_posts() ) :
                while (have_posts() ) : the_post();?>
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
    <?php 
    global $wp_query;
    if($wp_query->max_num_pages > 1):?>
    <div class='pagination'>
        <?php opalbeauty_paginate_links($wp_query)?>
    </div>
    <?php endif;?>
</div>
</div>
<?php get_footer();?>