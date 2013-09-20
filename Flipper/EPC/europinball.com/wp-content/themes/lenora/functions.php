<?php

// Theme-Setup
add_action( 'after_setup_theme', 'lenora_theme_setup' );

function lenora_theme_setup() {
	global $content_width;

//Set the content width based on the theme's design and stylesheet.
	if ( !isset( $content_width ) )
		$content_width = 560;

// This theme supports automatic feed links */
	add_theme_support( 'automatic-feed-links' );

// This theme supports post thumbnails
	add_theme_support( 'post-thumbnails' );


// This theme supports custom background & custom header
	$args = array(
		'default-color' => 'ffffff',
	);

	$args = apply_filters( 'lenora_custom_background_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-background', $args );
	} else {
		define( 'BACKGROUND_COLOR', $args['default-color'] );
	add_custom_background();
	}


	add_theme_support( 'custom-header' );

// This theme uses wp_nav_menu() in one location
	register_nav_menus( array(
		'main-menu' => __( 'Primary Navigation', 'lenora' ),
	) );

// Register widgetized area and update sidebar with default widgets
	add_action( 'widgets_init', 'lenora_widgets_init' );

// Load up the theme options page
	require ( get_template_directory() . '/includes/theme-options.php' );
	
// Used to style the TinyMCE editor
	add_editor_style();

// Make theme available for translation, Translations can be filed in the /languages/ directory

	// Load Theme textdomain
	load_theme_textdomain('lenora', get_template_directory() . '/languages');	

}

function lenora_filter_wp_title( $title ) {
    // Get the Site Name
    $site_name = get_bloginfo( 'name' );
    // Prepend it to the default output
    $filtered_title = $site_name ." &laquo; ". $title;
    // Return the modified title
    return $filtered_title;
}

// Hook into 'wp_title'
add_filter( 'wp_title', 'lenora_filter_wp_title' );


// Register widgetized area and update sidebar with default widgets

