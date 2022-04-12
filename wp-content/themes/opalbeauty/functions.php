<?php
//Config directory
define('opalbeauty_THEME_PATH', get_template_directory() . '/');

define('FB_APP_ID', '680819409600688');
define('FB_APP_SECRET', '33226714a7ebc15e3befb27319d50a32');
define('ZALO_APP_ID', '3327226006414298172');
define('ZALO_APP_SECRET', 'FSjj1Kh51Y5j5UgGYH6s');
define('GOOGLE_WEBCLIENT_ID', '50221981601-cjinaka29ar4f7nqfv0t7e51mlibrdpg.apps.googleusercontent.com');
define('GOOGLE_SECRET', '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');
define('opalbeauty_NONCE_KEY', 'opal892278');

define('NOTIFICATION', [
    'love_question' => ['love_question', __('love your question.', 'opalbeauty')],
    'answered_question' => ['answered_question', __('answered your question.', 'opalbeauty')],
    'reply_comment_question' => ['reply_comment_question', __('reply to your comment.', 'opalbeauty')],
    'love_review' => ['love_review', __('love your review.', 'opalbeauty')],
    'commented_review' => ['commented_review', __('commented your review.', 'opalbeauty')],
    'reply_comment_review' => ['reply_comment_review', __('Reply to your comment.', 'opalbeauty')],
    'registered_event' => ['registered_event', __('registered your event.', 'opalbeauty')],
    'added_event' => ['added_event', __('added a new event.', 'opalbeauty')],
    'posted_review' => ['posted_review', __('posted a new review.', 'opalbeauty')],
    'posted_question' => ['posted_question', __('posted a new question.', 'opalbeauty')],
    'update_new_spa' => ['update_new_spa', __("Update new spa.Let's explore it.", 'opalbeauty')],
    'event_deleted' => ['event_deleted', __('The registered event has been deleted.', 'opalbeauty')],
    'update_event' => ['update_event', __("Update the registered event. Check's it.", 'opalbeauty')],
    'refuse_doctor' => ['refuse_doctor', __('Refuse your request. Check your credentials.', 'opalbeauty')],
    'approved_doctor' => ['approved_doctor', __('Congratulation. Check your credentials.', 'opalbeauty')]
]);



include(opalbeauty_THEME_PATH.'config-facebook.php');

add_action ( 'after_setup_theme', 'opalbeauty_theme_setups' );
function opalbeauty_theme_setups(){

    load_theme_textdomain('opalbeauty',get_template_directory() . '/languages');

    //RSS Feed links
    add_theme_support( 'automatic-feed-links' );

    //post thumbnail
    add_theme_support('post-thumbnails');

    //Title tag
    add_theme_support( 'title-tag' );
	
	// set_post_thumbnail_size( 807, 9999); //defaul blog thumb
    // add_image_size( ' opalbeauty-thumb', 400, 400,true );  //vertical blog thumb 
}   

function arr_notification(){
    return [
        'love_question' => ['love_question', __('love your question.', 'opalbeauty')],
        'answered_question' => ['answered_question', __('answered your question.', 'opalbeauty')],
        'reply_comment_question' => ['reply_comment_question', __('Reply to your comment.', 'opalbeauty')],
        'love_review' => ['love_review', __('love your review.', 'opalbeauty')],
        'commented_review' => ['commented_review', __('commented your review.', 'opalbeauty')],
        'reply_comment_review' => ['reply_comment_review', __('Reply to your comment.', 'opalbeauty')],
        'registered_event' => ['registered_event', __('registered your event.', 'opalbeauty')],
        'added_event' => ['added_event', __('added a new event.', 'opalbeauty')],
        'posted_review' => ['posted_review', __('posted a new review.', 'opalbeauty')],
        'posted_question' => ['posted_question', __('posted a new question.', 'opalbeauty')],
        'update_new_spa' => ['update_new_spa', __("Update new spa.Let's explore it.", 'opalbeauty')],
        'event_deleted' => ['event_deleted', __('The registered event has been deleted.', 'opalbeauty')],
        'update_event' => ['update_event', __("Update the registered event. Check's it.", 'opalbeauty')],
        'refuse_doctor' => ['refuse_doctor', __('Refuse your request. Check your credentials.', 'opalbeauty')],
        'approved_doctor' => ['approved_doctor', __('Congratulation. Check your credentials.', 'opalbeauty')]
    ];
}

add_action('wp_enqueue_scripts','opalbeauty_load_frontend');
function opalbeauty_load_frontend(){
    wp_enqueue_style( 'owl.carousel.min.css', get_template_directory_uri() .'/assets/OwlCarousel2-2.3.4/assets/owl.carousel.min.css' );
    wp_enqueue_style( 'slick-slider', get_template_directory_uri() .'/assets/slick/slick.css');

    wp_enqueue_style( 'datepicker.css', get_template_directory_uri() .'/assets/datepicker/datepicker.css' );
    wp_enqueue_script( 'owl.carousel.min.js' ,get_template_directory_uri() .'/assets/OwlCarousel2-2.3.4/owl.carousel.min.js',array('jquery'),false,true);
    wp_enqueue_script( 'slick.min.js' ,get_template_directory_uri() .'/assets/slick/slick.min.js',array('jquery'),false,true);
    wp_enqueue_style( 'style.css', get_template_directory_uri() .'/style.css' );


    wp_enqueue_script( 'datepicker.min.js' ,get_template_directory_uri() .'/assets/datepicker/datepicker.min.js',array('jquery'),false,true);
    wp_enqueue_script( 'main-scripts.js' ,get_template_directory_uri() .'/assets/js/main-scripts.js',array('jquery'),false,true);
    wp_localize_script( 'main-scripts.js', 'frontend_ajax_object',
        array( 
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
        )
    );


}

function wpse23007_redirect(){
    if( is_admin() && !defined('DOING_AJAX') && ( current_user_can('normal') || current_user_can('doctor') ) ){
      wp_redirect(home_url());
      exit;
    }
    global $language_url;
    $language_url = 'ssss';
}
add_action('init','wpse23007_redirect');


function get_create_url($url){
    
    return esc_url(home_url('/'.$url));
}

function create_url_param($url){
    echo home_url('/'.$url);
}


function create_url($url){
    echo get_create_url($url);
}

function theme_path($url){
    echo get_theme_path($url);
}
function get_theme_path($url){
    return esc_url(get_stylesheet_directory_uri() . $url);
}

add_filter( 'register_post_type_args', 'change_capabilities_of_course_document' , 10, 2 );

function change_capabilities_of_course_document( $args, $post_type ){

    // Do not filter any other post type
    if ( 'event' !== $post_type ) {
        // Give other post_types their original arguments
        return $args;

    }


    $args['capabilities'] = array(
        'edit_post' => 'edit_event',
        'edit_posts' => 'edit_events',
        'publish_posts' => 'publish_event',
        'edit_published_posts' => 'edit_published_events',
        'read_post' => 'read_event',
        'delete_published_posts' => 'delete_published_events'
    );
    

    // Give the course_document post type it's arguments
    return $args;

}

add_action('admin_init','opal_add_role_caps',999);
function opal_add_role_caps() {
    foreach (['account_events', 'administrator'] as $value) {
        $role = get_role($value);   
        $role->add_cap( 'read' );          
        $role->add_cap( 'read_event');
        $role->add_cap( 'edit_event' );
        $role->add_cap( 'edit_events' );
        $role->add_cap( 'edit_published_events' );
        $role->add_cap( 'publish_event' );
        $role->add_cap( 'delete_published_events' );
    }
}

add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}

include opalbeauty_THEME_PATH.'acf.php';
include opalbeauty_THEME_PATH.'cpt.php';


// USER ACTION
add_action('wp_ajax_nopriv_search_beauty', 'search_beauty'); // Ajax Login
add_action('wp_ajax_search_beauty', 'search_beauty'); // Ajax Login
function search_beauty()
{
    // Gather post data.
    $input = isset($_POST['input']) ? $_POST['input'] : '';
  
    $args = array(
        'post_type'  =>    'beauty',
        'orderby' => 'date',
        'order' => 'DESC',
        'ignore_sticky_posts' => false,
        's' => $input
    );
    $data = [];
   
    // The Query
    $the_query = new WP_Query( $args );
    $success = false;
    if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ){
            $the_query->the_post();
            $data[get_the_ID()] = [
                'title' => get_the_title(),
                'address' => get_field('beauty_address'),
                'link' => get_the_permalink()
            ];
        }
        $success = true;
        wp_reset_postdata();
    }
        
    wp_send_json_success(
        (object) array(
            "success" =>  $success,
            "data" => $data
        )
    );


}

function opalbeauty_paginate_links($wp_query){

    $big = 999999999;
    echo paginate_links(array(
        'base'      => str_replace($big,  '%#%',  esc_url( get_pagenum_link( $big ) )),
        'format'    => '?paged=%#%',
        'current'   => max( 1, get_query_var('paged') ),
        'total'     => $wp_query->max_num_pages,
        'prev_text' => __('‹','opalbeauty'),
        'next_text' => __('›','opalbeauty'),
    ));
}

function user_event_register($user_id = null){
    if(!$user_id){
        $user_id = get_current_user_id();
    }
    
    $user_posts = get_posts(array(
        'author' => $user_id,
        'post_type'    => 'user_register_event',
        'posts_per_page' => -1
    ));
    $arrPosts = [
        'relation' => 'OR'
    ];
    foreach($user_posts as $up){
        $arrPosts[]= array(
            'key'		=> 'event_users_register',
            'value'		=> $up->ID,
            'compare'	=> 'LIKE'
        );
    }
    
   
    if(empty($arrPosts[0])){
        return [
            'count'=> 0,
            'query'=> null
        ];
    }
   
    // The Query
    $args = array(
        'post_type'    =>    'event',
        'orderby' => 'date',
        'order' => 'DESC',
        'meta_query'	=> array(
            $arrPosts
        ),
    );
    $the_query = new WP_Query( $args );

    return [
        'count'=> $the_query->found_posts,
        'query'=> $the_query
    ];

}

function notifi_user_event_register($user_id){
    
    $user_posts = get_posts(array(
        'author' => $user_id,
        'post_type'    => 'user_register_event',
        'post_status' => array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash'),
        'posts_per_page' => -1

    ));
    
    $arrPosts = [
        'relation' => 'OR'
    ];
    foreach($user_posts as $up){
     
        $arrPosts[]= array(
            'key'		=> 'event_users_register',
            'value'		=> $up->ID,
            'compare'	=> 'LIKE'
        );
    }

    $arrEvent = [];
    // The Query
    $args = array(
        'post_type'    =>    'event',
        'post_status' => array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash'),
        'orderby' => 'date',
        'order' => 'DESC',
        'posts_per_page' => -1,
        'meta_query'	=> array(
            $arrPosts
        ),
    );
    $post_list = get_posts($args);
    foreach ( $post_list as $postL ) {
        $arrEvent[] = $postL->ID;
    }

    return $arrEvent;

}

function checkQueryCheked($fieldKey = 'review_category', $defaultChecked = '0'){
    $default = [];
	$field = get_query_var( $fieldKey );
   
	if($field){
		foreach($field as $value){
			$default[$value] = 'checked';
		}
	}else{
        $default[$defaultChecked] = 'checked';
    }
    
    return $default;
}

