<?php

/**
 * BuddyPress - Users Header
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

?>

<?php do_action( 'bp_before_member_header' ); ?>

<div id="item-header-avatar">
	<a href="<?php bp_displayed_user_link(); ?>">

		<?php bp_displayed_user_avatar( 'type=full' ); ?>

	</a>
</div><!-- #item-header-avatar -->

<header class="boxed-title clearfix">
	<div id="item-header-content">
		
	
		<h1 class="page-title">
			<span><?php _e('Member', 'powermag'); ?></span> <i class="icon-chevron-right arch-chevron"></i><a href="<?php bp_displayed_user_link(); ?>"><?php bp_displayed_user_fullname(); ?></a>
		</h1>
	
		
		<span class="user-nicename">@<?php bp_displayed_user_username(); ?></span>
		<div class="label"><?php bp_last_activity( bp_displayed_user_id() ); ?></div>
	
		<?php do_action( 'bp_before_member_header_meta' ); ?>
	
		<div id="item-meta">
	
			<?php if ( bp_is_active( 'activity' ) ) : ?>
	
				<div id="latest-update">
	
					<?php bp_activity_latest_update( bp_displayed_user_id() ); ?>
	
				</div>
	
			<?php endif; ?>
	
			<div id="item-buttons">
	
				<?php do_action( 'bp_member_header_actions' ); ?>
	
			</div><!-- #item-buttons -->
	
			<?php
			/***
			 * If you'd like to show specific profile fields here use:
			 * bp_member_profile_data( 'field=About Me' ); -- Pass the name of the field
			 */
			 do_action( 'bp_profile_header_meta' );
	
			 ?>
	
		</div><!-- #item-meta -->
	
	</div><!-- #item-header-content -->
</header>
<?php do_action( 'bp_after_member_header' ); ?>

<?php do_action( 'template_notices' ); ?>