function lenora_widgets_init() {
	register_sidebar( array (
		'name' => __( 'Right sidebar', 'lenora' ),
		'id' => 'sidebar',
        'description' => __('The widget area on the right sidebar', 'lenora'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}

// Remove predefined gallery styles

add_filter( 'use_default_gallery_style', '__return_false' );


//Comments

function lenora_enqueue_comment_reply() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { 
		wp_enqueue_script( 'comment-reply' ); 
	}
}
add_action( 'wp_enqueue_scripts', 'lenora_enqueue_comment_reply' );


// Template for comments & pingbacks 

if ( ! function_exists( 'lenora_comment' ) ) :

function lenora_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php printf( __( '%s <span class="says">says:</span>', 'lenora' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- END .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'lenora' ); ?></em>
			<br />
		<?php endif; ?>
		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				printf( __( '%1$s at %2$s', 'lenora' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'lenora' ), ' ' );
			?>
		</div><!-- END .comment-meta .commentmetadata -->
		<div class="comment-body"><?php comment_text(); ?></div>
		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- END .reply -->
	</div><!-- END #comment-body  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'lenora' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(edit)', 'lenora' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;


/** 
 * lenora's Shortcodes
 */
 
 // Enable shortcodes in widget areas
add_filter( 'widget_text', 'do_shortcode' );

// Replace WP autop formatting
if (!function_exists( "lenora_remove_wpautop")) {
	function lenora_remove_wpautop($content) { 
		$content = do_shortcode( shortcode_unautop( $content ) ); 
		$content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content);
		return $content;
	}
}


// Columns Shortcodes
// Don't forget to add "_last" behind the shortcode if it is the last column.

// Two Columns

function lenora_shortcode_one_half( $atts, $content = null ) {
   return '<div class="one_half">' . lenora_remove_wpautop($content) . '</div>';
}
add_shortcode( 'one_half', 'lenora_shortcode_one_half' );

function lenora_shortcode_one_half_last( $atts, $content = null ) {
   return '<div class="one_half last">' . lenora_remove_wpautop($content) . '</div>';
}
add_shortcode( 'one_half_last', 'lenora_shortcode_one_half_last' );

// Three Columns
function lenora_shortcode_one_third($atts, $content = null) {
   return '<div class="one_third">' . lenora_remove_wpautop($content) . '</div>';
}
add_shortcode( 'one_third', 'lenora_shortcode_one_third' );

function lenora_shortcode_one_third_last($atts, $content = null) {
   return '<div class="one_third last">' . lenora_remove_wpautop($content) . '</div>';
}
add_shortcode( 'one_third_last', 'lenora_shortcode_one_third_last' );

function lenora_shortcode_two_third($atts, $content = null) {
   return '<div class="two_third">' . lenora_remove_wpautop($content) . '</div>';
}
add_shortcode( 'two_third', 'lenora_shortcode_two_third' );

function lenora_shortcode_two_third_last($atts, $content = null) {
   return '<div class="two_third last">' . lenora_remove_wpautop($content) . '</div>';
}
add_shortcode( 'two_third_last', 'lenora_shortcode_two_third_last' );


// Four Columns
function lenora_shortcode_one_fourth($atts, $content = null) {
   return '<div class="one_fourth">' . lenora_remove_wpautop($content) . '</div>';
}
add_shortcode( 'one_fourth', 'lenora_shortcode_one_fourth' );

function lenora_shortcode_one_fourth_last($atts, $content = null) {
   return '<div class="one_fourth last">' . lenora_remove_wpautop($content) . '</div>';
}
add_shortcode( 'one_fourth_last', 'lenora_shortcode_one_fourth_last' );

function lenora_shortcode_three_fourth( $atts, $content = null ) {
    return '<div class="three_fourth">' . lenora_remove_wpautop($content) . '</div>';
}
add_shortcode( 'three_fourth', 'lenora_shortcode_three_fourth' );

function lenora_shortcode_three_fourth_last( $atts, $content = null ) {
    return '<div class="three_fourth last">' . lenora_remove_wpautop($content) . '</div>';
}
add_shortcode( 'three_fourth_last', 'lenora_shortcode_three_fourth_last' );



// Divide Text Shortcode
function lenora_shortcode_divider($atts, $content = null) {
   return '<div class="divider"></div>';
}
add_shortcode( 'divider', 'lenora_shortcode_divider' );

//Text Highlight and Info Boxes Shortcodes
function lenora_shortcode_highlight($atts, $content = null) {
   return '<span class="highlight">' . do_shortcode( lenora_remove_wpautop($content) ) . '</span>';
}
add_shortcode( 'highlight', 'lenora_shortcode_highlight' );

function lenora_shortcode_white_box($atts, $content = null) {
   return '<div class="white-box">' . do_shortcode( lenora_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'white_box', 'lenora_shortcode_white_box' );

function lenora_shortcode_blue_box($atts, $content = null) {
   return '<div class="blue-box">' . do_shortcode( lenora_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'blue_box', 'lenora_shortcode_blue_box' );

function lenora_shortcode_yellow_box($atts, $content = null) {
   return '<div class="yellow-box">' . do_shortcode( lenora_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'yellow_box', 'lenora_shortcode_yellow_box' );

function lenora_shortcode_orange_box($atts, $content = null) {
   return '<div class="orange-box">' . do_shortcode( lenora_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'orange_box', 'lenora_shortcode_orange_box' );

function lenora_shortcode_red_box($atts, $content = null) {
   return '<div class="red-box">' . do_shortcode( lenora_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'red_box', 'lenora_shortcode_red_box' );

function lenora_shortcode_pink_box($atts, $content = null) {
   return '<div class="pink-box">' . do_shortcode( lenora_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'pink_box', 'lenora_shortcode_pink_box' );

function lenora_shortcode_green_box($atts, $content = null) {
   return '<div class="green-box">' . do_shortcode( lenora_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'green_box', 'lenora_shortcode_green_box' );

function lenora_shortcode_grey_box($atts, $content = null) {
   return '<div class="grey-box">' . do_shortcode( lenora_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'grey_box', 'lenora_shortcode_grey_box' );

function lenora_shortcode_brown_box($atts, $content = null) {
   return '<div class="brown-box">' . do_shortcode( lenora_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'brown_box', 'lenora_shortcode_brown_box' );


// Shortcode: PullQuote.
// Usage: [pullquote style="left" quote="light"], style options: 'left', 'right'; quote options: 'light' (optional), otherwise defaults to dark style
function lenora_shortcode_pullquote( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'style' => 'left',
	    'quote' => 'dark',
    ), $atts));
    $align = ($style == 'right') ? 'alignright' : 'alignleft';
    $quote_color = ($quote == 'light') ? ' bq-light' : '';
    return '<blockquote class="'.$align.$quote_color.'">'.do_shortcode( lenora_remove_wpautop($content)).'</blockquote>';
}
add_shortcode('pullquote', 'lenora_shortcode_pullquote');
