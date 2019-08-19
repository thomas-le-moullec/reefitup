<?php

/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Ave
 */

// If a post password is required or no comments are given and comments/pings are closed, return.
if ( post_password_required() ) {
	return;
}

?>
<div id="comments" class="comments-area">
		
	<div class="container">

		<div class="row">

			<div class="col-md-8 col-md-offset-2">
			
			<?php 
				
				$req      = get_option( 'require_name_email' );
			    $aria_req = ( $req ? " aria-required='true'" : '' );
			    $html_req = ( $req ? " required='required'" : '' );
			    $html5    = true;
				$fields   =  array(
					'author' => '<div class="col-md-4 col-sm-6"><p class="comment-form-author"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245"' .  $aria_req . $html_req . ' /><span class="input-placeholder" data-split-text="true" data-split-options=\'{ "type": "chars" }\' data-custom-animations="true" data-ca-options=\'{ "triggerHandler": "focus", "triggerTarget": "input", "triggerRelation": "siblings", "offTriggerHandler": "blur", "animationTarget": "all-childs", "delay": 50, "animations": { "translateY": "-20%", "rotateX": -45, "opacity": 0 } }\'>' . esc_html__( 'Name', 'ave' ) . ( $req ? '*' : '' ) . '</span></p></div>',
					            
					'email'  => '<div class="col-md-4 col-sm-6"><p class="comment-form-email"><input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" maxlength="100" ' . $html_req  . ' /><span class="input-placeholder" data-split-text="true" data-split-options=\'{ "type": "chars" }\' data-custom-animations="true" data-ca-options=\'{ "triggerHandler": "focus", "triggerTarget": "input", "triggerRelation": "siblings", "offTriggerHandler": "blur", "animationTarget": "all-childs", "delay": 50, "animations": { "translateY": "-20%", "rotateX": -45, "opacity": 0 } }\'> ' . esc_html__( 'Email', 'ave' ) . ( $req ? '*' : '' ) . '</span></p></div>',
					            
					'url'    => '<div class="col-md-4 col-sm-6"><p class="comment-form-url"><input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" maxlength="200" /><span class="input-placeholder" data-split-text="true" data-split-options=\'{ "type": "chars" }\' data-custom-animations="true" data-ca-options=\'{ "triggerHandler": "focus", "triggerTarget": "input", "triggerRelation": "siblings", "offTriggerHandler": "blur", "animationTarget": "all-childs", "delay": 50, "animations": { "translateY": "-20%", "rotateX": -45, "opacity": 0 } }\'>' . esc_attr__( 'Website', 'ave' ) . '</span></p></div>',
				);
			?>
			<?php comment_form( array(

					'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title">',
					'title_reply' => esc_html__( 'Leave a comment', 'ave' ),
					'title_reply_after' => '</h3>',

					'fields' => $fields,
					
					'comment_field' => '<div class="col-sm-12"><p class="comment-form-comment"><textarea id="comment" name="comment" rows="6" required="required"></textarea><span class="input-placeholder" data-split-text="true" data-split-options=\'{ "type": "chars" }\' data-custom-animations="true" data-ca-options=\'{ "triggerHandler": "focus", "triggerTarget": "textarea", "triggerRelation": "siblings", "offTriggerHandler": "blur", "animationTarget": "all-childs", "delay": 50, "animations": { "translateY": "-20%", "rotateX": -45, "opacity": 0 } }\'>'. esc_attr__( 'Comment', 'ave' ) .'</span></p></div>',
					
					'comment_notes_before' => '',
					'label_submit' => esc_attr__( 'Submit', 'ave' ),
					'submit_field' => '<div class="col-sm-12 text-right"><p class="form-submit">%1$s %2$s</p></div>',
			) ); ?>

			</div><!-- /.col-md-8 col-md-offset-2 -->
		</div><!-- /.row -->
	</div><!-- /.container -->
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">				
			
			<?php if ( have_comments() ) : ?>
				<ol class="comment-list">
					<?php
						wp_list_comments( array(
							'style' => 'ol',
							'callback' => 'liquid_comments_callback'
						) );
					?>
				</ol>		
			<?php

				get_template_part( 'templates/comment/nav' );

			endif; // Check for have_comments().
		
			// If comments are closed and there are comments, let's leave a little note, shall we?
			if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		
				<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'ave' ); ?></p>

			<?php endif; ?>
				
			</div><!-- /.col-md-8 col-md-offset-2 -->
		</div><!-- /.row -->
	</div><!-- /.container -->

</div><!-- /.comments-area -->