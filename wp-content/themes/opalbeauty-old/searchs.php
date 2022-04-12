<?php get_header();?>
<div class="search-page">
    <div class="overlay-element">
        <div class="top-element">
            <a class="back-main" href="<?php create_url('')?>">
                <img src="<?php theme_path('/assets/images/arrow-left.svg') ?>">
            </a>
            <form class="searchform" id="<?php echo uniqid('s_');?>" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <input type="text" class="search-input" name="s" id="<?php echo uniqid('s_');?>" value="<?php echo esc_attr(get_search_query());?>" placeholder="<?php esc_html_e( 'Search spa & clinic...', 'opalbeauty' ); ?>" />
            </form>
        </div>
        <div class="data-wrap">
            <div class="results">
            <?php  
            if (have_posts() ) :
                while (have_posts() ) : the_post();?>
                <div class="post only-des">
                    <div class="des">
                        <h5><a class="box-title" href="<?php the_permalink();?>"><?php the_title();?></a></h5>
                        <div class="excerpt"><?php the_field('beauty_address');?></div>
                        <a class="arrow-link" href="<?php the_permalink();?>"></a>
                    </div>
                </div>
                <?php endwhile;?>
            <?php wp_reset_postdata();?>
            <?php endif;?>
            </div>
        </div>
    </div>
</div>
<?php get_footer();?>