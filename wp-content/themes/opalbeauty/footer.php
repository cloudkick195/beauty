<footer>
    <!-- <div class="wrap">
    <ul class="menu-class">
        <li class="home-tab active"><a href="<?php create_url('')?>"><span></span>Home</a></li>
        <li class="event-tab"><a href="<?php create_url('events')?>"><span></span>Event</a></li>
        <li class="review-tab"><a href="<?php create_url('reviews')?>"><span></span>Review</a></li>
        <li class="question-tab"><a href="<?php create_url('questions')?>"><span></span>Question </a></li>
    </ul>
    </div> -->
</footer>
<div class="main-overlay"></div>
<?php wp_footer(); ?>
<?php if(is_user_logged_in() && (!is_admin())): ?>
    <script>
       
        jQuery("a").attr('href', function(index, item) {
            if(!jQuery(this).hasClass('back-action')){
                if (item.charAt(0) != "#") {
                    return item + (item.indexOf('?') != -1 ? "&appt=N" : "?appt=N");
                }
            }
            
        });
    </script>
<?php endif;?>
</body>
</html>