function search_filter($query) {
    if ( ! is_admin() && $query->is_main_query() ) {
        if ( is_tax( 'type_beauty' ) ) {
            if(get_query_var( 'rate' )){
                if(get_query_var( 'rate' ) == 6){
                    $query->set( 'meta_query',
                    array(     
                        'relation' => 'AND',             //(array)  - Sử dụng nhiều điều kiện lấy bài viết theo custom field 
                        array(
                            'key' => 'wpdiscuz_post_rating_beauty_rating',                  //(string) - Tên meta key
                            'value' => 1 ,                 //(string/array) - Giá trị meta value
                            'compare' => '<'                   //(string) - Toán tử so sánh với giá trị value trong mảng này. Có thể sử dụng '=', '!=', '>', '>=', '<', '<=', 'LIKE', 'NOT LIKE', 'IN', 'NOT IN', 'BETWEEN', 'NOT BETWEEN', 'EXISTS' (only in WP >= 3.5), and 'NOT EXISTS' (also only in WP >= 3.5). Default value is '='.
                        )
                    )
                );
                }else{
                    $query->set( 'meta_query',
                        array(     
                            'relation' => 'AND',             //(array)  - Sử dụng nhiều điều kiện lấy bài viết theo custom field 
                            array(
                                'key' => 'wpdiscuz_post_rating_beauty_rating',                  //(string) - Tên meta key
                                'value' => (int)get_query_var( 'rate' ) ,                 //(string/array) - Giá trị meta value
                                'compare' => '>='                   //(string) - Toán tử so sánh với giá trị value trong mảng này. Có thể sử dụng '=', '!=', '>', '>=', '<', '<=', 'LIKE', 'NOT LIKE', 'IN', 'NOT IN', 'BETWEEN', 'NOT BETWEEN', 'EXISTS' (only in WP >= 3.5), and 'NOT EXISTS' (also only in WP >= 3.5). Default value is '='.
                            ),
                            array(
                                'key' => 'wpdiscuz_post_rating_beauty_rating',                  //(string) - Tên meta key
                                'value' => (int)get_query_var( 'rate' ) + 1,                 //(string/array) - Giá trị meta value
                                'compare' => '<'                   //(string) - Toán tử so sánh với giá trị value trong mảng này. Có thể sử dụng '=', '!=', '>', '>=', '<', '<=', 'LIKE', 'NOT LIKE', 'IN', 'NOT IN', 'BETWEEN', 'NOT BETWEEN', 'EXISTS' (only in WP >= 3.5), and 'NOT EXISTS' (also only in WP >= 3.5). Default value is '='.
                            )
                        )
                    );
                }
            }
        }else if ( is_post_type_archive( 'event' ) ){
            $field_service = get_query_var( 'field_service' );
            
            $meta_query =  array(  
                'relation'		=> 'AND',
            );
            if($field_service){
                $meta_query_service = [
                    'relation'		=> 'OR'
                ];
                foreach($field_service  as $value){
                    if($value == 'all'){
                        $meta_query_service = [];
                        break;
                    }
                    $meta_query_service[] = array(                  
                        'key'     => 'event_service',
                        'value'   => $value,
                        'compare' => 'LIKE'            
                    );
                }
                $meta_query[] = $meta_query_service;
            }
            $field_date = get_query_var( 'd' );
           
            if($field_date){
               
                $meta_query[] = array(
                    array(
                        'key'           => 'event_date_time',
                        'compare'       => '<',
                        'value'         => date('Y-m-d H:i:s', strtotime($field_date .' +1 day')),
                        'type'          => 'DATETIME',
                    ),
                    array(
                        'key'           => 'event_date_time',
                        'compare'       => '>',
                        'value'         => date('Y-m-d H:i:s', strtotime($field_date .' -1 day')),
                        'type'          => 'DATETIME',
                    )
                );
            }
         
            $query->set( 'meta_query',
                $meta_query
            );
        }else if(is_post_type_archive('question')){
            
            $query->set( 'meta_key','question_count_user_like');
            $query->set( 'orderby', [
                'meta_value_num' => 'DESC',
                'comment_count' => 'DESC',
                'date' => 'DESC',
                
           ]);
         
           $question_category = get_query_var('question_category');
           
            if($question_category){
                $query->set( 'tax_query',
                    array(                     //(array) - Lấy bài viết dựa theo taxonomy
                        'relation' => 'OR',
                        array(
                            'taxonomy' => 'question_category',                //(string) - Tên của taxonomy
                            'field' => 'id',                    //(string) - Loại field cần xác định term của taxonomy, sử dụng 'id' hoặc 'slug'
                            'terms' => get_query_var('question_category'),    //(int/string/array) - Slug của các terms bên trong taxonomy cần lấy bài
                            'operator' => 'IN'                    //(string) - Toán tử áp dụng cho mảng tham số này. Sử dụng 'IN' hoặc 'NOT IN'
                        ),
                    )
                );
            }
        }else if(is_post_type_archive('review')){
            $query->set( 'meta_key','review_count_user_like');
            $query->set( 'meta_type','NUMERIC');
            $query->set( 'orderby', [
                'meta_value_num' => 'DESC',
                'comment_count' => 'DESC',
                'date' => 'DESC',
                
           ]);
         
           $review_category = get_query_var('review_category');
           
            if($review_category){
                $query->set( 'tax_query',
                    array(                     //(array) - Lấy bài viết dựa theo taxonomy
                        'relation' => 'OR',
                        array(
                            'taxonomy' => 'review_category',                //(string) - Tên của taxonomy
                            'field' => 'id',                    //(string) - Loại field cần xác định term của taxonomy, sử dụng 'id' hoặc 'slug'
                            'terms' => get_query_var('review_category'),    //(int/string/array) - Slug của các terms bên trong taxonomy cần lấy bài
                            'operator' => 'IN'                    //(string) - Toán tử áp dụng cho mảng tham số này. Sử dụng 'IN' hoặc 'NOT IN'
                        ),
                    )
                );
            }
        }else if(is_author()){
            
            $authorPage = get_query_var('post');

            if($authorPage == 'question'){
                $query->set( 'post_type','question');
            }else if($authorPage == 'review'){
                $query->set( 'post_type','review');
            }else{
                $query->set( 'post_type','question');
            }
           
        }else if( $query->is_search ) {
            $query->set( 'post_type', 'beauty' );
        } 
    }
}
add_action( 'pre_get_posts', 'search_filter' );

function header_page($title, $backuUrl = ''){
    global $wp;
    echo '<div class="header-page">
        <div class="top-element">
            <a href="'.get_create_url(add_query_arg( array('appt' => 'X'), $wp->request )).'" class="back-main back-action">
            <img src="'.get_theme_path('/assets/images/arrow-left.svg').'">
            </a>
            <h2>'.$title.'</h2>
        </div>
    </div>';
}
function header_author($backuUrl = ''){
    global $wp;
    echo '<div class="header-page other-author-header">
        <div class="top-element">
            <a href="'.get_create_url(add_query_arg( array('appt' => 'X'), $wp->request )).'"class="back-main back-action">
            <img src="'.get_theme_path('/assets/images/arrow-left.svg').'">
            </a>
            <h2></h2>
        </div>
    </div>';
}
function header_thumb($thumb, $backuUrl = ''){
    global $wp;
    echo '<div class="header-page thumb-header">
        <div class="top-element">
            <a href="'.get_create_url(add_query_arg( array('appt' => 'X'), $wp->request )).'" class="back-main back-action">
            <img src="'.get_theme_path('/assets/images/arrow-left.svg').'">
            </a>
            <a href="#" class="share-white-action">
                <img src="'.get_theme_path('/assets/images/share-white.svg').'">
            </a>
            <div class="cleared"></div>
            
        </div>
        <div class="wrap-thumb">
        '.$thumb.'
        </div>
    </div>';
}

// userSubscribe
add_action('wp_ajax_nopriv_updateNotification', 'updateNotification'); // Ajax Login
add_action('wp_ajax_updateNotification', 'updateNotification'); // Ajax Login
function updateNotification()
{
    $input = isset($_POST['input']) ? $_POST['input'] : '';
    
    $user_current = MiddelWareAuthentication();
    $user_id = $user_current['id'];
    //$result = ob_get_clean();
    update_field( 'user_notification', $input, 'user_'.$user_id );
    wp_send_json_success(
        (object) array(
            "success" => true
        )
    );
    die();
}
// userSubscribe
add_action('wp_ajax_nopriv_delete_question', 'delete_question'); // Ajax Login
add_action('wp_ajax_delete_question', 'delete_question'); // Ajax Login
function delete_question()
{
   
    //ob_start(); //bắt đầu bộ nhớ đệm
    // Gather post data.
    $input = isset($_POST['input']) ? $_POST['input'] : '';
    $success = false;
    $user_id = get_current_user_id();
    $messenger = __('No permission to send', 'opalbeauty');
    $post_id = $input['post_id'];
    if($user_id){
        $postCurrent = get_post($post_id);
      
        if($postCurrent){
            wp_delete_post( $post_id, true);
            $success = true;
            $messenger = '';
        }
    }

    //$result = ob_get_clean();
    wp_send_json_success(
        (object) array(
            "success" => $success,
            "messenger" => $messenger
        )
    );
    die();
}

// userSubscribe
add_action('wp_ajax_nopriv_userUnregister', 'userUnregister'); // Ajax Login
add_action('wp_ajax_userUnregister', 'userUnregister'); // Ajax Login
function userUnregister()
{
   
    //ob_start(); //bắt đầu bộ nhớ đệm
    // Gather post data.
    $input = isset($_POST['input']) ? $_POST['input'] : '';
    $success = false;
    $user_id = get_current_user_id();
    $messenger = __('No permission to send', 'opalbeauty');
    $post_id = $input['post_id'];
    if($user_id){
        $postCurrent = get_post($post_id);
      
        if($postCurrent){
            $fieldCurrent = get_field('event_users_register', $post_id);
            
            if($fieldCurrent){
                $newField = [];
                $user_post = get_posts(array(
                    'author' => $user_id,
                    'post_type'    => 'user_register_event'
                ));
                $user_post_key = [];
                foreach($user_post as $up){
                    $user_post_key[$up->ID] = 1;
                }
              
                
                foreach($fieldCurrent as $fc){
                    if($user_post_key[$fc->ID]){
                        continue;
                    }
                    $newField[] = $fc;
                }
                $postRegister = update_field('event_users_register', $newField, $post_id);
                if($postRegister){
                    $success = true;
                    $messenger = '';
                }
            }
        }
    }

    //$result = ob_get_clean();
    wp_send_json_success(
        (object) array(
            "success" => $success,
            "messenger" => $messenger
        )
    );
    die();
}



// userSubscribe
add_action('wp_ajax_nopriv_likeAction', 'likeAction'); // Ajax Login
add_action('wp_ajax_likeAction', 'likeAction'); // Ajax Login
function likeAction()
{
   
    $arrUser = checkLikeAddNotification($_POST['input']);
    update_field( 'question_user_like',  $arrUser['users'], $_POST['input'] );
    update_field( 'question_count_user_like',  count($arrUser['users']), $_POST['input'] );
     //$result = ob_get_clean();
     wp_send_json_success(
        (object) array(
            "success" => true
        )
    );
    die();
}

function checkEventLiked($arrLiked, $eventId){
    if(empty($arrLiked[$eventId])){
        return false;
    }

    return true;
}
function getCookieEventLiked($name){
    if(!empty($_COOKIE[$name])){
        $cookie_value = $_COOKIE[$name];
        $cookie_value = explode(",",$cookie_value);
        $newCookie = [];
        foreach($cookie_value as $cv){
            $newCookie[$cv] = '1';
        }
        return $newCookie;
    }
    
}


add_action('wp_ajax_nopriv_checkReadNotification', 'checkReadNotification'); // Ajax Login
add_action('wp_ajax_checkReadNotification', 'checkReadNotification'); // Ajax Login
function checkReadNotification(){
    $user_current = MiddelWareAuthentication();
    $id = $_POST['input'];
    $success = false;
   
    if(!empty($id)){
        global $wpdb;
        $myNotification = $wpdb->get_row( $wpdb->prepare( "SELECT notification_read FROM {$wpdb->prefix}notification WHERE notification_id  = %d" , $id) );
        if(!empty($myNotification)){
            if($myNotification->notification_read != 1){
                $data = [ 'notification_read' => 1 ]; // NULL value.
                $where = [ 'notification_id' => $id ];

                $wpdb->update( $wpdb->prefix . 'notification', $data, $where );
            }
        }
    }
   
    wp_send_json_success(
        (object) array(
            "success" => true
        )
    );

}

// userSubscribe
add_action('wp_ajax_nopriv_likeActionKey', 'likeActionKey'); // Ajax Login
add_action('wp_ajax_likeActionKey', 'likeActionKey'); // Ajax Login
function likeActionKey()
{
    $key = $_POST['input']['key'];
    
    $post_id = $_POST['input']['id'];

    $arrUser = checkLikeAddNotification($post_id, $key);
    
    update_field( $key.'_user_like',  $arrUser['users'], $post_id );
    update_field( $key.'_count_user_like',  count($arrUser['users']), $post_id );
    
     //$result = ob_get_clean();
     wp_send_json_success(
        (object) array(
            "success" => false
        )
    );
    die();
}

function opal_custom_excerpt_length( $length ) {
    return 14;
}
add_filter( 'excerpt_length', 'opal_custom_excerpt_length', 999 );

function new_excerpt_more($more) {
    global $post;
    if ( ( 'review' == $post->post_type ) ) {
        return sprintf( '...<span class="more-content">%1$s</span>', __( 'More', 'opalbeauty' ));
    }elseif(( 'question' == $post->post_type )){
        return '';
    }

    return $more;
   
    
}
add_filter('excerpt_more', 'new_excerpt_more');

function checkLike($post_id, $key = 'question'){
    $user_current = MiddelWareAuthentication();
    $user_id = $user_current['id'];
    $like =  [
        'liked'=> false,
        'users'=> []
    ];
  
    $fieldCurrent = get_field( $key.'_user_like', $post_id );
    if($fieldCurrent){
        $newField = [];
        $like['count'] = count($fieldCurrent);
        foreach($fieldCurrent as $key => $val){
            $newField[$val] = $key;
        }
        if(isset($newField[$user_id])){
            $like['liked'] = true;
            $like['users'] = array_diff($fieldCurrent,array($user_id));
        }else{
            $fieldCurrent[] = $user_id;
            $like['users'] = $fieldCurrent;
        }
        
    }else{
        $like['users'] = array($user_id);
        $like['count'] = 0;
    }
   
    return $like;

}
function checkLikeAddNotification($post_id, $keyq = 'question'){
    $user_current = MiddelWareAuthentication();
    $user_id = $user_current['id'];
    $like =  [
        'liked'=> false,
        'users'=> []
    ];
  
    $fieldCurrent = get_field( $keyq.'_user_like', $post_id );
    if($fieldCurrent){
        $newField = [];
        $like['count'] = count($fieldCurrent);
        foreach($fieldCurrent as $key => $val){
            $newField[$val] = $key;
        }
        if(isset($newField[$user_id])){
            $like['liked'] = true;
            $like['users'] = array_diff($fieldCurrent,array($user_id));
        }else{
            $fieldCurrent[] = $user_id;
            $like['users'] = $fieldCurrent;
        }
        
    }else{
        $like['users'] = array($user_id);
        $like['count'] = 0;
    }
    if(!$like['liked']){
      
        $author_id = get_post_field( 'post_author', $post_id );
        if($author_id != $user_id){
           
            switch ($keyq) {
                case 'question':
                    insert_notification(arr_notification()['love_question'], $user_id, $post_id);
                    break;
                case 'review':
                    insert_notification(arr_notification()['love_review'], $user_id, $post_id);
                    break;
                default:
                    $text = 0;
            }
           
            
        }
    }
    
   
    return $like;

}

add_filter( 'pre_comment_approved' , 'opal_filter_handler' , '99', 2 );
 
