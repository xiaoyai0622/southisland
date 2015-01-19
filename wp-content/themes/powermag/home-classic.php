<!-- Get Sliders if at least one is enabled -->
<?php if ( of_get_option('pm_slider_1') ) get_template_part ('partials/part', 'sliders');?>

<div class="row">
		
		<div id="primary" class="content-area span8">
			<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>

				<?php 
				$std_style = of_get_option('pm_blogstyle') == 'default';
				
				if ($std_style) { ?>
				<div id="loop-wrap">
				<?php } ?>
				
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php 
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>
					
				<?php endwhile; ?>

				<?php 	
				if ($std_style) { ?>
				</div><!-- #loop-wrap-->
				<?php } ?>			

				<?php pm_num_pagination(); ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'index' ); ?>

			<?php endif; ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->
		
	<div class="span4"><?php get_sidebar(); ?></div>

</div><!--row-->