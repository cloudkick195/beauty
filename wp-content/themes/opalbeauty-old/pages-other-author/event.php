<?php 
$countPost = $args['countPost'];
$user_id = $args['user_id'];
$user = get_userdata($user_id);
$user_author_current = get_userdata($user_id);
$ss = get_query_var('author');
?>

<?php get_header();?>
<?php header_author();?>
<?php 

    $img_avatar = '
        <img id="avatar-img" class="main avatar-img"
            src="'.get_theme_path("/assets/images/user-icon.svg").'" alt="opal user icon">
    ';
    $fieldAvatar = get_field('user_avatar', 'user_'.$user_id);
    if($fieldAvatar){
        $img_avatar = '<img id="avatar-img" class="main avatar-img active"
        src="'.$fieldAvatar.'" alt="opal user icon">';
    }
?>
<div class="wrap wrap-result">
    <div class="avatar-center">
        <span class="box-circle">
            <?php echo $img_avatar?>
        </span>
        <p><?php echo $user->display_name?></p>
    </div>
    <div class="nav-author-link flex-container">
        <a href="<?php echo get_author_posts_url($user_id)?>"><?php _e('Profile', 'opalbeauty');?></a>
        <a href="<?php echo get_author_posts_url($user_id)?>?post=review"><?php _e('Review', 'opalbeauty');?></a>
        <a href="<?php echo get_author_posts_url($user_id)?>?post=question"><?php _e('Question', 'opalbeauty');?></a>
        <a class="active" href="<?php echo get_author_posts_url($user_id)?>?post=event"><?php _e('Event', 'opalbeauty');?></a>
        
    </div>
    <div class="post-box4 post-box4-event">
        <?php
            $querys = user_event_register($user_id);
   
            // The Query
            $the_query = $querys['query'];
            if ($the_query->have_posts() ) :
                while ( $the_query->have_posts() ) : $the_query->the_post();
                $price = 'Free';
                if(!get_field('event_ticket_free')){
                    $price = get_field('event_ticket_price');
                }
               
                $date = get_field('event_date_time');
                if($date){
                    $date =  str_replace("sáng", "am", $date);
                    $date =  str_replace("chiều", "pm", $date);  
                    $dateCheck = DateTime::createFromFormat('d/m/Y g:i a',$date);
                    if($dateCheck->format('d/m/Y') == date("d/m/Y") ){
                        $date = __('Today ', 'opalbeauty').$dateCheck->format('H:i:s A');
                    }
                }
               
              
                ?>
        <div class="post">
            <div class="post-head">
            <?php the_post_thumbnail('', array( 'class' => 'sub-thumb' )) ?>
                <div class="head-info">
                    <h5><a class="box-title" href="<?php the_permalink() ?>" title="<?php the_title_attribute()?>">
                            <?php the_title()?>
                        </a></h5>
                    <div class="info">
                        <span><img src="<?php theme_path('/assets/images/clock-pink.svg')?>">
                            <?php the_field('event_date_time');?></span>
                        <span class="address"><img src="<?php theme_path('/assets/images/location-pink.svg')?>">
                            <?php the_field('event_veunue');?></span>
                        <div class="cleared"></div>
                    </div>
                </div>
                <div class="meta">
                    <div class="time"><?php echo  $date?></div>
                    <div class="price"><?php echo $price?></div>
                    <div class="cleared"></div>
                </div>
            </div>
            <?php 
                $fieldRegistered = get_field('event_users_register');
                $registeredCount = 0;
                $checkRegister = false;
                $authorIds = [];
                $user_id = get_current_user_id();
                if(get_field('event_users_register') && isset(get_field('event_users_register')[0])){
                    $registeredCount = count($fieldRegistered);
                
                    foreach ( $fieldRegistered as $frVal ){
                        $authorIds[$frVal->post_author] = $frVal;
                    } 
                }
                if(isset($authorIds[$user_id])){
                    $checkRegister = true;
                }
                
            ?>
            <div class="des">
                <div class="registered"><span><?php echo $registeredCount?></span> <?php _e('Registered', 'opalbeauty');?></div>
                <h5><?php the_title()?></h5>
                <div class="excerpt"><?php the_field('event_veunue');?></div>
                <div class="by"><?php _e('Event by', 'opalbeauty');?> <strong><?php echo get_the_author_meta('display_name');?></strong></div>
            </div>
            <?php if(!$checkRegister):?>
            <img class="icon-stick-box" src="<?php theme_path('/assets/images/heart-icon.svg')?>">
            <?php else:?>
            <img class="icon-stick-box" src="<?php theme_path('/assets/images/heart-active.svg')?>">
            <?php endif;?>
        </div>
        <?php endwhile;?>
        <?php wp_reset_postdata();?>
        <?php endif;?>
    </div>
</div>
<?php get_footer();?>