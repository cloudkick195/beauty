<?php get_header();?>
<?php header_page(single_term_title( "", false));
    $search_location = get_query_var( 'location' );
    $search_rate = get_query_var( 'rate' );
?>

<div class="wrap taxonomy-page">
    <form method="GET" id="filter-type_beauty" class="filter-form">
        <div class="custom-select">
            <select name="location" onchange="this.form.submit()" data-text="<?php echo empty($search_location) ? __('Location', 'opalbeauty') : ''?>">
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
        </div>
        <div class="custom-select bg-rating">
            <select name="rate" onchange="this.form.submit()" data-text="<?php echo empty($search_rate) ? __('Rate', 'opalbeauty') : ''?>">
                <option class="s5" value="5" <?php echo $search_rate == '5' ? 'selected' : ''?>>5</option>
                <option class="s4" value="4" <?php echo $search_rate == '4' ? 'selected' : ''?>>4</option>
                <option class="s3" value="3" <?php echo $search_rate == '3' ? 'selected' : ''?>>3</option>
                <option class="s2" value="2" <?php echo $search_rate == '2' ? 'selected' : ''?>>2</option>
                <option class="s1" value="1" <?php echo $search_rate == '1' ? 'selected' : ''?>>1</option>
            </select>
        </div>
        <div class="cleared"></div>
    </form>

    <script>
   
    </script>
    <?php if(get_query_var('type_beauty') == 'skin-spa'):?>
    <div class="post-box1">
        <?php if(have_posts()):?>
        <?php while ( have_posts() ) : the_post(); ?>
        <div class="post">
            <a class="thumb-link" href="<?php the_permalink() ?>"
                title="<?php the_title_attribute()?>"><?php the_post_thumbnail();?></a>
            <div>
                <h5><a class="box-title" href="<?php the_permalink() ?>"
                        title="<?php the_title_attribute()?>"><?php the_title()?></a></h5>

                <div class="excerpt"><?php the_excerpt()?></div>
                <div class="review-meta">

                    <?php post_rating_html()?>
                </div>
                <a class="readmore" href="<?php the_permalink() ?>" title="<?php the_title_attribute()?>"><?php _e('Show more', 'opalbeauty')?></a>
            </div>
        </div>
        <?php endwhile?>
        <?php else:?>
        <div class="post">
            <h5 class="box-title"><?php _e('There are no', 'opalbeauty')?> <?php single_term_title()?></h5>
        </div>
        <?php endif?>
    </div>
    <?php else:?>
    <div class="post-box">
        <?php if(have_posts()):?>
        <?php while ( have_posts() ) : the_post(); ?>
        <div class="post img-des">
            <div class="img"><a class="thumb-link" href="<?php the_permalink() ?>"
                    title="<?php the_title_attribute()?>"><?php the_post_thumbnail();?></a></div>
            <div class="des">
                <h5><a class="box-title" href="<?php the_permalink() ?>"
                        title="<?php the_title_attribute()?>"><?php the_title()?></a></h5>

                <div class="excerpt"><?php the_field('beauty_address')?></div>

                <div class="review-meta">
                    <img src="<?php theme_path('/assets/images/star-icon.svg') ?>"> <?php post_rating()?>/5
                </div>

            </div>
        </div>
        <?php endwhile?>
        <?php else:?>
        <div class="post">
            <h5 class="box-title"><?php _e('There are no', 'opalbeauty')?> <?php single_term_title()?></h5>
        </div>
        <?php endif?>
    </div>
    <?php endif?>
    <?php 
    global $wp_query;
    if($wp_query->max_num_pages > 1):?>
    <div class='pagination'>
        <?php opalbeauty_paginate_links($wp_query)?>
    </div>
    <?php endif;?>
</div>
<?php get_footer();?>
<script>   var x, i, j, l, ll, selElmnt, a, b, c;
        /*look for any elements with the class "custom-select":*/
        x = document.getElementsByClassName("custom-select");
        l = x.length;
      
        if(l > 0){
            for (i = 0; i < l; i++) {
                selElmnt = x[i].getElementsByTagName("select")[0];
                ll = selElmnt.length;
                /*for each element, create a new DIV that will act as the selected item:*/
                a = document.createElement("DIV");
                
                if(!selElmnt.dataset.text){
                    a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
                    a.setAttribute("class", "select-selected s" + selElmnt.options[selElmnt.selectedIndex].value);
                }else{
                    a.innerHTML = selElmnt.dataset.text;
                    a.setAttribute("class", "select-selected");
                }
                
                console.log(2, selElmnt.dataset.text);
               
        
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
                                document.getElementById("filter-type_beauty").submit();
        
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
        document.addEventListener("click", closeAllSelect);</script>