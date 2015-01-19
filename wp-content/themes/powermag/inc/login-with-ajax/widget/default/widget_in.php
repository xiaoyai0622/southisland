<div class="lwa">
	<div class="pm-logged-wrap clearfix">
		<div class="pm-logged-welcome pull-left">
			<?php 
				global $current_user;
				get_currentuserinfo();
			?>
			<?php echo get_avatar( $current_user->ID, $size = '30' );  ?> <span class="lwa-title"><?php echo __( 'Hi', 'powermag' ) . " " . $current_user->display_name  ?></span> </div>
		<!-- pm-logged-welcome -->
		
		<div class="pm-logged-buttons pull-left">
			<div class="btn-group"> <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-chevron-down"></i></a>
				<ul class="dropdown-menu">
					
					<?php
					/* BuddyPress Notification Integration - @since PM 1.4.0 */ 
					if ( defined('BP_VERSION') ) { pm_bp_notification_badge(); }
					?>
					
					<?php
							//Admin URL
							if ( $lwa_data['profile_link'] == '1' ) {
								if( function_exists('bp_loggedin_user_link') ){
									?>
					<li><a href="<?php bp_loggedin_user_link(); ?>"><i class="icon-user"></i>
						<?php esc_html_e('Profile','powermag') ?>
						</a></li>
					<?php	
								}else{
									?>
					<li><a href="<?php echo trailingslashit(get_admin_url()); ?>profile.php"><i class="icon-user"></i>
						<?php esc_html_e('Profile','powermag') ?>
						</a></li>
					<?php	
								}
							}
							//Logout URL
							?>
					<li><a id="wp-logout" href="<?php echo wp_logout_url() ?>"><i class="icon-signout"></i>
						<?php esc_html_e( 'Log Out' ,'powermag') ?>
						</a></li>
					<?php
							//Blog Admin
							if( current_user_can('list_users') ) {
								?>
					<li><a href="<?php echo get_admin_url(); ?>"><i class="icon-cog"></i>
						<?php esc_html_e("blog admin", 'powermag'); ?>
						</a></li>
					<?php
							}
						?>
				</ul>
			</div>
			<!--button group--> 
			
		</div>
		<!--.pm-logged-buttons--> 
	</div>
	<!--.pm-logged-wrap--> 
</div>
<!--lwa-->