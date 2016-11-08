<?php
/**
 * @package Ky's Medium
 * a OneSocial Child Theme
 * The parent theme functions are located at /onesocial/buddyboss-inc/theme-functions.php
 * Add your own functions in this file.

 */
function wp_add_placeholder( $elements ) {
	$elements['placeholder'] = bp_get_the_profile_field_name();
	return $elements;
}
add_action( 'bp_xprofile_field_edit_html_elements', 'wp_add_placeholder' );

add_shortcode( 'placeholder-elements', 'print_placeholder' );
function print_placeholder( $elements ) {
	$placeholder_elements = wp_add_placeholder( $elements );

	print_r( wp_add_placeholder( $elements ) );
}


function custom_excerpt_length( $length ) {
	return 15;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/**
 * Sets up theme defaults
 *
 * @since Ky's Medium 1.0.0
 */
function kys_medium_theme_setup() {
	/**
	* Makes child theme available for translation.
	* Translations can be added into the /languages/ directory.
	* Read more at: http://www.buddyboss.com/tutorials/language-translations/
	*/

	// Translate text from the PARENT theme.
	load_theme_textdomain( 'onesocial', get_stylesheet_directory() . '/languages' );

	// Translate text from the CHILD theme only.
	// Change 'onesocial' instances in all child theme files to 'onesocial_child_theme'.
	// load_theme_textdomain( 'onesocial_child_theme', get_stylesheet_directory() . '/languages' );

}
add_action( 'after_setup_theme', 'kys_medium_theme_setup' );

/**
 * Enqueues scripts and styles for child theme front-end.
 *
 * @since OneSocial Child Theme  1.0.0
 */
add_action( 'wp_enqueue_scripts', 'kys_medium_theme_scripts_styles', 9999 );
function kys_medium_theme_scripts_styles() {
	/**
	* Scripts and Styles loaded by the parent theme can be unloaded if needed
	* using wp_deregister_script or wp_deregister_style.
	*
	* See the WordPress Codex for more information about those functions:
	* http://codex.wordpress.org/Function_Reference/wp_deregister_script
	* http://codex.wordpress.org/Function_Reference/wp_deregister_style
	**/

	/*
	* Styles
	*/
	wp_enqueue_style( 'kys-medium-theme-custom', get_stylesheet_directory_uri() . '/css/custom.css' );
	wp_enqueue_style( 'kys-medium-priority', get_stylesheet_directory_uri() . '/css/priority.css' );
	wp_enqueue_script( 'scroll-top', get_stylesheet_directory_uri() . '/js/scroll-top.js', array( 'jquery' ) );
}


/****************************** CUSTOM FUNCTIONS ******************************/


//enqueues external font awesome stylesheet
function enqueue_font_awesome() {
	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' );
}
add_action( 'admin_enqueue_scripts', 'enqueue_font_awesome' );

/**
 * Enqueues scripts and styles for child theme front-end.
 *
 * @since OneSocial Child Theme  1.0.0
 */
//add_action( 'the_post', 'kys_medium_post_meta' );
function kys_medium_post_meta( $post ) {
	$subtitle = get_post_custom( $post->ID );
	return $subtitle;
}


function get_post_views( $postID ) {
	$count_key = 'post_views_count';
	$count = get_post_meta( $postID, $count_key, true );
	if ( '' === $count ) {
		delete_post_meta( $postID, $count_key );
		add_post_meta( $postID, $count_key, '0' );
		return '0 Views';
	}
	return $count.' Views';
}

// function to count views.
function set_post_views( $postID ) {
	$count_key = 'post_views_count';
	$count = get_post_meta( $postID, $count_key, true );
	if ( '' === $count ) {
		$count = 0;
		delete_post_meta( $postID, $count_key );
		add_post_meta( $postID, $count_key, '0' );
	} else {
		$count++;
		update_post_meta( $postID, $count_key, $count );
	}
}


// Add it to a column in WP-Admin
add_filter( 'manage_posts_columns', 'posts_column_views' );
add_action( 'manage_posts_custom_column', 'posts_custom_column_views', 5, 2 );
function posts_column_views( $defaults ) {
	$defaults['post_views'] = __( 'Veiews' );
	return $defaults;
}
function posts_custom_column_views( $column_name, $id ) {
	if ( 'post_views' === $column_name ) {
		echo get_post_views( get_the_ID() );
	}
}
