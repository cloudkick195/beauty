<?php get_header();
    $search_location = get_query_var( 'location' );?>
<?php $user_id = get_current_user_id()?>
<form method="get" id="filter-events" class="opal-forms3">
    <div class="top-element">
        <button type="submit" class="prev-action"><img src="<?php theme_path('/assets/images/search-icon.svg') ?>"></button>
        <input type="text" class="search-input" name="s" id="<?php echo uniqid('s_');?>"
            value="<?php echo esc_attr(get_search_query());?>"
            placeholder="<?php esc_html_e( 'Search event...', 'opalbeauty' ); ?>" />
        <a class="next-action notification-number" href="<?php create_url('notification')?>">
            <img src="<?php theme_path('/assets/images/notification.svg')?>">
            <?php $notification_val = get_field('user_notification', 'user_'.$user_id);?>
            <?php if($notification_val == true):?>
            <span class="number-notification"><?php echo count_unread_notification();?></span>
            <?php endif?>
        </a>
    </div>
    <div class="wrap wrap-form">
        <div class="field checkbox-field field_service">
            <div class="slick-carousel">
                <?php 
                 foreach(field_service() as $key => $value) { ?>
                <label>
                    <input type="radio" onchange="this.form.submit()" name="field_service[]" value="<?php echo $key ?>" <?php echo $value['1']?>>
                    <span class="checkmark"><?php echo $value['0']?></span>
                </label>
                <?php } ?>
            </div>
        </div>
        <div class="wrap-selects">
            <div class="custom-select cl1 <?php echo (!empty($search_location) ? '':'default-select')?>">
                <select name="location" onchange="this.form.submit()">
                    <option value="" selected><?php _e('Location', 'opalbeauty');?></option>
                    <?php
                        $taxonomies = get_terms( array(
                            'taxonomy' => 'location'
                        ) );
                        
                        if ( !empty($taxonomies) ) :
                            foreach( $taxonomies as $category ) :
                            $slug = esc_attr( $category->slug );
                        ?>
                    <option value="<?php echo $slug?>" <?php echo $search_location == $slug ? 'selected' : ''?>>
                        <?php echo esc_html( $category->name ) ?></option>
                    <?php 
                            endforeach;
                        endif;
                    ?>
                </select>
                <img src="<?php theme_path('/assets/images/location-green.svg')?>">
            </div>
            <div class="cusom-datepicker">
                <input autocomplete="off" type="text"  onchange="this.form.submit()" name="d" data-toggle="datepicker" placeholder="<?php _e('Date', 'opalbeauty');?>">
                <img src="<?php theme_path('/assets/images/notebook-icon.svg')?>">
               
            </div>
        </div>
        <p class="cleared"></p>
    </div>
    
