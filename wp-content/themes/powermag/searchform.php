<?php
/**
 * The template for displaying search forms in PowerMag
 *
 * @package PowerMag
 * @since PowerMag 1.0
 */
?>
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<label for="s" class="assistive-text"><?php _e( 'Search', 'powermag' ); ?></label>
		<div class="input-append">
			<input type="text" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php esc_attr_e( 'Search &hellip;', 'powermag' ); ?>" />
			<button class="btn" type="submit"><i class="icon-search"></i></button>
		</div>
		<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'powermag' ); ?>" />
	</form>