function opal_filter_handler( $approved , $commentdata )
{
    // array(13) { ["user_id"]=> int(60) 
    //     ["comment_post_ID"]=> int(442) 
    //     ["comment_parent"]=> int(0) 
    //     ["comment_author"]=> string(12) "cloudkick195" 
    //     ["comment_author_email"]=> string(23) "cloudkick195@gmail.coms" 
    //     ["comment_content"]=> string(4) "qqwe" 
    //     ["comment_author_url"]=> string(0) "" 
    //     ["comment_agent"]=> string(114) "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.81 Safari/537.36" 
    //     ["comment_type"]=> string(7) "comment" 
    //     ["comment_author_IP"]=> string(9) "127.0.0.1" ["comment_date"]=> string(19) "2022-02-10 07:54:39" 
    //     ["comment_date_gmt"]=> string(19) "2022-02-10 07:54:39" 
    //     ["filtered"]=> bool(true) }

    // insert code here to inspect $commentdata and determine 'approval', 'disapproval', 'trash', or 'spam' status
    if($approved == 1){
        if($commentdata['comment_post_ID']){
            
            $post_id = $commentdata['comment_post_ID'];
           
            $postComment = get_post($post_id);  
            $post_type =  $postComment->post_type;
            $author_id = $postComment->post_author;
            
            switch ($post_type) {
                case 'question':
                    if($author_id != $commentdata['user_id']){
                        insert_a_notification(arr_notification()['answered_question'][0], $author_id, $commentdata['user_id'], $post_id);
                    }
                    if(!empty($commentdata['comment_parent'])){
                        $parentComment = get_comment($commentdata['comment_parent']);
                        if($parentComment->user_id != $commentdata['user_id']){
                            insert_a_notification(arr_notification()['reply_comment_question'][0], $parentComment->user_id, $commentdata['user_id'],$post_id);
                        }
                        
                    }

                    break;
                case 'review':
                    if($author_id != $commentdata['user_id']){
                        insert_a_notification(arr_notification()['commented_review'][0], $author_id, $commentdata['user_id'], $post_id);
                    }
                    if(!empty($commentdata['comment_parent'])){
                        $parentComment = get_comment($commentdata['comment_parent']);
                        if($parentComment->user_id != $commentdata['user_id']){
                            insert_a_notification(arr_notification()['reply_comment_review'][0], $parentComment->user_id, $commentdata['user_id'],$post_id);
                        }
                    }
                    break;
                default:
                    $text = 0;
            }
            

        }
    }
  
    return $approved;
}

function insert_a_notification($text, $author_id, $assigned_user, $post_id){
    global $wpdb;
    $arrColVal = array(
        'notification_text' => $text,
        'user_id' => $author_id,
        'notification_time'=> current_time('mysql'),
        'post_id' => $post_id
    );
    $arrType = array(
        '%s',
        '%d',
        '%s',
        '%d'
    );
    if($assigned_user){
        $arrColVal['assigned_user'] = $assigned_user;
        $arrType[]='%d';
    }
    $checkInsert = $wpdb->insert($wpdb->prefix.'notification', $arrColVal, $arrType);
}


// userSubscribe
add_action('wp_ajax_nopriv_userUpdateQuestion', 'userUpdateQuestion'); // Ajax Login
add_action('wp_ajax_userUpdateQuestion', 'userUpdateQuestion'); // Ajax Login
function userUpdateQuestion()
{
   
    //ob_start(); //bắt đầu bộ nhớ đệm
    // Gather post data.
    $input = [
        'post_title' =>  isset($_POST['question_title']) ? $_POST['question_title'] : '',
        'post_content' =>  isset($_POST['question_detail']) ? $_POST['question_detail'] : '',
       
    ];
    $inputCat = isset($_POST['question_category']) ? $_POST['question_category'] : '';
    $inputImages = isset($_POST['question_image_id']) ? $_POST['question_image_id'] : '';
  
    $success = false;
    $user_current = MiddelWareAuthentication();
    $messenger = __('No permission to send', 'opalbeauty');
    $errors = [];
   
    if(!empty($errors)){
        $messenger = __('Not enough input fields', 'opalbeauty');
    }else{
        $my_post = array();
        foreach($input as $key => $val){
            if(!empty($val)){
                $my_post[$key] = $val;
            }
        }
        $post_id = $_POST['q_id'];
        
        if(!empty($my_post)){
            $my_post['ID'] = (int)$post_id;
            wp_update_post( $my_post );
        }
       
        if(empty($inputCat)){
            wp_set_object_terms( $post_id, null, 'question_category' );
        }else{
            $arrInputCat = explode(",", $inputCat);
            $newArrInputCat = [];
            foreach($arrInputCat as $iCVal){
                if(empty($iCVal)){
                    $arrInputCat = null;
                    break;
                }
                $newArrInputCat[] = (int)$iCVal;
            }
            wp_set_object_terms( $post_id, $newArrInputCat, 'question_category' );
        }
        $inputImages = array_map('intval',explode(",", $inputImages));
       
        if(!empty($inputImages) && !empty($_FILES[ 'question_image' ])){
            
            $attachment_ids = my_assets_uploader($_FILES[ 'question_image' ], $post_id);
           
            $countA = 0;
            $objAttachment = [];
            if(!empty($inputImages)){

                foreach($inputImages as $kip => $ip){
                   
                    if(!$ip){
                        $inputImages[$kip] = $attachment_ids[$countA];
                        $countA++;
                    }
                
                    $objAttachment[$inputImages[$kip]] = $inputImages[$kip];
                }
            }

           
            if ( count( $inputImages ) > 1 ) {

                $appendage = '';
            
                foreach ( $inputImages as $i => $img_id ) {
                    if ( $html = wp_get_attachment_image( $img_id, 'large' ) ) {
                        $appendage .= $html;
                    }
                }
            
                if ( !empty( $appendage ) ) {
                    update_field( 'question_images', $appendage, $post_id );
                }
            
            }
          
            if(!empty($post_id)){
                $args = array(
                    'order'          => 'ASC',
                    'post_mime_type' => 'image',
                    'post_parent'    => $post_id,
                    'post_status'    => null,
                    'post_type'      => 'attachment',
                );
                $attachments_post = get_children( $args );
                if(!empty($attachments_post)){
                    foreach($attachments_post as $ap){
                        if(empty($objAttachment[$ap->ID])){
                            wp_delete_attachment( $ap->ID, true );
                        }
                    }
                }
            }
           
        }else{
           
            if(empty($inputImages) || empty($inputImages[0])){
                $args = array(
                    'order'          => 'ASC',
                    'post_mime_type' => 'image',
                    'post_parent'    => $post_id,
                    'post_status'    => null,
                    'post_type'      => 'attachment',
                );
                $attachments_post = get_children( $args );
                if(!empty($attachments_post)){
                    foreach($attachments_post as $ap){
                        wp_delete_attachment( $ap->ID, true );
                    }
                }
            }else{
                
                if(!empty($post_id)){
                    $args = array(
                        'order'          => 'ASC',
                        'post_mime_type' => 'image',
                        'post_parent'    => $post_id,
                        'post_status'    => null,
                        'post_type'      => 'attachment',
                    );
                    $attachments_post = get_children( $args );
                    
                    $newInputImages = [];
                    foreach($inputImages as $kip => $ip){
                        if(!empty($ip)){
                            $newInputImages[$ip.''] = $ip;
                        }
                    }
                   
                    if(!empty($attachments_post)){
                        foreach($attachments_post as $ap){
                            if(empty($newInputImages[$ap->ID.''])){
                                wp_delete_attachment( $ap->ID, true );
                            }
                        }
                    }
                }
            }
           
          
        }
        $success = true;
        $messenger = '';
    }
    
    //$result = ob_get_clean();
    wp_send_json_success(
        (object) array(
            "success" => $success,
            "messenger" => $messenger
        )
    );
    die();
}


// userUpdateReview
add_action('wp_ajax_nopriv_userUpdateReview', 'userUpdateReview'); // Ajax Login
add_action('wp_ajax_userUpdateReview', 'userUpdateReview'); // Ajax Login
function userUpdateReview()
{
   
    //ob_start(); //bắt đầu bộ nhớ đệm
    // Gather post data.
    $input = [
        'post_content' =>  isset($_POST['review_detail']) ? $_POST['review_detail'] : '',
       
    ];
    $inputCat = isset($_POST['review_category']) ? $_POST['review_category'] : '';
  
    $success = false;
    $user_current = MiddelWareAuthentication();
    $messenger = __('No permission to send', 'opalbeauty');
    $errors = [];
   
    if(!empty($errors)){
        $messenger = __('Not enough input fields', 'opalbeauty');
    }else{
        $my_post = array();
        foreach($input as $key => $val){
            if(!empty($val)){
                $my_post[$key] = $val;
            }
        }
        $post_id = $_POST['q_id'];
        
        if(!empty($my_post)){
            $my_post['ID'] = (int)$post_id;
            wp_update_post( $my_post );
        }
        if(!empty($inputCat)){
            wp_set_object_terms( $post_id, array_map('intval', explode(",", $inputCat)), 'review_category' );
        }

        
    
        $objAttachment = [];
        if($_FILES[ 'review_before' ]){
            $reviewImg = my_asset_uploader($_FILES[ 'review_before' ], $post_id);
           
            if ( $reviewImg ) {
                update_field( 'review_before', $reviewImg, $post_id );
            }
        }
           
        if($_FILES[ 'review_after' ]){
            $reviewImg = my_asset_uploader($_FILES[ 'review_after' ], $post_id);
          
            if ( $reviewImg ) {
                update_field( 'review_after', $reviewImg, $post_id );
            }
        }
    
        // if(!empty($post_id) && !empty($objAttachment)){
        //     $args = array(
        //         'order'          => 'ASC',
        //         'post_mime_type' => 'image',
        //         'post_parent'    => $post_id,
        //         'post_status'    => null,
        //         'post_type'      => 'attachment',
        //     );
        //     $attachments_post = get_children( $args );
        
        //     if(!empty($attachments_post)){
        //         foreach($attachments_post as $ap){
        //             if(!$objAttachment[$ap->ID]){
        //                 wp_delete_attachment( $ap->ID, true );
        //             }
        //         }
        //     }
        // }
        
        $success = true;
        $messenger = '';
    }
    
    //$result = ob_get_clean();
    wp_send_json_success(
        (object) array(
            "success" => $success,
            "messenger" => $messenger
        )
    );
    die();
}


add_action('wp_ajax_nopriv_userCreateReview', 'userCreateReview'); // Ajax Login
add_action('wp_ajax_userCreateReview', 'userCreateReview'); // Ajax Login
function userCreateReview()
{
   
    //ob_start(); //bắt đầu bộ nhớ đệm
    // Gather post data.
    $input = [
        'post_content' =>  isset($_POST['review_detail']) ? $_POST['review_detail'] : '',
        'post_category' =>  isset($_POST['review_category']) ? $_POST['review_category'] : '',
    ];
    $success = false;
    $user_current = MiddelWareAuthentication();
    $messenger = __('No permission to send', 'opalbeauty');
    $errors = [];
 
    foreach($input as $key => $val){
        if(empty($val)){
            $errors[] = 'error';
        }   
    }
   
    if(!empty($errors)){
        $messenger = __('Not enough input fields', 'opalbeauty');
    }else{
        $my_post = array(
            'post_type'    => 'review',
            'post_content'  => wp_strip_all_tags($input['post_content']),
            'post_status'   => 'publish',
            'comment_status' => 'open'
        );
       
        // Insert the post into the database
        $post_id = wp_insert_post( $my_post );
       
        if( !is_wp_error($post_id)){
            wp_set_object_terms( $post_id, array_map('intval', explode(",", $input['post_category'])), 'review_category' );
            update_field( 'review_before', my_assets_uploader($_FILES[ 'review_before' ], $post_id)[0], $post_id );
            update_field( 'review_after', my_assets_uploader($_FILES[ 'review_after' ], $post_id)[0], $post_id );
            update_field( 'review_count_user_like', 0, $post_id );
            insert_notification(arr_notification()['posted_review'], null,$post_id);
            $success = true;
            $messenger = '';
        }else{
            $messenger = $post_id->get_error_message();
        }
    }
   
    //$result = ob_get_clean();
    wp_send_json_success(
        (object) array(
            "success" => $success,
            "messenger" => $messenger
        )
    );
    die();
}

add_action('wp_ajax_nopriv_userCreateQuestion', 'userCreateQuestion'); // Ajax Login
add_action('wp_ajax_userCreateQuestion', 'userCreateQuestion'); // Ajax Login
function userCreateQuestion()
{
   
    //ob_start(); //bắt đầu bộ nhớ đệm
    // Gather post data.
    $input = [
        'question_title' =>  isset($_POST['question_title']) ? $_POST['question_title'] : '',
        'question_detail' =>  isset($_POST['question_detail']) ? $_POST['question_detail'] : ''
    ];
    $success = false;
    $user_current = MiddelWareAuthentication();
    $messenger = __('No permission to send', 'opalbeauty');
    $errors = [];
 
    foreach($input as $key => $val){
        if(empty($val)){
            $errors[] = 'error';
        }   
    }
    $input['question_image'] = isset($_POST['question_image']) ? $_POST['question_image'] : '';
    
    if(!empty($errors)){
        $messenger = __('Not enough input fields', 'opalbeauty');
    }else{
        $my_post = array(
            'post_title'    => wp_strip_all_tags( $input['question_title'] ),
            'post_type'    => 'question',
            'post_content'  => wp_strip_all_tags($input['question_detail']),
            'post_status'   => 'publish',
            'comment_status' => 'open'
        );
       
        // Insert the post into the database
        $post_id = wp_insert_post( $my_post );

        $inputCat =  isset($_POST['question_category']) ? $_POST['question_category'] : '';
        if(empty($inputCat)){
            wp_set_object_terms( $post_id, null, 'question_category' );
        }else{
            $arrInputCat = explode(",", $inputCat);
            $newArrInputCat = [];
            foreach($arrInputCat as $iCVal){
                if(empty($iCVal)){
                    $arrInputCat = null;
                    break;
                }
                $newArrInputCat[] = (int)$iCVal;
            }
            wp_set_object_terms( $post_id, $newArrInputCat, 'question_category' );
        }

        if(!empty($_FILES[ 'question_image' ])){

            $attachment_ids = my_assets_uploader($_FILES[ 'question_image' ], $post_id);

            if ( count( $attachment_ids ) > 1 ) {

                $appendage = '';
            
                foreach ( $attachment_ids as $i => $img_id ) {
                    if ( $html = wp_get_attachment_image( $img_id, 'large' ) ) {
                        $appendage .= $html;
                    }
                }
            
                if ( !empty( $appendage ) ) {
                    update_field( 'question_images', $appendage, $post_id );
                }
            
            }
        }
       
        if( !is_wp_error($post_id)){
            insert_notification(arr_notification()['posted_question'], null,$post_id);
            update_field( 'question_count_user_like', 0, $post_id );
            $success = true;
            $messenger = '';
        }else{
            $messenger = $post_id->get_error_message();
        }
    }
   
    //$result = ob_get_clean();
    wp_send_json_success(
        (object) array(
            "success" => $success,
            "messenger" => $messenger
        )
    );
    die();
}

