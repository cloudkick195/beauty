<?php /* Template Name: Welcome  */ ?>
<?php get_header();?>
<main class="user-page welcome">
    <section class="banner">
        <?php the_post_thumbnail()?>
    </section>
    <section class="button-section wrap">
        <h1 class="main-title"><?php _e('Welcome to', 'opalbeauty');?> <img src="<?php theme_path('/assets/images/opal-logo.png') ?>" alt="opal logo"></h1>
        <p class="sub-title"><?php _e('Learn and share your beauty experience!', 'opalbeauty');?></p>
        <a class="btn-style full main-color" href="<?php create_url('login')?>"><?php _e('Log in', 'opalbeauty');?></a>
        <a class="btn-style full"  href="<?php create_url('register')?>"><?php _e('Sign up', 'opalbeauty');?></a>
    </section>
</main>
<?php
    get_template_part(
        'template-parts/overlay',
        'welcome'
    );
?>
<?php get_footer();?>