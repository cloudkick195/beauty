<?php get_header();?>
<?php  
    if (have_posts() ) :  the_post();?>
<?php header_thumb(get_the_post_thumbnail());?>
<div class="wrap">
    <div class="post">

        <h5><a class="box-title" href="<?php the_permalink() ?>"
                title="<?php the_title_attribute()?>"><?php the_title()?></a></h5>
        <div class="content-post"> <?php the_content()?></div>
        <div class="meta-span">
            <img src="<?php theme_path('/assets/images/calenda-black.svg') ?>">
            <?php echo get_the_Date()?>
        </div>

    </div>

</div>
<?php endif;?>
<?php get_footer();?>