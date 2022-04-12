<?php 
$countPost = $args['countPost'];
$user_id = $args['user_id'];
$user = get_userdata($user_id);
$user_author_current = get_userdata($user_id);
$ss = get_query_var('author');
$user_current_id = get_current_user_id();
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
    <div class="author-header-fixed">
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
    </div>
    <div class="post-box4 post-box4-event">
        <?php
            $querys = user_event_register($user_id);
   
            // The Query
            $the_query = $querys['query'];
            $arrLiked = getCookieEventLiked('event_liked'.$user_current_id);
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
               
                $eventId = get_the_ID();
              
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
               
               
                $user_id = get_current_user_id();
                if(get_field('event_users_register') && isset(get_field('event_users_register')[0])){
                    $registeredCount = count($fieldRegistered);
                   
                }

            ?>
            <div class="des">
                <div class="registered"><span><?php echo $registeredCount?></span> <?php _e('Registered', 'opalbeauty');?></div>
                <h5><span><?php the_field('event_sub_title');?></span>: <?php the_title()?></h5>
                <div class="excerpt"><?php the_field('event_veunue');?></div>
                <div class="by"><?php _e('Event by', 'opalbeauty');?> <strong><?php echo get_the_author_meta('display_name');?></strong></div>
                <a class="box-fullurl" href="<?php the_permalink() ?>"></a>
            </div>
            <?php if(checkEventLiked($arrLiked, $eventId)):?>
                <img class="icon-stick-box" data-id="<?php echo $eventId;?>" src="<?php theme_path('/assets/images/heart-icon.svg')?>">
                <img class="icon-stick-box active" data-id="<?php echo $eventId;?>" src="<?php theme_path('/assets/images/heart-active.svg')?>">
            <?php else:?>
                <img class="icon-stick-box active" data-id="<?php echo $eventId;?>" src="<?php theme_path('/assets/images/heart-icon.svg')?>">
                <img class="icon-stick-box" data-id="<?php echo $eventId;?>" src="<?php theme_path('/assets/images/heart-active.svg')?>">
            <?php endif;?>
        </div>
        <?php endwhile;?>
        <?php wp_reset_postdata();?>
        <?php endif;?>
    </div>
</div>
<?php get_footer();?>
<script>
    jQuery(document).ready(function() {
        jQuery('.icon-stick-box').click(function() {
            var parentBox = jQuery(this).closest('.post');

            parentBox.find('.icon-stick-box').removeClass('active');
            parentBox.find('.icon-stick-box').addClass('active');
            jQuery(this).removeClass('active');
            var cookieName = "event_liked<?php echo $user_current_id;?>";
            var event_liked = [];
            var new_event_liked = [];
            var box_id = jQuery(this).data('id');
            var checkHaved = false;
            if(getCookie(cookieName)){
                event_liked = getCookie(cookieName).split(",");
               
               
                if(!event_liked){
                    event_liked = [box_id];
                }else{
                    jQuery.each(event_liked, function(index, item) {
                        if(!item) return;
                        if(box_id == item){
                            checkHaved = true;
                            return;
                        }
                        
                        new_event_liked.push(item);
                    });
                    if(!checkHaved){
                        new_event_liked.push(box_id);
                    }
                }
                
                
            }else{
                new_event_liked.push(box_id);
            }
           
            setCookie(cookieName, new_event_liked.toString(),1000);
        });
    });
</script>