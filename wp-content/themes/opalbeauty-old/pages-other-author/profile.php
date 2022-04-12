<?php 
$countPost = $args['countPost'];
$user_id = $args['user_id'];
$user = get_userdata($user_id);
$user_author_current = get_userdata($user_id);
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
<main class="user-page wrap account-page">
    <div class="avatar-center">
        <span class="box-circle">
            <?php echo $img_avatar?>
        </span>
        <p><?php echo $user->display_name?></p>
    </div>
    <div class="nav-author-link flex-container">
        <a class="active" href="<?php echo get_author_posts_url($user_id)?>"><?php _e('Profile', 'opalbeauty');?></a>
        <a href="<?php echo get_author_posts_url($user_id)?>?post=review"><?php _e('Review', 'opalbeauty');?></a>
        <a href="<?php echo get_author_posts_url($user_id)?>?post=question"><?php _e('Question', 'opalbeauty');?></a>
        <a href="<?php echo get_author_posts_url($user_id)?>?post=event"><?php _e('Event', 'opalbeauty');?></a>
        
    </div>
    <div class="opal-forms opal-forms2">
       
        <div class="field">
            <label>
                <?php _e('User name', 'opalbeauty');?>
            </label>
            <div>
                <span class="not-field"><span><?php echo $user->display_name?></span></span>
            </div>
        </div>
        <div class="field">
            <label>
                <?php _e('Gender', 'opalbeauty');?>
            </label>
            <div>
                <span class="not-field"><span><?php echo get_field('user_gender', 'user_'.$user_id)?></span></span>
            </div>
        </div>
        <div class="field">
            <label>
                <?php _e('Age', 'opalbeauty');?>
            </label>
            <div>
                <span class="not-field"><span><?php echo get_field('user_age', 'user_'.$user_id)?></span></span>
            </div>
        </div>
        <?php if($user_author_current && $user_author_current->roles & $user_author_current->roles[0] == 'doctor'):?>
        <div class="field">
            <label>
                <?php _e('Study at', 'opalbeauty');?>
            </label>
            <div>
                <span class="not-field"><span><?php echo get_field('study_at', 'user_'.$user_id)?></span></span>
            </div>
        </div>
        <div class="field">
            <label>
                <?php _e('Experience', 'opalbeauty');?>
            </label>
            <div>
                <span class="not-field"><span><?php echo get_field('experience', 'user_'.$user_id)?></span></span>
            </div>
        </div>
        <div class="field">
            <label>
                <?php _e('Surgeries', 'opalbeauty');?>
            </label>
            <div>
                <span class="not-field"><span><?php echo get_field('experience', 'user_'.$user_id)?></span></span>
            </div>
        </div>
        <div class="field">
            <label>
                <?php _e('Specialist', 'opalbeauty');?>
            </label>
            <div>
                <span class="not-field not-field-list">
                    <?php $specialist = get_field('specialist', 'user_'.$user_id)?>
                    <?php foreach ($specialist as $value) {
                       echo $value . ' <span>|</span> ';
                    }?>
                </span>
            </div>
        </div>
        <div class="field">
            <label>
                <?php _e('Work at', 'opalbeauty');?>
            </label>
            <div>
                <span class="not-field"><span><?php echo get_field('work_at', 'user_'.$user_id)?></span></span>
            </div>
        </div>
        <?php 
            $img_certificated = '
                <img id="certificated-img" class="main certificated-img"
                    src="'.get_theme_path("/assets/images/stroke-icon.svg").'">
            ';
            $classM = '';
            $imgCertificated = get_field('certificated', 'user_'.$user_id);
            if($imgCertificated){
                $img_certificated = ' <img id="certificated-img" class="main certificated-img"
                src="'.$imgCertificated.'">';
                $classM = 'active';
            }
        ?>
        <div class="field image-field certificated text-center <?php echo $classM?>">
            <div class="box-full">
                <label class="text-center">
                    <span class="box-circle">
                        <?php echo $img_certificated;?>
                    </span>
                </label>
            </div>
        </div>
        <?php else:?>
        <?php
            $interested_in = get_field('interested_in', 'user_'.$user_id);
            $fieldSpecialist = field_specialist();
        ?>
        <div class="field checkbox-field not-field">
            <label><?php _e('Interested in', 'opalbeauty');?></label>
            <div>
                <?php 
                if(!empty($interested_in)):?>
                <?php foreach($interested_in as $value) :?>
                <label><?php echo $fieldSpecialist[$value]?>
                    <span class="checkmark"></span>
                </label>
                <?php endforeach ?>
                <?php endif ?>
            </div>
        </div>
        <?php endif;?>

    </div>
</main>

<?php get_footer();?>