</form>
<div class="wrap wrap-result">
    <div class="post-box4">
        <?php  
            // The Query
            $arrLiked = getCookieEventLiked('event_liked'.$user_id);
            if (have_posts() ) :
                while ( have_posts() ) : the_post();
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
                <img class="sub-thumb" src="<?php theme_path('/assets/images/doctor-img.png')?>">
                <div class="head-info">
                    <h5><a class="box-title" href="<?php the_permalink() ?>"
                            title="<?php the_title_attribute()?>"><div><?php the_field('event_sub_title');?></div><?php the_title()?></a></h5>
                    <div class="info">
                        <span><img src="<?php theme_path('/assets/images/clock-pink.svg')?>">
                            <?php the_field('event_date_time');?></span>
                        <span class="address"><img
                                src="<?php theme_path('/assets/images/location-pink.svg')?>">
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
<span class="clear-btn clear-btn-hide"><?php _e('Clear', 'opalbeauty');?></span>
<script>
    jQuery(document).ready(function() {
        jQuery('[data-toggle="datepicker"]').datepicker({
            template: '<div class="datepicker-container">' + '<div class="datepicker-panel" data-view="years picker">' + '<ul>' + '<li data-view="years prev">&lsaquo;</li>' + '<li data-view="years current"></li>' + '<li data-view="years next">&rsaquo;</li>' + '</ul>' + '<ul data-view="years"></ul>' + '</div>' + '<div class="datepicker-panel" data-view="months picker">' + '<ul>' + '<li data-view="year prev">&lsaquo;</li>' + '<li data-view="year current"></li>' + '<li data-view="year next">&rsaquo;</li>' + '</ul>' + '<ul data-view="months"></ul>' + '</div>' + '<div class="datepicker-panel" data-view="days picker">' + '<ul>' + '<li data-view="month prev">&lsaquo;</li>' + '<li data-view="month current"></li>' + '<li data-view="month next">&rsaquo;</li>' + '</ul>' + '<ul data-view="week"></ul>' + '<ul data-view="days"></ul>' + '</div>' + '<span class="clear-btn-datepicker">Clear</span></div>',
        });
       
        jQuery('.cusom-datepicker input').click('click', function(e){
            var offsetBtn = jQuery('.datepicker-container .clear-btn-datepicker').offset();
            jQuery('.clear-btn').css({
                'top': offsetBtn.top,
                'left': offsetBtn.left
            });
            jQuery('.clear-btn').removeClass('clear-btn-hide');
            
        });

        jQuery('body').on('click', function() {
            setTimeout(function(){
                if(jQuery('.datepicker-container').hasClass('datepicker-hide')){
                    jQuery('.clear-btn').addClass('clear-btn-hide');
                }
            }, 100);
        });
        
        jQuery('.clear-btn').click(function(e){
            e.preventDefault();
            jQuery( "#filter-events" ).submit();
        });
        
        jQuery('.icon-stick-box').click(function() {
            var parentBox = jQuery(this).closest('.post');

            parentBox.find('.icon-stick-box').removeClass('active');
            parentBox.find('.icon-stick-box').addClass('active');
            jQuery(this).removeClass('active');
            var cookieName = "event_liked<?php echo $user_id?>";
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
    


var x, i, j, l, ll, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("custom-select");
l = x.length;

if (l > 0) {
    for (i = 0; i < l; i++) {
        selElmnt = x[i].getElementsByTagName("select")[0];
        ll = selElmnt.length;
        /*for each element, create a new DIV that will act as the selected item:*/
        a = document.createElement("DIV");

        a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
        a.setAttribute("class", "select-selected s" + selElmnt.options[selElmnt.selectedIndex].value);

        x[i].appendChild(a);
        /*for each element, create a new DIV that will contain the option list:*/
        b = document.createElement("DIV");
        b.setAttribute("class", "select-items select-hide");
        for (j = 0; j < ll; j++) {
            /*for each option in the original select element,
            create a new DIV that will act as an option item:*/
            c = document.createElement("DIV");
            c.innerHTML = selElmnt.options[j].innerHTML;
            c.setAttribute('select-id', 's' + selElmnt.options[j].value)
            c.addEventListener("click", function(e) {
                /*when an item is clicked, update the original select box,
                and the selected item:*/
                var y, i, k, s, h, sl, yl;
                s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                sl = s.length;
                h = this.parentNode.previousSibling;
                for (i = 0; i < sl; i++) {
                    if (s.options[i].innerHTML == this.innerHTML) {
                        s.selectedIndex = i;
                        h.innerHTML = this.innerHTML;
                        h.classList.value = 'select-selected';
                        h.classList.add(this.getAttribute('select-id'));

                        y = this.parentNode.getElementsByClassName("same-as-selected");
                        yl = y.length;
                        for (k = 0; k < yl; k++) {
                            y[k].removeAttribute("class");
                        }
                        this.setAttribute("class", "same-as-selected");
                        document.getElementById("filter-events").submit();

                        break;
                    }
                }
                h.click();
            });
            b.appendChild(c);
        }
        x[i].appendChild(b);
        a.addEventListener("click", function(e) {
            /*when the select box is clicked, close any other select boxes,
            and open/close the current select box:*/
            e.stopPropagation();
            closeAllSelect(this);
            this.nextSibling.classList.toggle("select-hide");
            this.classList.toggle("select-arrow-active");
        });
    }
}

function closeAllSelect(elmnt) {
    /*a function that will close all select boxes in the document,
    except the current select box:*/
    var x, y, i, xl, yl, arrNo = [];
    x = document.getElementsByClassName("select-items");
    y = document.getElementsByClassName("select-selected");
    xl = x.length;
    yl = y.length;
    for (i = 0; i < yl; i++) {
        if (elmnt == y[i]) {
            arrNo.push(i)
        } else {
            y[i].classList.remove("select-arrow-active");
        }
    }
    for (i = 0; i < xl; i++) {
        if (arrNo.indexOf(i)) {
            x[i].classList.add("select-hide");
        }
    }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);
</script>