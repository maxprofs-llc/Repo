<div id="comments">
	<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'lenora' ); ?></p>
	</div><!-- END #comments -->
	<?php
		return;
	endif;
	?>

	<?php if ( have_comments() ) : ?>
		<h2 id="comments-title">
			<?php printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'lenora' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' ); ?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav id="comment-nav-above">
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'lenora' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'lenora' ) ); ?></div>
			</nav>
		<?php endif; // check for comment navigation ?>

		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'lenora_comment' ) ); ?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav id="comment-nav-below">
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'lenora' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'lenora' ) ); ?></div>
			</nav>
		<?php endif; // check for comment navigation ?>

		<?php
			elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'lenora' ); ?></p>
	<?php endif; //have_comments? ?> 

	<?php comment_form(); ?>

</div><!-- END #comments -->
