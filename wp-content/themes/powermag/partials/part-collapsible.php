<div id="collapse-trigger">
	<a class="collapse" data-toggle="collapse" data-target="#newsletter">
		<?php if ( of_get_option('pm_collapsible_newsletter') AND !of_get_option('pm_collapsible_custom')  ) { 
			echo '<i class="icon-envelope-alt"></i>';
		} else {
			echo '<i class="icon-plus"></i>'; }
		?>
	</a>
</div><!--#collapse-trigger-->

<div id="full-collapsible">
	<div class="container hidden-box">
		<div id="newsletter" class="accordion-body collapse">
			<div class="hidden-box-inner">
		
<?php if ( of_get_option('pm_collapsible_newsletter') ) { ?>
				<h2><?php echo of_get_option('pm_collapsible_nl_catch')?></h2>
				<div class="input-append newsletter-form">
				
				
				<!-- Begin MailChimp Signup Form -->

				<div id="mc_embed_signup">
					<form action="<?php echo of_get_option('pm_collapsible_nl_action'); ?>" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
						<input type="email" value="" name="EMAIL" class="email form-control col-md-4" id="mce-EMAIL" placeholder="<?php _e('Enter your email address', 'powermag'); ?>" required>
						<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
						<div style="position: absolute; left: -5000px;"><input type="text" name="<?php echo of_get_option('pm_collapsible_nl_name'); ?>" tabindex="-1" value=""></div>
						<input type="submit" value="<?php _e('Go!', 'powermag'); ?>" name="subscribe" id="mc-embedded-subscribe" class="btn btn-inverse">
					</form>
					
				</div><!--End mc_embed_signup-->
				
<?php } ?>

<?php if ( of_get_option('pm_collapsible_custom') ) { ?>
				<div class="collapsible-custom">
					<?php echo of_get_option('pm_toggle_textarea'); ?>
				</div>
<?php } ?>

			</div> <!-- hidden-box-inner-->
		</div><!-- #newsletter -->
	</div><!-- .hidden-box -->
</div><!-- #full-collapsible -->