function my_assets_uploader( $file, $parent_id = 0, $allowed = [] ) {
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';

    $arrImages = [];
    // Get basic attributes
    $files_name = $file[ 'name' ];
    $files_tmp_name = $file[ 'tmp_name' ];
    foreach ($files_name as $key => $value) {
        $filename   = basename( $value );
        $mime       = wp_check_filetype( $filename );
    
        // Get the content type from response headers
        $type   = !empty( $mime[ 'type' ] ) ? $mime[ 'type' ] : $file[ 'type' ];
        $ext    = !empty( $mime[ 'ext' ] ) ? $mime[ 'ext' ] : trim( explode( '|' , array_search( $type, get_allowed_mime_types() ) )[ 0 ] );
    
        // Basic checks
        if ( !$type || !$ext || ( !empty( $allowed ) && is_array( $allowed ) && !in_array( $ext, $allowed ) ) ) {
            // Not a valid file
            return new WP_Error( 'upload', 'Invalid file type. Please try another file.' );
        }
       
        // Move file to wp-content
        $body   = @file_get_contents( $files_tmp_name[$key] );
        $file   = wp_upload_bits( $filename, null, $body );
    
        // Upload check
        if ( !empty( $file[ 'error' ] ) ) {
            return new WP_Error( 'upload', $file[ 'error' ] );
        }
        
        // Write attachment location to the database
        $attachment_id = wp_insert_attachment( [
            'post_title'        => $filename,
            'post_mime_type'    => $file[ 'type' ]
        ], $file[ 'file' ], $parent_id, true );
    
        if ( is_wp_error( $attachment_id ) ) {
            return $attachment_id;
        }

        $arrImages[] = $attachment_id;
    }
    

    return $arrImages;
}

function my_asset_uploader( $file, $parent_id = 0, $allowed = [] ) {
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';

    // Get basic attributes
    $files_name = $file[ 'name' ];
    $files_tmp_name = $file[ 'tmp_name' ];

    $filename   = basename( $files_name );
    $mime       = wp_check_filetype( $filename );

    // Get the content type from response headers
    $type   = !empty( $mime[ 'type' ] ) ? $mime[ 'type' ] : $file[ 'type' ];
    $ext    = !empty( $mime[ 'ext' ] ) ? $mime[ 'ext' ] : trim( explode( '|' , array_search( $type, get_allowed_mime_types() ) )[ 0 ] );

    // Basic checks
    if ( !$type || !$ext || ( !empty( $allowed ) && is_array( $allowed ) && !in_array( $ext, $allowed ) ) ) {
        // Not a valid file
        return new WP_Error( 'upload', 'Invalid file type. Please try another file.' );
    }
    
    // Move file to wp-content
    $body   = @file_get_contents( $files_tmp_name );
    $file   = wp_upload_bits( $filename, null, $body );

    // Upload check
    if ( !empty( $file[ 'error' ] ) ) {
        return new WP_Error( 'upload', $file[ 'error' ] );
    }
    
    // Write attachment location to the database
    $attachment_id = wp_insert_attachment( [
        'post_title'        => $filename,
        'post_mime_type'    => $file[ 'type' ]
    ], $file[ 'file' ], $parent_id, true );

    if ( is_wp_error( $attachment_id ) ) {
        return null;
    }

    return $attachment_id;
}

function MiddelWareAuthentication(){
    $user_current = opal_get_current_user();
    $messenger = __('No permission to send', 'opalbeauty');
    $success = false;
    if($user_current){
        return $user_current;
    }
    //$result = ob_get_clean();
    wp_send_json_success(
        (object) array(
            "success" => $success,
            "messenger" => $messenger
        )
    );
    die();
}

// userSubscribe
add_action('wp_ajax_nopriv_userSubscribe', 'userSubscribe'); // Ajax Login
add_action('wp_ajax_userSubscribe', 'userSubscribe'); // Ajax Login
function userSubscribe()
{
   
    //ob_start(); //bắt đầu bộ nhớ đệm
    // Gather post data.
    $input = isset($_POST['input']) ? $_POST['input'] : '';
    $success = false;
    $user_current = opal_get_current_user();
    $messenger = __('No permission to send', 'opalbeauty');
 
    if($user_current){
        if(!isset($input) || !isset($input['field_service']) || !isset($input['subscribe_name']) || !isset($input['subscribe_phone']) || !isset($input['post_id'])){
            $messenger = __('Not enough input fields', 'opalbeauty');
        }else{
            $inputConvert = wp_strip_all_tags(trim($input['subscribe_name']) .' '. $input['subscribe_phone'] .' '. trim(implode(" ",$input['field_service'])));
        
            $post_id = post_exists( $inputConvert );
            if(!$post_id){
                $slug = sanitize_title($inputConvert);
                $my_post = array(
                    'post_title'    => wp_strip_all_tags( $inputConvert ),
                    'post_name'  => $slug,
                    'post_type'    => 'user_register_event',
                    'post_status'   => 'publish',
                    'meta_input'   => array(
                        'user_register_event_name' => trim($input['subscribe_name']),
                        'user_register_event_phone' => trim($input['subscribe_phone']),
                        'user_register_event_service' => $input['field_service']
                    ),
                );
    
                // Insert the post into the database
                $post_id = wp_insert_post( $my_post );
               
            }else{
                update_field( 'user_register_event_name', trim($input['subscribe_name']), $post_id );
                update_field( 'user_register_event_phone', trim($input['subscribe_phone']), $post_id );
                update_field( 'user_register_event_service', $input['field_service'], $post_id );
            } 
           
            if( !is_wp_error($post_id)){
                $fieldCurrent = get_field( 'event_users_register', $input['post_id'] );
                $fieldCurrent[] = $post_id;
                $postRegister = update_field( 'event_users_register', $fieldCurrent, $input['post_id'] );
           
                if($postRegister){
                    $success = true;
                    $messenger = '';
                }
            }else{
                $messenger = $post_id->get_error_message();
            }
        }
       
    }

    //$result = ob_get_clean();
    wp_send_json_success(
        (object) array(
            "success" => $success,
            "messenger" => $messenger
        )
    );
    die();
}

add_action( 'auto-draft_to_publish', 'opal_new_post', 10, 3 );
function opal_new_post( $post ) {
    if($post->post_type == 'event'){
        // insert_notification_event(arr_notification()['added_event'], $post->ID);
    }elseif($post->post_type == 'beauty'){
        insert_notification_event(arr_notification()['update_new_spa'], $post->ID);
    }
    
}

function my_acf_before_save_post( $post_id ) {
   
    $post = get_post($post_id);
    if(!empty($post->post_type) && $post->post_type == 'event' && $post->post_status == 'publish'){
        $currentDate = new DateTime();
        $diff = $currentDate->diff( new DateTime($post->post_date) );
        
        if($diff->y || $diff->m || $diff->d || $diff->h || $diff->i || $diff->s > 3){
            insert_notification_event(arr_notification()['update_event'], $post_id);
        }else{
            insert_notification_event(arr_notification()['added_event'], $post->ID);
        }
        
    }
}
add_action('acf/save_post', 'my_acf_before_save_post');


// add_action( 'profile_update', 'opal_check_user_doctor_updated', 10, 2 );
// function opal_check_user_doctor_updated( $user_id, $old_user_data ) {
//     $user = get_userdata( $user_id );
//     if($user->roles && $user->roles[0] && $user->roles[0] == 'doctor'){
//         $user_doctor = get_field('moderated', 'user_'.$user_id );
      
//         if($user_doctor){
//             //insert_notification_doctor(arr_notification()['approved_doctor'], $user_id);
//         }else{
            
//         }
//     }
// }
add_filter('acf/update_value/name=moderated', 'my_check_for_change', 10, 3);
function my_check_for_change($value, $post_id, $field) {
    
    $old_value = get_field($field['name'], $post_id);
    
    if ($old_value != $value) {
        $fieldUser = explode("_", $post_id);
        if(!empty($fieldUser[1])){
            if($value){
                insert_notification_doctor(arr_notification()['approved_doctor'], $fieldUser[1]);
            }else{
                insert_notification_doctor(arr_notification()['refuse_doctor'], $fieldUser[1]);
            }
        }
        
    }
    return $value;
}
         


add_action( 'trashed_post', 'opal_trashed_post' , 10, 3);
function opal_trashed_post($post_id){
    if(get_post_type( $post_id) == 'event'){
        insert_notification_event(arr_notification()['event_deleted'], $post_id);
    }
    
}

// USER ACTION
add_action('wp_ajax_nopriv_submitLoginUser', 'submit_login_user'); // Ajax Login
add_action('wp_ajax_submitLoginUser', 'submit_login_user'); // Ajax Login
function submit_login_user()
{

    //ob_start(); //bắt đầu bộ nhớ đệm
    // Gather post data.
    $input = isset($_POST['input']) ? $_POST['input'] : '';
    $auth = wp_authenticate($input['email'], $input['password']);
    $success = false;
    $email = $input['email'];
    
   if(is_email($email) && email_exists( $email ) && !is_wp_error($auth)){
		$id_new_user = get_user_by( 'email', $email )->ID;
		
		wp_clear_auth_cookie();
        $user = wp_set_current_user($id_new_user);
        wp_set_auth_cookie($id_new_user,true,is_ssl());
        do_action('wp_login', $user->user_login, $user);
		header('user_id: '.$id_new_user);

		setcookie("USER_ID", $id_new_user,time() + 1209600, "/","", 0); 
		if(is_user_logged_in()) echo 'success';      
	}

    // $result = ob_get_clean();
    // wp_send_json_success(
    //     (object) array(
    //         "login_success" => $success,
    //         "data" => $auth
    //     )
    // );
    die();
}

add_action('wp_ajax_nopriv_updatePassword', 'updatePassword'); // Ajax check if user exist in system
add_action('wp_ajax_updatePassword', 'updatePassword'); // Ajax check if user exist in system
function updatePassword()
{
   
    //ob_start(); //bắt đầu bộ nhớ đệm

    // Gather post data.
    $input = isset($_POST['input']) ? $_POST['input'] : '';

    $user_current = MiddelWareAuthentication();
    $user_email = $user_current['email'];
    $success = false;
    $error_message = '';
   
   
    if($input['password'] !== $input['confirm_password']){
        $error_message = __( 'Wrong password re-entered', 'opalbeauty');
    }else{
        $auth = wp_authenticate($user_email, $input['current_password']);
        if (!is_wp_error($auth)) { // Login success
            $resetPass = reset_password(wp_get_current_user(), $input['password']);
            if (!isset($resetPass->errors)) {
                $success = true;
                $auth = wp_authenticate($user_email, $input['password']);
                if (!isset($auth->errors)) { // Login success
                    wp_clear_auth_cookie();
                    wp_set_current_user($auth->data->ID); // Set the current user detail
                    wp_set_auth_cookie($auth->data->ID); // Set auth details in cookie
                   
                }
               
            } else {
                $error_message = __( 'Password error, please re-enter password', 'opalbeauty');
            }
        }else{
            $error_message = __( 'Wrong password, please re-enter password', 'opalbeauty');
        }
       
    }
    
    //$result = ob_get_clean();
    wp_send_json_success(
        (object) array(
            'success' => $success,
            'message' => $error_message
        )
    );
    // wp_send_json_success(
    //     (object) array(
    //         'status' => json_encode(array(
    //             date("d/m/Y").' - CargoNetwork standard member Invoice',
    //             date("d/m/Y").' - CargoNetwork standard member Invoice'
    //         )),
    //     )
    // );
    die();
}


add_action('wp_ajax_nopriv_checkExistsUser', 'check_exists_user'); // Ajax check if user exist in system
add_action('wp_ajax_checkExistsUser', 'check_exists_user'); // Ajax check if user exist in system
function check_exists_user()
{
   
    //ob_start(); //bắt đầu bộ nhớ đệm

    // Gather post data.
    $input = isset($_POST['input']) ? $_POST['input'] : '';

    $isEmailExists = email_exists($input['email']);
    $user_id = '';
    $success = false;
    $error_message = '';
    $role = isset($input['u']) ? 'doctor' : 'normal';

    if($input['password'] !== $input['confirm_password']){
        $error_message = __( 'Wrong password re-entered', 'opalbeauty');
        $success = false;
    }else if ($isEmailExists === false) {
        $success = true;
        $error_message = __( 'Create user success', 'opalbeauty');
        
        setcookie("ulg", secured_encrypt($input), time() + (86400 * 30), "/"); // 86400 = 1 day;

    } else {
        $success = false;
        $error_message = __( 'Email already exists', 'opalbeauty');
    }
    
    //$result = ob_get_clean();
    wp_send_json_success(
        (object) array(
            'success' => $success,
            'message' => $error_message
        )
    );
    // wp_send_json_success(
    //     (object) array(
    //         'status' => json_encode(array(
    //             date("d/m/Y").' - CargoNetwork standard member Invoice',
    //             date("d/m/Y").' - CargoNetwork standard member Invoice'
    //         )),
    //     )
    // );
    die();
}




