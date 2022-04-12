<?php
/**
 * The template for displaying Comments.
 *
 */
?>
	
	<?php if ( post_password_required() ) { ?>
	<div id="comment-section">
		<p class="nopassword"><?php esc_html_e( 'This post is password protected. Enter the password to view any comments.', 'mazada' ); ?></p>
	</div>
	<?php } ?>

	<?php if(wp_count_comments($post->ID)->approved > 0 ){?>
	<div id="comment-section">
		<div class="comment-number post-section-title">
			<h5><?php comments_number(  esc_html__('No Comment','mazada') , esc_html__('1 Comment','mazada'), esc_html__('% Comments','mazada') ); ?></h5>
		</div>
		<div class="title-line"></div>
				
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { // Are there comments to navigate through? ?>
			<div class="comment-navigation">
				<div class="comment-previous"><?php previous_comments_link( __( 'Older Comments <span class="meta-nav"> &rarr;</span>', 'mazada' ) ); ?></div>
				<div class="comment-next"><?php next_comments_link( __( '<span class="meta-nav">&larr;</span> Newer Comments', 'mazada' ) ); ?></div>
				<div class="cleared"></div>
			</div> <!-- .navigation -->
		<?php } // check for comment navigation ?>
		
		<div id="comment-container">
			<ul>
			<?php 
			 $args = array(
				'type=' => 'comment',
				'callback' => 'wope_comment',
				'reverse_top_level' => true,
				'reverse_children'  =>  false,
				'short_ping'  => true,
			); 
			// If comments are closed and there are comments, let's leave a little note, shall we?
			if (  !post_password_required() ) {
				wp_list_comments( $args ); 
			}?> 
			</ul>		
		</div>
		<div class="cleared"></div>
		
	</div>
	<?php }?>
	
	<div id="comment-form" class="content">
		<?php 	// If comments are closed and there are comments, let's leave a little note, shall we?
		if (  comments_open() && post_type_supports( get_post_type(), 'comments' ) ) { ?>
		<?php wope_comment_form(); ?>
		<?php }elseif(post_password_required()){?>
			<p class="comments-are-pass"><?php _e( 'Comments are password protected.', 'mazada' ); ?></p>
		<?php }else{?>
			<p class="comments-are-closed"><?php _e( 'Comments are closed.', 'mazada' ); ?></p>
		<?php }?> 
		<div class="cleared"></div>
	</div>

<?php

//mazada comment forum
function wope_comment_form(){
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	$fields =  array(

  'author' =>
    '<div class="comment-form-author"><label for="author">' . esc_html__( 'Name', 'mazada' ) . '</label> ' .
    ( $req ? '<span class="required">*</span>' : '' ) .
    '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
    '" size="30"' . $aria_req . ' /></div>',

  'email' =>
    '<div class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'mazada' ) . '</label> ' .
    ( $req ? '<span class="required">*</span>' : '' ) .
    '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
    '" size="30"' . $aria_req . ' /></div>'
);

	
	$args = array(
		'fields' => $fields,
		'title_reply' => '<span class="title_reply_label">'.esc_html__( 'Leave Your Reply' , 'mazada'),
		'label_submit' => esc_html__( 'Post Comment' , 'mazada' ),
		'comment_field' => '<div class="comment-form-comment"><label for="comment">' . __( 'Comment', 'mazada' ) . '</label><textarea id="comment" name="comment" cols="45" rows="9" aria-required="true"></textarea></div>',
		'comment_notes_before'	=> '',	
	);
	comment_form($args);
}

//setup comment section
function wope_comment($comment, $args, $depth) {
   	$GLOBALS['comment'] = $comment;
    $comment_content = get_comment_type();

	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div class="comment-entry" >
			<?php if( $comment_content ==  'comment'){ ?>
			<div class="comment-avatar">
				<?php echo get_avatar( $comment->comment_author_email, 60 ); ?>
			</div>
			<div class="comment-info">
				<div class="comment-top">
					<div class="comment-date">
					<?php printf(esc_html__('%1$s at %2$s','mazada'), get_comment_date(),  get_comment_time()) ?>
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"></a><?php edit_comment_link('(Edit)','  ','')?>
					</div>
					<div class="comment-reply">
						<?php comment_reply_link(array_merge( $args, array('reply_text' => esc_html__('REPLY','mazada'),'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
					</div>
					<div class="cleared"></div>
				</div>
				<div class="comment-content content">
				<?php if ($comment->comment_approved == '0'){ ?>
					<div class="comment-awaitting"> 
						<?php esc_html_e('Your comment is awaiting moderation.','mazada') ?>
					</div>
				<?php } ?>
				<?php comment_text(); ?>
				</div>
			</div>
			<div class="cleared"></div>
			<?php }else{ ?>

			<div class="comment-info">
				<div class="comment-top">
				<div class="comment-content content"><?php echo get_comment_author_link($GLOBALS['comment']->comment_ID); ?>						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"></a><?php edit_comment_link('(Edit)','  ','')?></div>
				<div class="cleared"></div>
				</div>
			</div>	
			<?php } ?>
			
			
		</div><!-- End Comment entry-->
	</li>
<?php
}

?>