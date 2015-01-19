<?php

do_action( 'bp_before_group_header' );

?>

<div id="item-actions">

	<?php if ( bp_group_is_visible() ) : ?>

		<h3><?php _e( 'Group Admins', 'buddypress' ); ?></h3>

		<?php bp_group_list_admins();

		do_action( 'bp_after_group_menu_admins' );

		if ( bp_group_has_moderators() ) :
			do_action( 'bp_before_group_menu_mods' ); ?>

			<h3><?php _e( 'Group Mods' , 'buddypress' ); ?></h3>

			<?php bp_group_list_mods();

			do_action( 'bp_after_group_menu_mods' );

		endif;

	endif; ?>

</div><!-- #item-actions -->

<div id="item-header-avatar">
	<a href="<?php bp_group_permalink(); ?>" title="<?php bp_group_name(); ?>">

		<?php bp_group_avatar(); ?>

	</a>
</div><!-- #item-header-avatar -->
	
<header class="boxed-title clearfix">
	<div id="item-header-content">
	
		<h1 class="page-title">
			<span><?php _e('Group', 'powermag'); ?></span> <i class="icon-chevron-right arch-chevron"></i><a href="<?php bp_group_permalink(); ?>" title="<?php bp_group_name(); ?>"><?php bp_group_name(); ?></a>
		</h1>
		
		<span class="highlight"><?php bp_group_type(); ?></span> <div class="label"><?php printf( __( 'active %s', 'buddypress' ), bp_get_group_last_active() ); ?></div>
	
		<?php //do_action( 'bp_before_group_header_meta' ); ?>
	
		<div id="item-meta">
	
			<?php bp_group_description(); ?>
	
			<div id="item-buttons">
	
				<?php do_action( 'bp_group_header_actions' ); ?>
	
			</div><!-- #item-buttons -->
	
			<?php do_action( 'bp_group_header_meta' ); ?>
	
		</div>
	</div><!-- #item-header-content -->
</header>

<?php
do_action( 'bp_after_group_header' );
do_action( 'template_notices' );
?>