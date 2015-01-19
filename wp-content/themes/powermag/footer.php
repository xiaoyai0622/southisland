<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package PowerMag
 * @since PowerMag 1.0
 */

$boxed = of_get_option('pm_boxed') == 'boxed';
?>

			</div><!-- #main .site-main -->
		<?php if (!$boxed) { ?>
		</div><!-- .container.supermain -->
		<?php } ?>
		
		<div id="footer-wrap">
			<div id="full-footer">
				<footer class="container" id="widgetized-footer">
					
					<div class="row">
						
						<div class="span4 footer-item">
							<?php
							if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer1')): 
							endif;
							?>
						</div>
						
						<div class="span4 footer-item">
							<?php
							if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer2')): 
							endif;
							?>
						</div>	
						
						<div class="span4 footer-item">
							<?php
							if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer3')): 
							endif;
							?>
						</div>
					
					</div><!--row-->		
				</footer><!--.container-->
			</div><!-- #full-footer -->
				
			<div id="full-site-info">	
				<div id="colophon" class="site-footer container" role="contentinfo">
					<div class="site-info row">
						
						<div class="span12">
						
							<?php if ( of_get_option('pm_footer_logo') != NULL ) { ?>
							<div id="footer-logo">
								<img src="<?php echo of_get_option('pm_footer_logo') ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
							</div>
							<?php } ?>
							
							<div class="utilities footer">
								<?php wp_nav_menu( array( 'theme_location' => 'footer', 'container_class' => 'footer-menu', 'depth' => 1 ) ); ?>
							</div>
						
							<p><?php echo of_get_option('pm_credits') ?></p>
						</div>
						
					</div><!-- .site-info -->
				</div><!-- #colophon .site-footer -->
			</div>
		</div><!--#footer-wrap-->
				
	<!--</div> #page .hfeed .site -->
	
<?php if (of_get_option('pm_scrollup') ) echo '<i class="icon-chevron-up icon-large scrollup"></i>'; ?>
	<?php if ($boxed) { ?>
	</div><!-- .container.supermain -->
	<?php } ?>
	
<?php wp_footer(); ?>
</body>
</html>