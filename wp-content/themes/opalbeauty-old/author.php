<?php  $user_id = get_current_user_id();?>
<?php $authorPage = get_query_var('post');
global $wp_query;
$countPost = $wp_query->found_posts; 
$user_current_page = get_query_var('author');
?>
<?php if($user_current_page == $user_id):?>
<?php if($authorPage == 'question'):?>
<?php
    get_template_part(
        'pages-author/question',
        null,
        array(
            'countPost'   => $countPost,
            'user_id'  => $user_current_page
        )
    );
?>
<?php elseif($authorPage == 'review'):?>
<?php
    get_template_part(
        'pages-author/review',
        null,
        array(
            'countPost'   => $countPost,
            'user_id'  => $user_current_page
        )
    );
?>
<?php else:?>
<?php
    get_template_part(
        'pages-author/question',
        null,
        array(
            'countPost'   => $countPost,
            'user_id'  => $user_current_page
        )
    );
?>

<?php endif;?>
<?php else:?>
    <?php if($authorPage == 'question'):?>
    <?php
        get_template_part(
            'pages-other-author/question',
            null,
            array(
                'countPost'   => $countPost,
                'user_id'  => $user_current_page
            )
        );
    ?>
    <?php elseif($authorPage == 'review'):?>
    <?php
        get_template_part(
            'pages-other-author/review',
            null,
            array(
                'countPost'   => $countPost,
                'user_id'  => $user_current_page
            )
        );
    ?>
    <?php elseif($authorPage == 'event'):?>
    <?php
        get_template_part(
            'pages-other-author/event',
            null,
            array(
                'countPost'   => $countPost,
                'user_id'  => $user_current_page
            )
        );
    ?>
    <?php else:?>
        <?php
        get_template_part(
            'pages-other-author/profile',
            null,
            array(
                'countPost'   => $countPost,
                'user_id'  => $user_current_page
            )
        );
    ?>
    <?php endif;?>
<?php endif;?>