// USER ACTION
add_action('wp_ajax_nopriv_submitRegisterUser', 'submit_register_user'); // Ajax Login
add_action('wp_ajax_submitRegisterUser', 'submit_register_user'); // Ajax Login
function submit_register_user()
{
   
    //ob_start(); //bắt đầu bộ nhớ đệm

    // Gather post data.
    $input = [
        'username' =>  isset($_POST['username']) ? $_POST['username'] : '',
        'interested_in' =>  isset($_POST['interested_in']) ? $_POST['interested_in'] : '',
        'gender' =>  isset($_POST['gender']) ? $_POST['gender'] : '',
        'age' =>  isset($_POST['age']) ? $_POST['age'] : '',
        'fullname' =>  isset($_POST['fullname']) ? $_POST['fullname'] : '',
        'study_at' =>  isset($_POST['study_at']) ? $_POST['study_at'] : '',
        'experience' =>  isset($_POST['experience']) ? $_POST['experience'] : '',
        'surgeries' =>  isset($_POST['surgeries']) ? $_POST['surgeries'] : '',
        'specialist' =>  isset($_POST['specialist']) ? $_POST['specialist'] : '',
        'work_at' =>  isset($_POST['work_at']) ? $_POST['work_at'] : ''
    ];
    
    $user_draft = opal_get_current_user();
    
    $isEmailExists = email_exists($user_draft['email']);
    $user_id = '';
    $success = false;
    $error_message = '';
    $role = (isset($user_draft['role']) && $user_draft['role']=='doctor') ? 'doctor' : 'normal';
   
    if ($isEmailExists === false) {
        
        $userdata = array(
            'user_login' =>  $role == 'normal' ? $input['username'] :  $user_draft['email'],
            'user_pass' => $user_draft['password'],
            'user_email' => $user_draft['email'],
            'show_admin_bar_front' => false, // display the Admin Bar for the user 'true' or 'false'
            'role' => $role,
        );


        if(isset($input['fullname'])){
            $userdata['display_name'] = $input['fullname'];
            $userdata['nickname'] = $input['fullname'];
            $userdata['user_nicename'] = sanitize_title($input['fullname']);
        }
        
        
        $user_id = wp_insert_user($userdata);
      
        // On success.
        if ( ! is_wp_error( $user_id ) ) {
           
            wp_clear_auth_cookie();
            wp_set_current_user($user_id); // Set the current user detail
            wp_set_auth_cookie($user_id); // Set auth details in cookie
            update_field( 'user_gender', $input['gender'], 'user_'.$user_id );
            update_field( 'user_age', $input['age'], 'user_'.$user_id );
            handling_upload_image('user_'.$user_id, $input['username'], ['image', 'user_avatar']);

            if($role == 'normal'){
                update_field( 'interested_in', explode(",",$input['interested_in']), 'user_'.$user_id );
            }elseif($role == 'doctor'){
                update_field( 'fullname', $input['fullname'], 'user_'.$user_id );
                update_field( 'study_at', $input['study_at'], 'user_'.$user_id );
                update_field( 'experience', $input['experience'], 'user_'.$user_id );
                update_field( 'surgeries', $input['surgeries'], 'user_'.$user_id );
                update_field( 'specialist', explode(",",$input['specialist']), 'user_'.$user_id );
                update_field( 'work_at', $input['work_at'], 'user_'.$user_id );
                handling_upload_image('user_'.$user_id, $input['username'], ['certificated', 'certificated']);
            }
            
            $success = true;
            $error_message = __( 'Create user success', 'opalbeauty');
            
        }else{
            $success = false;
            $error_message = __( 'Please re-enter other registration information' , 'opalbeauty');
        }
      
        
       

        // Send email to user if register successful
        // $headers = array('Content-Type: text/html; charset=UTF-8');
        // $body = get_field('mail_welcome', 'option');
       
        // wp_mail($input['email'], sprintf(__('[%s] Welcome'), get_option('blogname')), $body, $headers);
    } else {
        $success = false;
        $error_message = __( 'Email already exists', 'opalbeauty');
    }

    //$result = ob_get_clean();
    wp_send_json_success(
        (object) array(
            'success' => $success,
            'moderated' => $role == 'doctor' ? true : false,
            'message' => $error_message
        )
    );
    // wp_send_json_success(
    //     (object) array(
    //         'status' => json_encode(array(
    //             date("d/m/Y").' - CargoNetwork standard member Invoice',
    //             date("d/m/Y").' - CargoNetwork standard member Invoice'
    //         )),
    //     )
    // );
    die();
}




// USER ACTION
add_action('wp_ajax_nopriv_submitUpdateUser', 'submit_update_user'); // Ajax Login
add_action('wp_ajax_submitUpdateUser', 'submit_update_user'); // Ajax Login
function submit_update_user()
{
    //ob_start(); //bắt đầu bộ nhớ đệm

    // Gather post data.
    $input = [
        'username' =>  isset($_POST['username']) ? $_POST['username'] : '',
        'interested_in' =>  isset($_POST['interested_in']) ? $_POST['interested_in'] : '',
        'gender' =>  isset($_POST['gender']) ? $_POST['gender'] : '',
        'age' =>  isset($_POST['age']) ? $_POST['age'] : '',
        'fullname' =>  isset($_POST['fullname']) ? $_POST['fullname'] : '',
        'study_at' =>  isset($_POST['study_at']) ? $_POST['study_at'] : '',
        'experience' =>  isset($_POST['experience']) ? $_POST['experience'] : '',
        'surgeries' =>  isset($_POST['surgeries']) ? $_POST['surgeries'] : '',
        'specialist' =>  isset($_POST['specialist']) ? $_POST['specialist'] : '',
        'work_at' =>  isset($_POST['work_at']) ? $_POST['work_at'] : ''
    ];
   
    $user_current = opal_get_current_user();
    
    $isEmailExists = email_exists($user_current['email']);
    $user_id = '';
    $success = false;
    $error_message = '';
    $role = (isset($user_current['role']) && $user_current['role']=='doctor') ? 'doctor' : 'normal';
    
    if ($isEmailExists) {
        
        $userdata = array(
            'ID' => $user_current['id'],
        );


        if(!empty($input['fullname'])){
            $userdata['display_name'] = $input['fullname'];
            $userdata['nickname'] = $input['fullname'];
            $userdata['user_nicename'] = sanitize_title($input['fullname']);
            
        }elseif(!empty($input['username'])){
            $userdata['display_name'] = $input['username'];
            $userdata['nickname'] = $input['username'];
            $userdata['user_nicename'] = sanitize_title($input['username']);
        }
       
       
        $user_id = wp_update_user($userdata);

        
        
       
        // On success.
        if ( ! is_wp_error( $user_id ) ) {
           
            wp_clear_auth_cookie();
            wp_set_current_user($user_id); // Set the current user detail
            wp_set_auth_cookie($user_id); // Set auth details in cookie
            update_field( 'user_gender', $input['gender'], 'user_'.$user_id );
            update_field( 'user_age', $input['age'], 'user_'.$user_id );
            handling_upload_image('user_'.$user_id, $input['username'], ['image', 'user_avatar']);
          

            if($role == 'normal'){
                update_field( 'interested_in', explode(",",$input['interested_in']), 'user_'.$user_id );
            }elseif($role == 'doctor'){
                
                update_field( 'study_at', $input['study_at'], 'user_'.$user_id );
                update_field( 'experience', $input['experience'], 'user_'.$user_id );
                update_field( 'surgeries', $input['surgeries'], 'user_'.$user_id );
                update_field( 'specialist', explode(",",$input['specialist']), 'user_'.$user_id );
                update_field( 'work_at', $input['work_at'], 'user_'.$user_id );
                handling_upload_image('user_'.$user_id, $input['username'], ['certificated', 'certificated']);
            }
            
            $success = true;
            $error_message = __( 'Update user success', 'opalbeauty');

            if(!empty($_POST['password'])){
                $resetPass = reset_password(wp_get_current_user(), $_POST['password']);
                if (!isset($resetPass->errors)) {
                    $success = true;
                    $auth = wp_authenticate($user_current['email'], $_POST['password']);
                    if (!isset($auth->errors)) { // Login success
                        wp_clear_auth_cookie();
                        wp_set_current_user($auth->data->ID); // Set the current user detail
                        wp_set_auth_cookie($auth->data->ID); // Set auth details in cookie
                    }
                } else {
                    $success = false;
                    $error_message = __( 'Password error, please re-enter password', 'opalbeauty');
                }
            }
            
        }else{
            $success = false;
            $error_message = __( 'Please re-enter other registration information', 'opalbeauty');
        }
      
        
       

        // Send email to user if register successful
        // $headers = array('Content-Type: text/html; charset=UTF-8');
        // $body = get_field('mail_welcome', 'option');
       
        // wp_mail($input['email'], sprintf(__('[%s] Welcome'), get_option('blogname')), $body, $headers);
    } else {
        $success = false;
        $error_message = __( 'Email does not exist', 'opalbeauty');
    }
    
    //$result = ob_get_clean();
    wp_send_json_success(
        (object) array(
            'success' => $success,
            'moderated' => $role == 'doctor' ? true : false,
            'message' => $error_message
        )
    );
    // wp_send_json_success(
    //     (object) array(
    //         'status' => json_encode(array(
    //             date("d/m/Y").' - CargoNetwork standard member Invoice',
    //             date("d/m/Y").' - CargoNetwork standard member Invoice'
    //         )),
    //     )
    // );
    die();
}

function rand_string($length) {
    $str="";
    $chars = "subinsblogabcdefghijklmanopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $size = strlen($chars);
    for($i = 0;$i < $length;$i++) {
     $str .= $chars[rand(0,$size-1)];
   }
   return $str;
}
function handling_upload_image($user_id, $username, $field){
    try {
        
        // $attachment_id = '';
        // $attach = '';
        // if(empty($_FILES[$field[0]])){
        //     return;
        // }
        // $file = $_FILES[$field[0]];
        
        
        // // $filename should be the path to a file in the upload directory.
        // $filename = $file['name'];

        // // The ID of the post this attachment is for.
        // $parent_post_id =$user_id;

        // // Check the type of file. We'll use this as the 'post_mime_type'.
        // $filetype = wp_check_filetype(basename($filename), null);
        // if($filetype['ext']){
        //     $filename = sanitize_title(trim($filename, $filetype['ext'])).'.'.$filetype['ext'];
        // }
        //  // Move file to wp-content
        //  $body   = @file_get_contents( $files_tmp_name[$key] );
        //  $file   = wp_upload_bits( $filename, null, $body );
        // // Get the path to the upload directory.
        // $wp_upload_dir = wp_upload_dir(date("Y/m"));
        // $path = $wp_upload_dir['url'] . '/' . basename($filename);

        // // Prepare an array of post data for the attachment.
        // $attachment = array(
        //     'guid'           => $path,
        //     'post_mime_type' => $filetype['type'],
        //     'post_title'     => preg_replace('/\.[^.]+$/', '', basename($filename)),
        //     'post_content'   => '',
        //     'post_status'    => 'inherit'
        // );

        // // Insert the attachment.
        // $attach_id = wp_insert_attachment($attachment, $path, null);

        // // Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
        // require_once(ABSPATH . 'wp-admin/includes/image.php');

        // // Generate the metadata for the attachment, and update the database record.
        // $attach_data = wp_generate_attachment_metadata($attach_id, $filename);
        // wp_update_attachment_metadata($attach_id, $attach_data);

        // // Upload image to folder
        // wp_upload_bits($filename, null, file_get_contents($file['tmp_name']));

        
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/image.php';


       if(empty($_FILES[$field[0]])){
            return;
        }
        $file = $_FILES[$field[0]];
       
        // Get basic attributes
        $files_name = $file[ 'name' ];
        $files_tmp_name = $file[ 'tmp_name' ];
    
        $filename   = basename( $files_name );
        $mime       = wp_check_filetype( $filename );
    
        // Get the content type from response headers
        $type   = !empty( $mime[ 'type' ] ) ? $mime[ 'type' ] : $file[ 'type' ];
        $ext    = !empty( $mime[ 'ext' ] ) ? $mime[ 'ext' ] : trim( explode( '|' , array_search( $type, get_allowed_mime_types() ) )[ 0 ] );
    
        // Basic checks
        if ( !$type || !$ext || ( !empty( $allowed ) && is_array( $allowed ) && !in_array( $ext, $allowed ) ) ) {
            // Not a valid file
            return new WP_Error( 'upload', 'Invalid file type. Please try another file.' );
        }
        
        // Move file to wp-content
        $body   = @file_get_contents( $files_tmp_name );
        $file   = wp_upload_bits( $filename, null, $body );
    
        // Upload check
        if ( !empty( $file[ 'error' ] ) ) {
            return new WP_Error( 'upload', $file[ 'error' ] );
        }
        
        // Write attachment location to the database
        $attachment_id = wp_insert_attachment( [
            'post_title'        => $filename,
            'post_mime_type'    => $file[ 'type' ]
        ], $file[ 'file' ], $user_id, true );
    
        if ( is_wp_error( $attachment_id ) ) {
            return null;
        }

        // Set image for post
        update_field( $field[1],  $attachment_id, $user_id );
    } catch (\Throwable $th) {
        return __( 'Unable to upload please try again', 'opalbeauty');
    }
}
// function handling_upload_images($post_id, $field){
//     try {
        
//         require_once(ABSPATH . 'wp-admin/includes/image.php');
//         $wp_upload_dir = wp_upload_dir(date("Y/m"));
//         $attachment_id = '';
//         $attach = '';
//         $parent_post_id =$post_id;
//         $file = $_FILES[$field[0]];
//         $arrAttachment = [];
//         if(!$file){
//             return;
//         }
//         $filesname = $file['name'];
//         // $filename should be the path to a file in the upload directory.
//         foreach ($filesname as $key => $value) {
//             $filename = $value;
         
//             // Check the type of file. We'll use this as the 'post_mime_type'.
//             $filetype = wp_check_filetype(basename($filename), null);
           
//             if($filetype['ext']){
//                 $filename = sanitize_title(trim($filename, $filetype['ext'])).'.'.$filetype['ext'];
//             }
           
//             // Get the path to the upload directory.
          
//             $path = $wp_upload_dir['url'] . '/' . basename($filename);
    
//             // Prepare an array of post data for the attachment.
//             $attachment = array(
//                 'guid'           => $path,
//                 'post_mime_type' => $filetype['type'],
//                 'post_title'     => preg_replace('/\.[^.]+$/', '', basename($filename)),
//                 'post_content'   => '',
//                 'post_status'    => 'inherit'
//             );
    
