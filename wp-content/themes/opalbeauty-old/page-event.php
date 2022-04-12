<?php /* Template Name: My Events  */ ?>
<?php get_header();?>
<?php  
    $querys = user_event_register();
   
    // The Query
    $the_query = $querys['query'];
   
    $titleMyEvent = __('My events ', 'opalbeauty'). '('.$querys['count'].')';
?>
<?php header_page($titleMyEvent);?>
<div class="wrap wrap-result">
    <div class="post-box4 post-box4-event">
        <?php
            if ($the_query && $the_query->have_posts() ) :
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
                <a class="box-fullurl" href="<?php the_permalink() ?>"></a>
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
            
                <div class="registered"><span><?php echo $registeredCount?></span> <?php _e('Registered', 'opalbeauty')?></div>
                <h5><?php the_title()?></h5>
                <div class="excerpt"><?php the_field('event_veunue');?></div>
                <div class="by"><?php _e('Event by', 'opalbeauty')?> <strong><?php echo get_the_author_meta('display_name');?></strong></div>
                <a class="box-fullurl" href="<?php the_permalink() ?>"></a>
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