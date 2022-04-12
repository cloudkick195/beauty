<?php /* Template Name: Notification  */ ?>
<?php get_header();?>
<?php header_page(__('Notification', 'opalbeauty'));?>

<div class="question-archive question-other-author notification-page">
    <div class="wrap-result">
        <div class="post-box">
            <?php  
            $datas = get_notification();
            
            // The Query
            if ($datas ) :
                foreach($datas as $data):?>
            <div class="post img-des">
                <?php 
                    $img_avatar = '
                        <img id="avatar-img" class="main avatar-img"
                            src="'.get_theme_path("/assets/images/user-icon.svg").'" alt="opal user icon">
                    ';
                   
                    if($data['image']){
                        $img_avatar = '<img id="avatar-img" class="main avatar-img active"
                        src="'.$data['image'].'" alt="opal user icon">';
                    }
                ?>
                <div class="img"><a class="thumb-link" href="<?php echo $data['image_link'] ?>"
                        title="<?php the_title_attribute()?>">
                        <?php echo $img_avatar?>
                    </a></div>
                <div class="des">
                    <h5><a class="box-title" href="<?php echo esc_url($data['link'])?>"><?php echo $data['title']?></a></h5>
                    <div class="excerpt"><?php echo $data['time']?></div>
                </div>
            </div>
            <?php endforeach;?>
            <?php endif;?>
        </div>
    </div>
</div>

<?php get_footer();?>