<?php

/**
 * BuddyPress - Users Home
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

get_header( 'buddypress' ); ?>

<div class="row">
	<div id="primary" class="content-area span8 pm-buddypress">
		<div id="content" class="site-content" role="main">

			
				<div class="padder">
		
					<?php do_action( 'bp_before_member_home_content' ); ?>
		
					<div id="item-header" role="complementary">
		
						<?php locate_template( array( 'members/single/member-header.php' ), true ); ?>
		
					</div><!-- #item-header -->
		
					<div id="item-nav">
						<div class="item-list-tabs no-ajax" id="object-nav" role="navigation">
							<ul>
		
								<?php bp_get_displayed_user_nav(); ?>
		
								<?php do_action( 'bp_member_options_nav' ); ?>
		
							</ul>
						</div>
					</div><!-- #item-nav -->
		
					<div id="item-body">
		
						<?php do_action( 'bp_before_member_body' );
		
						if ( bp_is_user_activity() || !bp_current_component() ) :
							locate_template( array( 'members/single/activity.php'  ), true );
		
						 elseif ( bp_is_user_blogs() ) :
							locate_template( array( 'members/single/blogs.php'     ), true );
		
						elseif ( bp_is_user_friends() ) :
							locate_template( array( 'members/single/friends.php'   ), true );
		
						elseif ( bp_is_user_groups() ) :
							locate_template( array( 'members/single/groups.php'    ), true );
		
						elseif ( bp_is_user_messages() ) :
							locate_template( array( 'members/single/messages.php'  ), true );
		
						elseif ( bp_is_user_profile() ) :
							locate_template( array( 'members/single/profile.php'   ), true );
		
						elseif ( bp_is_user_forums() ) :
							locate_template( array( 'members/single/forums.php'    ), true );
		
						elseif ( bp_is_user_settings() ) :
							locate_template( array( 'members/single/settings.php'  ), true );
							
						/* support for notification tab BP 1.9.2 @since PM 1.7.0 */
						
						elseif ( bp_is_user_notifications() ) : 
							locate_template( array ('members/single/notifications.php' ), true );
		
						// If nothing sticks, load a generic template
						else :
							locate_template( array( 'members/single/plugins.php'   ), true );
		
						endif;
		
						do_action( 'bp_after_member_body' ); ?>
		
					</div><!-- #item-body -->
		
					<?php do_action( 'bp_after_member_home_content' ); ?>
		
				</div><!-- .padder -->
			

		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->

	<div class="span4">
		<?php if ( of_get_option('pm_bp_sidebar') == 'buddypress_sidebar' ) {			
				
				if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('BuddyPress')): endif;
				
		 		} else { get_sidebar( 'buddypress' );
		}; ?>
	</div>

</div><!-- .row (buddypress)-->
<?php get_footer( 'buddypress' ); ?>
