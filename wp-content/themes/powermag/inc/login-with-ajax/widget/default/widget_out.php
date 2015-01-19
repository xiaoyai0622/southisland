<?php 
/*
 * This is the page users will see logged out. 
 * You can edit this, but for upgrade safety you should copy and modify this file into your template folder.
 * The location from within your template folder is plugins/login-with-ajax/ (create these directories if they don't exist)
*/
?>

<?php if ( get_option('users_can_register') && !empty($lwa_data['registration']) ) : ?>
<a href="#" class="btn" id="pm-register-btn" data-toggle="tooltip" data-placement="left" title="<?php _e('Register', 'powermag') ?>"><i class="icon-plus-sign"></i></a>
<?php endif; ?>

<a href="#" class="btn" id="pm-login-btn" data-toggle="tooltip" data-placement="bottom" title="<?php _e('Login', 'powermag') ?>"><i class="icon-signin"></i></a>

<div class="lwa default hide" id="pm-login">
	<div class="widget-title-bg clearfix">
		<h4 class="widget-title"> <span class="inner">
			<?php _e('Login', 'powermag') ?>
			</span> <span class="cat-diagonal"></span> </h4>
	</div>
	<div class="login-form-inner clearfix">
		<form name="lwa-form" class="lwa-form" action="<?php echo esc_attr(LoginWithAjax::$url_login); ?>" method="post">
			<div class="input-prepend">
				<div class="lwa-username">
					<label class="user-label">
						<?php esc_html_e( 'Username','powermag' ) ?>
					</label>
					<span class="add-on"><i class="icon-user"></i></span>
					<input type="text" name="log" id="lwa_user_login" class="input" placeholder="<?php esc_attr_e( 'Username', 'powermag' ) ?>" />
				</div>
			</div>
			<!--input prepend usr-->
			
			<div class="input-prepend">
				<div class="lwa-password">
					<label class="psw-label">
						<?php esc_html_e( 'Password','powermag' ) ?>
					</label>
					<span class="add-on"><i class="icon-key"></i></span>
					<input type="password" name="pwd" id="lwa_user_pass" class="input" placeholder="<?php esc_attr_e( 'Password', 'powermag' ) ?>" />
				</div>
			</div>
			<!--input prepend psw-->
			
			<div class="pull-right">
				<div class="lwa-login_form">
					<?php do_action('login_form'); ?>
				</div>
				<div class="lwa-submit-button">
					<input type="submit" name="wp-submit" id="lwa_wp-submit"  class="btn btn-inverse" value="<?php esc_attr_e('Log In','powermag'); ?>" tabindex="100" />
					<input type="hidden" name="lwa_profile_link" value="<?php echo esc_attr($lwa_data['profile_link']); ?>" />
					<input type="hidden" name="login-with-ajax" value="login" />
				</div>
			</div>
			<!--pull-right-->
			
			<div class="lwa-links">
				<div class="rememberme pull-left">
					<input name="rememberme" type="checkbox" class="lwa-rememberme" value="forever" />
					<label>
						<?php esc_html_e( 'Remember Me', 'powermag' ) ?>
					</label>
				</div>
				<!--rememberme pull-left-->
				
				<?php if( !empty($lwa_data['remember']) ): ?>
				<div class="lost-psw"> <a class="lwa-links-remember" href="<?php echo esc_attr(LoginWithAjax::$url_remember); ?>" title="<?php esc_attr_e('Password Lost and Found', 'powermag') ?>">
					<?php esc_html_e('Lost your password?', 'powermag') ?>
					</a> </div>
				<?php endif; ?>
			</div>
			<!--lwa-links-->
			
		</form>
		<?php if( !empty($lwa_data['remember']) ): ?>
		<form name="lwa-remember" class="lwa-remember" action="<?php echo esc_attr(LoginWithAjax::$url_remember); ?>" method="post" style="display:none;">
			<div class="lwa-remember-email">
			<?php $msg = __("Enter username or email",'powermag'); ?>
			<div class="input-prepend"> <span class="add-on"><i class="icon-question-sign"></i></span>
				<input type="text" name="user_login" id="lwa_user_remember" value="<?php echo esc_attr($msg); ?>" onfocus="if(this.value == '<?php echo esc_attr($msg); ?>'){this.value = '';}" onblur="if(this.value == ''){this.value = '<?php echo esc_attr($msg); ?>'}" />
			</div>
			<!--input-prepend--> 
			
			<a href="#" class="lwa-links-remember-cancel btn">
			<?php esc_attr_e("Cancel", 'powermag'); ?>
			</a>
			<?php do_action('lostpassword_form'); ?>
			<span class="lwa-submit-button">
			<input type="submit" class="btn btn-inverse get-password" value="<?php esc_attr_e("Get New Password", 'powermag'); ?>" />
			<input type="hidden" name="login-with-ajax" value="remember" />
			</span>
		</form>
	</div>
	<!--lwa-remember-email-->
	<?php endif; ?>
</div>
<!-- .login-form-inner -->
</div>
<!-- .lwa -->

<?php if ( $lwa_data['registration'] == true ) : ?>

<div class="lwa-register default hide" id="pm-register">
	<div class="widget-title-bg clearfix">
		<h4 class="widget-title"> <span class="inner">
			<?php _e('Register', 'powermag') ?>
			</span> <span class="cat-diagonal"></span> </h4>
	</div>
	<div class="register-form-inner">
		<form name="registerform" id="registerform" action="<?php echo esc_attr(LoginWithAjax::$url_register); ?>" method="post">
			<div class="lwa-username">
				<div class="input-prepend">
					<label class="hide">
						<?php $msg = __('Username','powermag'); ?>
					</label>
					<span class="add-on"><i class="icon-user"></i></span>
					<input type="text" name="user_login" id="user_login"  value="<?php echo esc_attr($msg); ?>" onfocus="if(this.value == '<?php echo esc_attr($msg); ?>'){this.value = '';}" onblur="if(this.value == ''){this.value = '<?php echo esc_attr($msg); ?>'}" />
				</div>
				<!--input-prepend--> 
			</div>
			<div class="lwa-email">
				<div class="input-prepend">
					<label class="hide">
						<?php $msg = __('E-mail','powermag'); ?>
					</label>
					<span class="add-on"><i class="icon-envelope"></i></span>
					<input type="text" name="user_email" id="user_email"  value="<?php echo esc_attr($msg); ?>" onfocus="if(this.value == '<?php echo esc_attr($msg); ?>'){this.value = '';}" onblur="if(this.value == ''){this.value = '<?php echo esc_attr($msg); ?>'}"/>
				</div>
				<!--input-prepend--> 
			</div>
			<!--lwa-mail-->
			
			<?php
					//If you want other plugins to play nice, you need this: 
					do_action('register_form'); 
				?>
			<div class="lwa-submit-button">
				<p style="margin: 20px 0" class="alert alert-warning">
					<?php esc_html_e('A password will be e-mailed to you.','powermag') ?>
				</p>
				<p class="submit tr" style="margin-bottom: 0">
					<input type="submit" name="wp-submit" id="wp-submit" class="btn btn-inverse" value="<?php esc_attr_e('Register', 'powermag'); ?>" tabindex="100" />
				</p>
				<input type="hidden" name="login-with-ajax" value="register" />
			</div>
		</form>
	</div>
	<!--register-form-inner--> 
	
</div>
<?php endif; ?>
</div>