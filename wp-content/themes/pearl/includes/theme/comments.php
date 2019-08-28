<?php
/*Single Comment view*/
if( ! function_exists( 'pearl_comment' ) ){
	function pearl_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);

		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
		?>
        <<?php echo esc_attr( $tag ) ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
		<?php if ( 'div' != $args['style'] ) { ?>
            <div id="div-comment-<?php comment_ID() ?>" class="comment-body clearfix">
		<?php } ?>
		<?php if ( $args['avatar_size'] != 0 ) { ?>
            <div class="vcard">
				<?php echo get_avatar( $comment, 174 ); ?>
            </div>
		<?php } ?>
        <div class="comment-info clearfix">
            <div class="comment-author"><?php echo get_comment_author_link(); ?></div>

            <div class="comment-meta commentmetadata">
                <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
					<?php printf( esc_html__( '%1$s at %2$s', 'pearl' ), get_comment_date(),  get_comment_time() ); ?>
                </a>
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => '<i class="fa fa-reply"></i>' . esc_html__( 'Reply', 'pearl' ), 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				<?php edit_comment_link( esc_html__( 'Edit', 'pearl' ), '  ', '' ); ?>
            </div>
            <div class="comment-text">
				<?php comment_text(); ?>
            </div>
			<?php if ( $comment->comment_approved == '0' ) { ?>
                <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'pearl' ); ?></em>
			<?php } ?>
        </div>

		<?php if ( 'div' != $args['style'] ) { ?>
            </div>
		<?php } ?>
		<?php
	}
}

add_filter( 'comment_form_default_fields', 'pearl_comment_form_fields' );

function pearl_comment_form_fields( $fields ) {
	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );
	$aria_req  = ( $req ? " aria-required='true'" : '' );
	$html5     = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;
	$fields    = array(
		'author' => '<div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group comment-form-author">
                <input placeholder="' . esc_html__( 'Name', 'pearl' ) . ( $req ? ' *' : '' ) . '" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />
            </div>
        </div>',
		'email'  => '<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group comment-form-email">
                <input placeholder="' . esc_html__( 'E-mail', 'pearl' ) . ( $req ? ' *' : '' ) . '" class="form-control" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />
            </div>
        </div></div>',
	);

	return $fields;
}

add_filter( 'comment_form_defaults', 'pearl_comment_form' );

function pearl_comment_form( $args ) {
	$args['comment_field'] = '<div class="form-group comment-form-comment">
        <textarea placeholder="' . _x( 'Comment', 'noun', 'pearl' ) . ' *" class="form-control" name="comment" rows="9" aria-required="true"></textarea>
    </div>';

	$args['submit_button'] = '<button name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s">%4$s</button>';


	return $args;
}