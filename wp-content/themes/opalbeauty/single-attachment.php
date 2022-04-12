<?php get_header();?>
<?php  
    if (have_posts() ) :  the_post();?>
<?php header_thumb('');?>
<div class="wrap attachment-page">
<?php echo wp_get_attachment_image( get_the_ID(), 'full' ); ?>
</div>
<?php endif;?>
<?php get_footer();?>