//             // Insert the attachment.
//             $attach_id = wp_insert_attachment($attachment, $path, null);
           
            
//             // Upload image to folder
//             wp_upload_bits($filename, null, file_get_contents($file['tmp_name'][$key]));
//             $arrAttachment[]= $attach_id;
//         }
//         // Set image for post
     
//         return $arrAttachment;
//     } catch (\Throwable $th) {
//         return __( 'Unable to upload please try again', 'opalbeauty');
//     }
// }

add_action( 'template_redirect', 'check_user_login' );
function check_user_login(){
    
    if ( is_page_template( 'page-register2.php' ) ) {
        register2_redirect('login');
    }else if( is_page_template( 'page-register.php' )){
        logged_in_redirect('account');
    }else if(is_page_template( 'page-login.php' ) || is_page_template( 'page-forgot.php' )){
        logged_in_redirect('');
    }else if( is_page_template( 'page-welcome.php' )){
        redirect_url('login');
    }else if(!is_admin()){
        not_logged_in_redirect('login');
        
        if(is_page_template( 'page-edit-question.php' )){
            
            $current_user_posts = get_author_question();
           
            if(count($current_user_posts['post']) < 1){
                redirect_url('question');
            }
        }elseif(is_page_template( 'page-edit-review.php' )){
            $current_user_posts = get_author_question(null, 'review');
            
            if(count($current_user_posts['post']) < 1){
                wp_redirect(get_author_posts_url(get_current_user_id()).'?post=review');
                exit;
            }
        }elseif(is_author()){
            $user_author_current = get_userdata(get_query_var('author'));
            $checkRoles = false;
            if($user_author_current->roles && is_array( $user_author_current->roles )){
                $checkRoles = array_intersect( ['normal', 'doctor'], $user_author_current->roles ) ? true : false;
            }
            if(!$checkRoles) logged_in_redirect('');
          
        }

        // $cookie_name = 'pages_history';

       
        // global $wp;
        // $current_slug = add_query_arg( array(), $wp->request );
        // $newCookie = [];
        // if(
        //     $current_slug == '' ||
        //     $current_slug == 'event' ||
        //     $current_slug == 'question' ||
        //     $current_slug == 'review'
        // ){
        //     $newCookie[] = $current_slug;
        // }else{
        //     $cookie_value = [];
        
        //     if(empty($_COOKIE[$cookie_name]) || empty($cookie_value)){
        //         $cookie_value = [];
        //     }else{
        //         $cookie_value = explode(",",$cookie_value);
        //     }
            
        //     $length_cookie_value = count($cookie_value);
        //     $cookie_value = array_slice($cookie_value,-5,5);
        //     $checkHave = 0;
        //     foreach($cookie_value as $cv){
        //         if($cv == $current_slug){
        //             continue;
        //         }
        //         $newCookie[] = $cv;
        //     }
        //     if(!is_404()){
        //         $newCookie[] = $current_slug;
        //     }
           
        // }
        
        
        // setcookie($cookie_name, implode(",", $newCookie), time()+86400, "/");
       
        
    }

}
// function get_back_url(){
  
//     $cookie_name = 'pages_history';
//     $cookie_value = $_COOKIE[$cookie_name];
  
//     if(empty($_COOKIE[$cookie_name]) || empty($cookie_value)){
//         $cookie_value = [];
//     }else{
//         $cookie_value = explode(",",$cookie_value);
//     }

//     $newCookie = array_reverse($cookie_value);
//     var_dump(23, $newCookie);
//     if(empty($newCookie) || empty($newCookie[0]) || empty($newCookie[1])) return get_create_url('');

//     global $wp;
//     $current_slug = add_query_arg( array(), $wp->request );
//     $slugBack = $newCookie[1]; 
   
//     return get_create_url($slugBack);
// }

function get_author_question($post_id = null, $key = 'question'){
    if(!$post_id){
        $post_id = get_query_var('qid');
    }
    
    if(!$post_id){
        return [
            'id' => null,
            'post'=> []
        ];
    }
    
    $args = array(
        'post_type' => $key,
        'p'       =>   (int)$post_id,
        'author'        =>   get_current_user_id()
    );
 
    // get his posts 'ASC'
    $post = get_posts( $args );
    
    return [
        'id' => $post_id,
        'post'=> $post
    ];
}

function count_post_type( $key = 'question'){
    $args = array(
        'post_type' => $key,
        'author'        =>   get_current_user_id()
    );
 
    // get his posts 'ASC'
    $countPost = get_posts( $args );
    $c = 0;
    if(!empty($countPost)){
        $c = count($countPost);
    }
    return $c;
}



add_filter('query_vars', 'add_my_var');
function add_my_var($vars) {
    $vars[] = 'u';
    $vars[] = 'rate';
    $vars[] = 'field_service';
    $vars[] = 'd';
    $vars[] = 'qid';
    $vars[] = 'post';
    
    return $vars;
}

function register2_redirect($url){
    $cookie_name = "ulg";
    $userCookie = isset($_COOKIE[$cookie_name]) ? $_COOKIE[$cookie_name] : '';
   
    $user = secured_decrypt($userCookie);
        
    if($user && $user->email &&  $user->password){
        return;
    }
    
    redirect_url($url);
}

function not_logged_in_redirect($url){
    if ( is_user_logged_in()) {
        return;
    }
    
    redirect_url($url);
}
function logged_in_redirect($url){
    if ( is_user_logged_in() ) {
        redirect_url($url);
    }
}
function redirect_url($url){
    wp_redirect(esc_url(home_url('/'.$url)));
    exit;
}

function opal_get_current_user(){
    $user = [
        'id' => '',
        'avatar'=> '',
        'username'=> '',
        'display'=> '',
        'password'=>'',
        'email'=> '',
        'gender'=> field_gender(),
        'age'=> '',
        'interested_in'=> field_specialist(),
        'full_name'=>'',
        'study_at'=>'',
        'experience'=>'',
        'surgeries'=>'',
        'specialist'=>  field_specialist(),
        'work_at'=>'',
        'certificated'=>'',
        'role'=>'',
        'is_doctor'=>false
    ];
    if ( is_user_logged_in()){
        $user_current = wp_get_current_user();
        
        $user_id = $user_current->ID;
        $user['id'] = $user_id;
        $user['username']  = $user_current->user_login;
        $user['display']  = $user_current->display_name;
        $user['email']  = $user_current->user_email;
        $user['role']  = $user_current->roles[0];
        $user['avatar']  = get_field('user_avatar', 'user_'.$user_current->ID);
        $user['gender'][get_field('user_gender', 'user_'.$user_current->ID)]  = 'selected';
        $user['age']  = get_field('user_age', 'user_'.$user_current->ID);
        $arrInterested_in  = get_field('interested_in', 'user_'.$user_current->ID);
       

        if($arrInterested_in){
            foreach ($arrInterested_in as $val) {
                $user['interested_in'][$val] = 'checked';
            }
        }
        
            
      
        if( $user['role'] == 'doctor' ) {
            $user['is_doctor'] = get_field('moderated', 'user_'.$user_current->ID) ? true : false;
            $specialist  = get_field('specialist', 'user_'.$user_current->ID);
            if($specialist){
                foreach ($specialist as $val) {
                    $user['specialist'][$val] = 'checked';
                }
            }

            $user['study_at']  = get_field('study_at', 'user_'.$user_current->ID);
            $user['experience']  = get_field('experience', 'user_'.$user_current->ID);
            $user['surgeries']  = get_field('surgeries', 'user_'.$user_current->ID);
            $user['work_at']  = get_field('work_at', 'user_'.$user_current->ID);
            $user['certificated']  = get_field('certificated', 'user_'.$user_current->ID);
        }
        
    }else{
        $cookie_name = "ulg";
        $userCookie = isset($_COOKIE[$cookie_name]) ? $_COOKIE[$cookie_name] : '';
        $user_current = secured_decrypt($userCookie);

        if($user_current && $user_current->email &&  $user_current->password){
            $user['email'] = $user_current->email ;
            $user['password'] = $user_current->password ;
            $user['role'] = isset($user_current->u) ? $user_current->u : ''  ;
        }
    }
    
   

    return $user;
}


// Save The Keys In Your Configuration File
define('FIRSTKEY','kGYj3dwPs5p9UQnfXgDsYdhIPG0zTbz8pBl30NJxZ4c=');
define('SECONDKEY','zpVTXG3WRYm4aXzNAu4y5bJi/bwjT2TVUCtLqf3hpeK44qbmYezPnBhvcTzyJEmvTkCgkOVvcjubBqQdnZF9mw==');


function secured_encrypt($data)
{
    $data = base64_encode(json_encode($data));
    $first_key = base64_decode(FIRSTKEY);
    $second_key = base64_decode(SECONDKEY);   
    
    $method = "aes-256-cbc";   
    $iv_length = openssl_cipher_iv_length($method);
    $iv = openssl_random_pseudo_bytes($iv_length);
        
    $first_encrypted = openssl_encrypt($data,$method,$first_key, OPENSSL_RAW_DATA ,$iv);   
    $second_encrypted = hash_hmac('sha3-512', $first_encrypted, $second_key, TRUE);
            
    $output = base64_encode($iv.$second_encrypted.$first_encrypted);   
    return $output;       
}


function secured_decrypt($input)
{
    $first_key = base64_decode(FIRSTKEY);
    $second_key = base64_decode(SECONDKEY);           
    $mix = base64_decode($input);
        
    $method = "aes-256-cbc";   
    $iv_length = openssl_cipher_iv_length($method);
            
    $iv = substr($mix,0,$iv_length);
    $second_encrypted = substr($mix,$iv_length,64);
    $first_encrypted = substr($mix,$iv_length+64);
            
    $data = openssl_decrypt($first_encrypted,$method,$first_key,OPENSSL_RAW_DATA,$iv);
    $second_encrypted_new = hash_hmac('sha3-512', $first_encrypted, $second_key, TRUE);
    
    if (hash_equals($second_encrypted,$second_encrypted_new))
        return json_decode(base64_decode($data));
    
    return false;
}


// PRINT FUNCTIONS
function post_rating(){
    echo get_post_rating();
}
function get_post_rating(){
    return get_post_meta(get_the_ID(), 'wpdiscuz_post_rating_beauty_rating', true);
}
function post_rating_html(){
    echo get_html_rating(get_post_meta(get_the_ID(), 'wpdiscuz_post_rating_beauty_rating', true)); 
}

function get_html_rating($ratingData) {
    if(!is_numeric($ratingData)) return;

    $html = "";
    $fullStarSVG = '<img src="'.get_theme_path("/assets/images/full-star.svg").'">';
    $whiteStarSVG = '<img src="'.get_theme_path("/assets/images/white-star.svg").'">';
    
    
    $html .= "<div class='rating-stars'>";
    $prefix = (int) $ratingData;
    
    $suffix = $ratingData - $prefix;
    if ($prefix) {
        for ($i = 1; $i < 6; $i++) {
            if ($i <= $prefix) {
                $html .= $fullStarSVG;
            } else if ($suffix && $i - $prefix === 1) {
                $html .= $whiteStarSVG;
            } else {
                $html .= $whiteStarSVG;
            }
        }
    } else if ($suffix) {
        $html .= $fullStarSVG . str_repeat($whiteStarSVG, 4);
    } else {
        $html .= str_repeat($whiteStarSVG, 5);
    }

    $html .= "</div>";
       

    return $html;
}


add_filter( 'wpdiscuz_full_star_svg', 'full_star_svg', 10, 3 );
function full_star_svg( $string ) {
    return '<svg width="23" height="24" viewBox="0 0 23 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M11.3146 1.45847C11.382 1.29178 11.618 1.29178 11.6854 1.45847L14.4409 8.27199C14.4695 8.34284 14.5361 8.39116 14.6123 8.39652L21.9438 8.91164C22.1232 8.92424 22.1961 9.14869 22.0584 9.26432L16.4299 13.9904C16.3713 14.0396 16.3459 14.1178 16.3644 14.1919L18.1401 21.3238C18.1835 21.4983 17.9926 21.637 17.84 21.5418L11.6059 17.6491C11.5411 17.6087 11.4589 17.6087 11.3941 17.6491L5.15995 21.5418C5.00744 21.637 4.81651 21.4983 4.85995 21.3238L6.63561 14.1919C6.65407 14.1178 6.62866 14.0396 6.57014 13.9904L0.941586 9.26432C0.803886 9.14869 0.876815 8.92424 1.05618 8.91164L8.38771 8.39652C8.46394 8.39116 8.53046 8.34284 8.55911 8.27199L11.3146 1.45847Z" fill="#EBEBE6"/>
    <path class="wpd-star" d="M11.3146 0.45847C11.382 0.291781 11.618 0.291782 11.6854 0.458471L14.4409 7.27199C14.4695 7.34284 14.5361 7.39116 14.6123 7.39652L21.9438 7.91164C22.1232 7.92424 22.1961 8.14869 22.0584 8.26432L16.4299 12.9904C16.3713 13.0396 16.3459 13.1178 16.3644 13.1919L18.1401 20.3238C18.1835 20.4983 17.9926 20.637 17.84 20.5418L11.6059 16.6491C11.5411 16.6087 11.4589 16.6087 11.3941 16.6491L5.15995 20.5418C5.00744 20.637 4.81651 20.4983 4.85995 20.3238L6.63561 13.1919C6.65407 13.1178 6.62866 13.0396 6.57014 12.9904L0.941586 8.26432C0.803886 8.14869 0.876815 7.92424 1.05618 7.91164L8.38771 7.39652C8.46394 7.39116 8.53046 7.34284 8.55911 7.27199L11.3146 0.45847Z" fill="white"/>
    </svg>
    ';
}

