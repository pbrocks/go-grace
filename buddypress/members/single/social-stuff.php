<?php
/*
 Social Stuff
*/

$current_user	 = get_current_user_id();
$displayed_user_id	 = bp_displayed_user_id();
$post_author_id	 = get_the_author_meta( 'ID' );

if ( is_single() ) {
	$author_social_info = $post_author_id;
} else {
	$author_social_info = $displayed_user_id;
}

add_filter( 'buddyboss_get_user_social_array', 'buddyboss_user_social_remove_disabled' ); //remove disabled.

foreach ( buddyboss_get_user_social_array() as $social => $name ) {
	$url = buddyboss_get_user_social( $author_social_info, $social );
	?>

	<?php
	if ( ! empty( $url ) ) {
	?>
		<a class="btn" href="<?php echo $url; ?>" title="<?php echo esc_attr( $name ); ?>" target="_blank"><i class="bb-icon-<?php echo $social; ?>"></i></a>
	<?php
	}
}
?>
