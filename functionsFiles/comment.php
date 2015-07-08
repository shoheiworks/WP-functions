<? php
//Customize by css

	if ( ! function_exists( 'dwp_comment' ) ) :

	function dwp_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
		?>
	    
		<li class="post pingback">
			<p><?php _e( 'Pingback:', 'dwp' ); ?>
			<?php comment_author_link(); ?>
			<?php edit_comment_link( __( 'Edit', 'dwp' ), '<span class="edit-link">', '</span>' ); ?></p>

			<?php break; default :	?>

		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	   		<aside id="comment-<?php comment_ID(); ?>">
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 40 ); ?>
					<?php printf( '<cite class="fn">%s</cite>', get_comment_author_link() ); ?>
				</div><!-- .comment-author .vcard -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php echo 'このコメントは承認待ちです。'; ?></em>
					<br />
				<?php endif; ?>
	            
	            <p class="mb10"><?php echo get_comment_date(); ?></p>

			<aside id="comment_text"><?php comment_text(); ?></aside>

			<div class="reply">
	    		<?php comment_reply_link( array_merge( $args, array(
					'depth' => $depth,
					'max_depth' => $args['max_depth']
				) ) ); ?>
			</div><!-- .reply -->
			</aside><!-- #comment-##  -->

		<?php
			break;
			endswitch;
	}
	endif;