function get_notification(){
    global $wpdb;
   
    $data = [];
    $user = wp_get_current_user();
   

    $user_roles = $user->roles;
    if(empty(array_intersect($user_roles, ['doctor', 'normal']))){
        return null;
    }
    $user_id = $user->ID;
    $user_registered = $user->user_registered;
   
    update_field( 'read_notification', current_time('mysql'), 'user_'.$user_id );

    $result = notifi_user_event_register($user_id );

    $text_sql = "SELECT n.*, au.display_name  FROM {$wpdb->prefix}notification as n
    -- INNER JOIN {$wpdb->prefix}users
    -- ON {$wpdb->prefix}notification.user_id = {$wpdb->prefix}users.ID
    LEFT JOIN {$wpdb->prefix}users as au
    ON n.assigned_user = au.ID
    WHERE
    (
        (n.user_id !=%d AND n.notification_text IN ('added_event', 'posted_review', 'posted_question', 'update_new_spa'))
        OR
        n.user_id=%d AND (
            (n.assigned_user IS NOT NULL AND n.assigned_user != %d) 
            OR (n.notification_text IN ('approved_doctor', 'refuse_doctor')) 
        ) 
    ";
    
    if(isset($result[0])){
        $text_sql .= " or n.post_id IN (".implode(',',$result)."))";
    }else{
        $text_sql .= " )";
    }
    $text_sql .= "AND n.notification_time > %s";
    $text_sql .= "ORDER BY notification_time DESC LIMIT %d";

    $results = $wpdb->get_results(
        $wpdb->prepare(
            $text_sql,
            $user_id,
            $user_id,
            $user_id,
            $user_registered,
            get_option( 'posts_per_page' )
        )
    );
    
    foreach ($results as $value) {
        
        $hanlding_data = hanlding_notification($value->notification_text, $value)[$value->notification_text];
         
       if(!empty($hanlding_data)){
            $hanlding_data['notification_id'] = $value->notification_id;
            $hanlding_data['time'] = human_time_diff( strtotime($value->notification_time), strtotime( wp_date( 'Y-m-d H:i:s' ) ));
            // $hanlding_data['time'] = opal_dateDiff($value->notification_time);
            $hanlding_data['read'] = 'unread-active';
            if(!empty($value->notification_read)){
                $hanlding_data['read'] = '';
            }
            $data[] =  $hanlding_data;
            
       }
    }
    return $data;
}

function count_unread_notification(){
    global $wpdb;
   
    $data = [];
    $user = wp_get_current_user();
    $user_registered = $user->user_registered;
    
    $user_id = $user->ID;
    $readNotification = get_field( 'read_notification', 'user_'.$user_id );
    if(!empty($readNotification)){
        $user_registered = $readNotification;
    }
    $result = notifi_user_event_register($user_id);


    $text_sql = "SELECT COUNT(notification_id) AS NumberOfNotification  FROM {$wpdb->prefix}notification as n
    -- INNER JOIN {$wpdb->prefix}users
    -- ON {$wpdb->prefix}notification.user_id = {$wpdb->prefix}users.ID
    LEFT JOIN {$wpdb->prefix}users as au
    ON n.assigned_user = au.ID
    WHERE
    (
        (n.user_id !=%d AND n.notification_text IN ('added_event', 'posted_review', 'posted_question', 'update_new_spa'))
        OR
        n.user_id=%d AND (
            (n.assigned_user IS NOT NULL AND n.assigned_user != %d) 
            OR (n.notification_text IN ('approved_doctor', 'refuse_doctor')) 
        ) 
    ";
    
    if(isset($result[0])){
        $text_sql .= " or n.post_id IN (".implode(',',$result)."))";
    }else{
        $text_sql .= " )";
    }
    $text_sql .= "AND n.notification_time > %s";
    $text_sql .= "ORDER BY notification_time DESC";
    

    $results = $wpdb->get_var(
        $wpdb->prepare(
            $text_sql,
            $user_id,
            $user_id,
            $user_id,
            $user_registered
        )
    );
    if(!$results){
        $results = 0;
    }

    return $results;

}


function opal_dateDiff($datetime) {
    $text = "";
    if ($datetime) {
        $now = new DateTime();
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
        
        if ($diff->y) {
            $text =  $diff->y;
            $text .=  $diff->y > 1 ? __( 'y', 'opalbeauty') : __( 'y', 'opalbeauty');
        } else if ($diff->m) {
            $text = $diff->m;
            $text .= $diff->m > 1 ? __( 'M', 'opalbeauty') : __( 'M', 'opalbeauty');
        } else if ($diff->d) {
            $text = $diff->d;
            $text .= $diff->d > 1 ? __( 'd', 'opalbeauty') : __( 'd', 'opalbeauty');
        } else if ($diff->h) {
            $text = $diff->h;
            $text .= $diff->h > 1 ? __( 'h', 'opalbeauty') : __( 'h', 'opalbeauty');
        } else if ($diff->i) {
            $text = $diff->i;
            $text .= $diff->i > 1 ? __( 'm', 'opalbeauty') : __( 'm', 'opalbeauty');
        } else if ($diff->s) {
            $text = $diff->s;
            $text .= $diff->s > 1 ? __( 's', 'opalbeauty') : __( 's', 'opalbeauty');
        }
    }
    if (!$text) {
        $text = esc_html(__( 'Now', 'opalbeauty'));
    }
    return $text;
}



function hanlding_notification($key, $value){
    return [
        arr_notification()['love_question'][0] => hanlding_notification_love_question($key, $value),
        arr_notification()['answered_question'][0] => hanlding_notification_answered_question($key,$value),
        arr_notification()['love_review'][0] => hanlding_notification_love_review($key,$value),
        arr_notification()['commented_review'][0] => hanlding_notification_commented_review($key,$value),
        arr_notification()['registered_event'][0] => hanlding_notification_registered_event($key,$value),
        arr_notification()['reply_comment_question'][0] => hanlding_notification_reply_comment($key,$value),
        arr_notification()['reply_comment_review'][0] => hanlding_notification_reply_comment($key,$value),
        arr_notification()['added_event'][0] => hanlding_notification_added_event($key,$value),
        arr_notification()['posted_review'][0] => hanlding_notification_posted_review($key,$value),
        arr_notification()['posted_question'][0] => hanlding_notification_posted_question($key,$value),
        arr_notification()['update_new_spa'][0] => hanlding_notification_update_new_spa($key,$value),
        arr_notification()['event_deleted'][0] => hanlding_notification_event_deleted($key,$value),
        arr_notification()['update_event'][0] => hanlding_notification_update_event($key,$value),
        arr_notification()['refuse_doctor'][0] => hanlding_notification_refuse_doctor($key,$value),
        arr_notification()['approved_doctor'][0] => hanlding_notification_approved_doctor($key,$value)
    ];
}

function hanlding_notification_love_question($key, $value){
    if(empty($value->display_name)){
        return null;
    }
    $img = get_field('user_avatar', 'user_'.$value->assigned_user);
   
    return [
        'image' => $img ? $img : get_theme_path("/assets/images/user-icon.svg"),
        'title' => $value->display_name. ' '. arr_notification()[$key][1],
        'link' => get_the_permalink($value->post_id),
        'image_link' => get_author_posts_url($value->assigned_user)
    ];
}

function hanlding_notification_answered_question($key, $value){
    if(empty($value->display_name)){
        return null;
    }
    $img = get_field('user_avatar', 'user_'.$value->assigned_user);

    return [
        'image' => $img ? $img : get_theme_path("/assets/images/user-icon.svg"),
        'title' => $value->display_name. ' '. arr_notification()[$key][1],
        'link' => get_the_permalink($value->post_id),
        'image_link' => get_author_posts_url($value->assigned_user)
    ];
}
function hanlding_notification_love_review($key, $value){
    if(empty($value->display_name)){
        return null;
    }
    $img = get_field('user_avatar', 'user_'.$value->assigned_user);
    return [
        'image' => $img ? $img : get_theme_path("/assets/images/user-icon.svg"),
        'title' => $value->display_name. ' '. arr_notification()[$key][1],
        'link' => get_the_permalink($value->post_id),
        'image_link' => get_author_posts_url($value->assigned_user)
    ];
}
function hanlding_notification_commented_review($key, $value){
    if(empty($value->display_name)){
        return null;
    }
    $img = get_field('user_avatar', 'user_'.$value->assigned_user);
    return [
        'image' => $img ? $img : get_theme_path("/assets/images/user-icon.svg"),
        'title' => $value->display_name. ' '. arr_notification()[$key][1],
        'link' => get_the_permalink($value->post_id),
        'image_link' => get_author_posts_url($value->assigned_user)
    ];

}
function hanlding_notification_reply_comment($key, $value){
    if(empty($value->display_name)){
        return null;
    }
    $img = get_field('user_avatar', 'user_'.$value->assigned_user);
    return [
        'image' => $img ? $img : get_theme_path("/assets/images/user-icon.svg"),
        'title' => $value->display_name. ' '. arr_notification()[$key][1],
        'link' => get_the_permalink($value->post_id),
        'image_link' => get_author_posts_url($value->assigned_user)
    ];
}
function hanlding_notification_registered_event($key, $value){
    if(empty($value->display_name)){
        return null;
    }
    $img = get_field('user_avatar', 'user_'.$value->assigned_user);
    return [
        'image' => $img ? $img : get_theme_path("/assets/images/user-icon.svg"),
        'title' => $value->display_name. ' '. arr_notification()[$key][1],
        'link' => get_the_permalink($value->post_id),
        'image_link' => get_author_posts_url($value->assigned_user)
    ];
}
function hanlding_notification_added_event($key, $value){
    
    $img = get_the_post_thumbnail_url($value->post_id);
    return [
        'image' => $img ? $img : get_theme_path("/assets/images/user-icon.svg"),
        'title' => arr_notification()[$key][1],
        'link' => get_the_permalink($value->post_id),
        'image_link' => get_the_permalink($value->post_id),
    ];
}
function hanlding_notification_posted_review($key, $value){
    $user_data = get_userdata( $value->user_id );
    if(empty($user_data)){
        return null;
    }
    $img = get_field('user_avatar', 'user_'.$value->user_id);
    
    return [
        'image' => $img ? $img : get_theme_path("/assets/images/user-icon.svg"),
        'title' =>  $user_data->display_name. ' '. arr_notification()[$key][1],
        'link' => get_the_permalink($value->post_id),
        'image_link' => get_author_posts_url($value->user_id)
    ];
}
function hanlding_notification_posted_question($key, $value){
    $user_data = get_userdata( $value->user_id );
    if(empty($user_data)){
        return null;
    }
    $img = get_field('user_avatar', 'user_'.$value->user_id);

    return [
        'image' => $img ? $img : get_theme_path("/assets/images/user-icon.svg"),
        'title' =>  $user_data->display_name. ' '. arr_notification()[$key][1],
        'link' => get_the_permalink($value->post_id),
        'image_link' => get_author_posts_url($value->user_id)
    ];
}
function hanlding_notification_update_new_spa($key, $value){
    if(empty($value->display_name)){
        return null;
    }
    $img = get_the_post_thumbnail_url($value->post_id);
    return [
        'image' => $img ? $img : get_theme_path("/assets/images/user-icon.svg"),
        'title' => $value->display_name. ' '. arr_notification()[$key][1],
        'link' => get_the_permalink($value->post_id),
        'image_link' => get_author_posts_url($value->assigned_user)
    ];
}
function hanlding_notification_event_deleted($key, $value){
    if(empty($value->display_name)){
        return null;
    }
    $img = get_the_post_thumbnail_url($value->post_id);
    return [
        'image' => $img ? $img : get_theme_path("/assets/images/user-icon.svg"),
        'title' => $value->display_name. ' '. arr_notification()[$key][1],
        'link' => get_the_permalink($value->post_id),
        'image_link' => get_author_posts_url($value->assigned_user)
    ];
}
function hanlding_notification_update_event($key, $value){
    $img = get_the_post_thumbnail_url($value->post_id);
    return [
        'image' => $img ? $img : get_theme_path("/assets/images/user-icon.svg"),
        'title' => arr_notification()[$key][1],
        'link' => get_the_permalink($value->post_id),
        'image_link' => get_the_permalink($value->post_id),
    ];
}
function hanlding_notification_refuse_doctor($key, $value){
    
    return [
        'image' => get_theme_path("/assets/images/notifi-doctor.svg"),
        'title' => $value->display_name. ' '. arr_notification()[$key][1],
        'link' => get_the_permalink($value->post_id),
        'image_link' => get_author_posts_url($value->assigned_user)
    ];
}
function hanlding_notification_approved_doctor($key, $value){
    $img = get_field('user_avatar', 'user_'.$value->assigned_user);
    return [
        'image' =>  get_theme_path("/assets/images/notifi-doctor.svg"),
        'title' => $value->display_name. ' '. arr_notification()[$key][1],
        'link' => get_the_permalink($value->post_id),
        'image_link' => get_author_posts_url($value->assigned_user)
    ];
}


function insert_notification_doctor($text, $user_id){
    global $wpdb;
    $arrColVal = array(
        'notification_text' => $text[0],
        'user_id' => $user_id,
        'notification_time'=> current_time('mysql')
    );
    $arrType=array(
        '%s',
        '%d',
        '%s',
    );
    $checkInsert = $wpdb->insert($wpdb->prefix.'notification', $arrColVal, $arrType);
}

//      

function insert_notification_event($text, $post_id){
    global $wpdb;
    // $result = $wpdb->get_row(
    //     $wpdb->prepare(
    //         "SELECT * FROM {$wpdb->prefix}notification WHERE event_id=%d ORDER BY notification_id DESC",
    //         $event_id
    //     )
    // );
    // if($result){
    //     var_dump($result->notification_time, strtotime($result->notification_time), strtotime(date('Y-m-d H:i:s') . ' +3 seconds'));
    //     if(strtotime($result->notification_time) < strtotime(date('Y-m-d H:i:s') . ' +3 seconds')){
    //         return;
    //     }
    // }
    
    $author_id = get_post_field( 'post_author', $post_id );

    if(!empty($author_id)){
        if(empty($assigned_user)){
            $assigned_user = null;
        }
        
        $arrColVal = array(
            'notification_text' => $text[0],
            'user_id' => $author_id,
            'post_id'=> $post_id,
            'notification_time'=> current_time('mysql')
        );
        $arrType=array(
            '%s',
            '%d',
            '%d',
            '%s'
        );
        $checkInsert = $wpdb->insert($wpdb->prefix.'notification', $arrColVal, $arrType);
    }
   
    
}


function insert_notification($notification_text, $assigned_user, $post_id){
    global $wpdb;
    $author_id = get_post_field( 'post_author', $post_id );
   
    if(!empty($author_id)){
        if(empty($assigned_user)){
            $assigned_user = null;
        }
        $text = '';
        if($notification_text){
            $text = $notification_text[0];
        }else{
            $post_type = get_post_field( 'post_type', $post_id );
            switch ($post_type) {
                case 'question':
                    $text = arr_notification()['answered_question'][0];
                    break;
                case 'review':
                    $text = arr_notification()['commented_review'][0];
                    break;
                default:
                    $text = 0;
            }
        }
        
        $arrColVal = array(
            'notification_text' => $text,
            'user_id' => $author_id,
            'assigned_user'=> $assigned_user,
            'notification_time'=> current_time('mysql'),
            'post_id' => $post_id
        );
        $arrType=array(
            '%s',
            '%d',
            '%d',
            '%s',
            '%d'
        );
        $checkInsert = $wpdb->insert($wpdb->prefix.'notification', $arrColVal, $arrType);
    }
   
    
}



add_action('wp_ajax_nopriv_forgot_password_action', 'forgot_password_action'); // Ajax Login
add_action('wp_ajax_forgot_password_action', 'forgot_password_action'); // Ajax Login
function forgot_password_action(){
    $input = [
        'step' =>  isset($_POST['input']['step']) ? $_POST['input']['step'] : '',
        'email' =>  isset($_POST['input']['email']) ? $_POST['input']['email'] : '',
        'code' =>  isset($_POST['input']['code']) ? $_POST['input']['code'] : '',
        'password' =>  isset($_POST['input']['password']) ? $_POST['input']['password'] : '',
        'confirm_password' =>  isset($_POST['input']['confirm_password']) ? $_POST['input']['confirm_password'] : '',
    ];
    
    $data = [
        'success'=> false
    ];

    if(!empty($input['email'])){
        $isEmailExists = email_exists( $input['email'] );
        
        if ($isEmailExists && $isEmailExists != false) {
            if($input['step'] == 1){
                $arrOTP = [
                    'code' => mt_rand(1111, 9999),
                    'time' => strtotime( wp_date( 'Y-m-d H:i:s' ) . '+5 minutes' )
                ];
                
                update_field( 'otp_password', secured_encrypt($arrOTP), 'user_'.$isEmailExists );
                
                $to = $input['email'];
                $subject = '['.get_option("blogname").']Password Reset';
                $body = '<p>Someone has requested a password reset for the following account</p>';
                $body .= '<p>Code To reset your password</p>';
                $body .= '<strong style="font-size: 64px">'.$arrOTP["code"].'</strong>';
                $headers = array('Content-Type: text/html; charset=UTF-8',$subject);
                
                $sent = wp_mail( $to, $subject, $body, $headers );
                $data['message'] = __( "Can't send 4 digit code to this email", 'opalbeauty');
                if($sent){
                    $data['success'] = true;
                    $data['email'] = $to;
                }

            }elseif($input['step'] == 2){
                $data['message'] = __( '4 digit code is wrong', 'opalbeauty');
                $otp_password_str = get_field('otp_password', 'user_'.$isEmailExists);
                if( $otp_password_str ) {
                    $arrOTP = secured_decrypt($otp_password_str);
                   
                    if(!empty($arrOTP) && !empty($arrOTP->code) ){
                        if($arrOTP->code.'' == $input['code']){
                            $timeCurrent = strtotime( wp_date( 'Y-m-d H:i:s' ));
                            $data['message'] = __( 'Expired 4 digit code', 'opalbeauty');
                            if($timeCurrent <= $arrOTP->time){
                                $data['success'] = true;
                                $data['email'] = $input['email'];
                                $data['code'] = $input['code'];
                            }
                        }
                    }
                }
            }elseif($input['step'] == 3){
                $data['message'] = __( '4 digit code is wrong', 'opalbeauty');
                $otp_password_str = get_field('otp_password', 'user_'.$isEmailExists);
                if( $otp_password_str ) {
                    $arrOTP = secured_decrypt($otp_password_str);
                   
                    if(!empty($arrOTP) && !empty($arrOTP->code) ){
                        if($arrOTP->code.'' == $input['code']){
                            $timeCurrent = strtotime( wp_date( 'Y-m-d H:i:s' ));
                            if($timeCurrent <= $arrOTP->time){
                                $data['message'] = __( 'Password is wrong', 'opalbeauty');
                                if(!empty($input['password']) && !empty($input['confirm_password'])){
                                    if($input['password'] == $input['confirm_password']){
                                        $user_change = get_user_by('id', $isEmailExists);
                                        if ( ! empty( $user_change ) ) {
                                            $resetPass = reset_password($user_change, $input['password']);
                                            if (!isset($resetPass->errors)) {
                                                $data['success'] = true;
                                                $data['message'] = '';
                                            } 
                                        }
                                        
                                    }else{
                                        $data['message'] = __( 'Confirm Password Wrong', 'opalbeauty');
                                    }
                                   
                                }
                            }
                        }
                    }
                }
                
                
                
            }
        }
    }
    

    

    wp_send_json_success(
        (object)$data
    );
    die();
}


add_action('wp_ajax_nopriv_app_social_login', 'app_social_login'); // Ajax Login
add_action('wp_ajax_app_social_login', 'app_social_login'); // Ajax Login
function app_social_login() {
   
	if( !isset( $_POST['web_token']) or !wp_verify_nonce($_POST['web_token'],opalbeauty_NONCE_KEY."applogin" )) die("Invalid Web Token");
	$type = isset($_POST["type"]) ? $_POST['type'] : "";
	$accessToken = $_POST['token'];
   
	if($type == "F"){
		require_once('Facebook/autoload.php' );

		$fb = new Facebook\Facebook([
	      'app_id' => FB_APP_ID, 
	      'app_secret' => FB_APP_SECRET,
	      'default_graph_version' => 'v3.2',
	    ]);

	    $helper = $fb->getRedirectLoginHelper();
	    try {
	    
	    $response = $fb->get('/me?fields=id,name,email', $accessToken);
	    } catch(Facebook\Exceptions\FacebookResponseException $e) {
	    // When Graph returns an error
	    echo 'Graph returned an error: ' . $e->getMessage();
	    exit;
	    } catch(Facebook\Exceptions\FacebookSDKException $e) {
	    // When validation fails or other local issues
	    echo 'Facebook SDK returned an error: ' . $e->getMessage();
	    exit;
	    }
		
	    if (! isset($accessToken)) {
            if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $helper->getError() . "\n";
                echo "Error Code: " . $helper->getErrorCode() . "\n";
                echo "Error Reason: " . $helper->getErrorReason() . "\n";
                echo "Error Description: " . $helper->getErrorDescription() . "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
            }
            exit;
	    }
	    // Logged in
	    $me = $response->getGraphUser();
	 
		if (isset($me['email']) && !is_null($me['email'])) {
	    	app_social_process_user_login($me['email'], $me['name']);
		} else {
			app_social_process_user_login($me['id'].'-facebook'.'@facebook.com', $me['name']);
		}

	    ///////end F
	}elseif($type == "K") {

        $access_token   =  $accessToken;
	    
	    $ch = curl_init();

	    curl_setopt($ch, CURLOPT_URL,"https://kapi.kakao.com/v2/user/me");
	    curl_setopt($ch, CURLOPT_POST, 0);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	        'Authorization: Bearer '.$access_token,
	    ));
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	    $server_output = curl_exec ($ch);
	    $server_output =  json_decode($server_output, true);

	    curl_close ($ch);

	    $kakao_id           = isset($server_output['id']) ? $server_output['id'] : "";
	    $kakao_nickname     = isset($server_output['properties']['nickname']) ? $server_output['properties']['nickname'] : "";
	    $kakao_email        = isset($server_output['kakao_account']['email']) ? $server_output['kakao_account']['email'] : "";

	    if( $kakao_email == "" or $kakao_nickname == "" ){
	        wp_send_json_success(
                (object) array(
                    "login_success" => false,
                    "messenger" => __("Can't login because of missing parameters", 'opalbeauty')
                )
            );
	    }else{
	        app_social_process_user_login($kakao_email, $kakao_nickname );
	    }

		///////////end K
	}elseif($type == "G") {

		$request_url = 'https://oauth2.googleapis.com/tokeninfo?id_token='.$accessToken;
       
        $response_access = file_get_contents($request_url);
        $response_access = json_decode( $response_access, true );
        $email =  isset($response_access["email"]) ? $response_access["email"] : "";
        $name =  isset($response_access["name"]) ? $response_access["name"] : "";
	  	

        if( $email == "" or $name == "" ){
	       

            wp_send_json_success(
                (object) array(
                    "login_success" => false,
                    "messenger" => __("Can't login because of missing parameters", 'opalbeauty')
                )
            );
	    }else{
	        app_social_process_user_login($email, $name );
	    }

		
		////////end G
	}elseif($type == "Z"){
		$code = $accessToken;
        $request_url = 'https://oauth.zaloapp.com/v3/access_token?app_id='.ZALO_APP_ID.'&app_secret='.ZALO_APP_SECRET.'&code='.$code;
        $response_access = file_get_contents($request_url);
        $response_access = json_decode( $response_access, true );
        if (!empty($response_access)){
            $access_token = $response_access['access_token'];
            $profile = file_get_contents('https://graph.zalo.me/v2.0/me?access_token='.$access_token.'&fields=id,birthday,name,gender,picture,email');
            $profile = json_decode( $profile, true );
            $email = $profile['id'].'-zalo@'.$_SERVER['HTTP_HOST'];
            if(isset($profile['id'])){
	        	$email = $profile['id'].'-zalo@'.$_SERVER['HTTP_HOST'];
	        	app_social_process_user_login($email, $profile['name']);
	        }else{
	        	print_r($profile);
	        }
        }

        
        }elseif($type == "A"){
        	if(!empty($_POST['information']) && is_email(explode(":",$_POST['information'])[1])){
        		$email =  explode(":",$_POST['information'])[1];
        		$name =  explode("@",$email)[0];
        		app_social_process_user_login($email, $name);
        	}else{
        		
                wp_send_json_success(
                    (object) array(
                        "login_success" => false,
                        "messenger" => __("Email is required", 'opalbeauty')
                    )
                );
        	}
        	
        }
	
	die();
}


