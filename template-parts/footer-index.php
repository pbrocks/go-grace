<?php
/*

*/
?>


<!-- <footer class="entry-meta"> -->
<div class="row">
	<div class="entry-tags col">
		<?php
		$terms = wp_get_post_tags( get_the_ID() );
		if ( $terms ) {
			?>
			<h3><?php _e( 'Tagged in', 'onesocial' ); ?></h3><?php
			foreach ( $terms as $t ) {
				echo '<a href="' . get_tag_link( $t->term_id ) . '">' . $t->name . '<span>' . $t->count . '</span></a>';
			}
		}
		?>
	</div>

	<?php // if ( 'publish' === get_post_status( get_the_ID() ) ) {
		?>
	<!-- /.entry-tags -->
	<div class="entry-share col">
		<?php
		if ( function_exists( 'get_simple_likes_button' )  /* && is_singular( 'post' ) */ ) {
			echo get_simple_likes_button( get_the_ID() );
		}
		?>

		<ul class="helper-links">

			<?php if ( function_exists( 'sap_get_bookmark_button' ) && ! is_home() ) { ?>
			<li>
				<?php
				$button = sap_get_bookmark_button();

				if ( ! empty( $button ) ) {
					echo $button;
				} else {
					?>
					<a id="bookmarkme" href="#siteLoginBox" class="bookmark-it onesocial-login-popup-link">
						<span class="fa bb-helper-icon fa-bookmark-o"></span>
						<span><?php esc_html_e( 'Bookmark', 'onesocial' ); ?></span>
					</a><?php
				}
				?>
			</li>
			<?php } ?>

			<?php if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) { ?>
			<li>
				<?php ADDTOANY_SHARE_SAVE_KIT( array( 'use_current_page' => true ) ); ?>
			</li><?php
}
		?>
	</ul>
</div>