function app_social_process_user_login($email, $name){

	if(!is_email($email)) die("error");
    $isEmailExists = email_exists( $email );
    //$check_user_name = username_exists($email);
    
    if ($isEmailExists === false) {
        
        $input['email'] = $email;
        $input['password'] = $email;
       
        setcookie("ulg", secured_encrypt($input), time() + (86400 * 30), "/"); // 86400 = 1 day;
        echo 'next'; 
        die();
    }
   
    if ( is_wp_error($isEmailExists) ){
        echo $isEmailExists->get_error_message();
    }else{
		wp_clear_auth_cookie();
        $user = wp_set_current_user($isEmailExists);
        wp_set_auth_cookie($isEmailExists,true,is_ssl());
        do_action('wp_login', $user->user_login, $user);
		header('user_id: '.$id_new_user);
		setcookie("USER_ID", $id_new_user,time() + 1209600, "/","", 0); 
        setcookie("IS_LOGIN_BY_SN", "true",time()+1209600, "/","", 0);
        setcookie("APP_LOGIN", "true",time()+1209600, "/","", 0);
		if(is_user_logged_in()) echo 'success'; 
		die();
    }
}



// function app_social_process_user_login($email, $name){

// 	if(!is_email($email)) die("error");
//     $success = false;
//     $isEmailExists = email_exists( $email );

//     $input['email'] = $email;
//     $input['password'] = $email;
    
//     if ($isEmailExists === false) {
//       setcookie("ulg", secured_encrypt($input), time() + (86400 * 30), "/"); // 86400 = 1 day;
//     }

//     wp_send_json_success(
//         (object) array(
//             "login_success" => true,
//             "url" => get_create_url('register2')
//         )
//     );
      
// }

// function app_social_process_user_login($email, $name){

// 	if(!is_email($email)) die("error");
//     $check_user = email_exists( $email );
//     $check_user_name = username_exists($email);

//     if($check_user && $check_user > 0 ){
//         // is exits
//         $id_new_user = $check_user;
//     }else{

//         if($check_user_name && $check_user_name > 0 ){
//             $id_new_user = $check_user_name;
//         }else{
//             $args = array (
//                 'user_login'    =>   $email,
//                 'user_pass'  =>  md5($email),
//                 'user_email'    =>  $email,
//                 'role'	=> "subscriber",
//                 'display_name'      =>  strip_tags($name),
//             ) ;

//             $id = wp_insert_user( $args ) ;

//             if(isset($id) && !empty($id)) {
//                 $id_new_user = $id;
//             }else{
//                 return false;
//             }
//         }
//     }

//     if ( is_wp_error($id_new_user) ){
//         echo $id_new_user->get_error_message();
//     }else{
// 		wp_clear_auth_cookie();
//         $user = wp_set_current_user($id_new_user);
//         wp_set_auth_cookie($id_new_user,true,is_ssl());
//         do_action('wp_login', $user->user_login, $user);
// 		header('user_id: '.$id_new_user);
// 		setcookie("USER_ID", $id_new_user,time() + 1209600, "/","", 0); 
//         setcookie("IS_LOGIN_BY_SN", "true",time()+1209600, "/","", 0);
//         setcookie("APP_LOGIN", "true",time()+1209600, "/","", 0);
// 		if(is_user_logged_in()) echo 'success'; 
// 		die();
//     }
// }

// REMOVE HOOK
add_filter('comment_flood_filter', '__return_false');
add_filter('duplicate_comment_id', 'disable_duplicate_comment_id');
function disable_duplicate_comment_id( $example ) {
    return [];
}