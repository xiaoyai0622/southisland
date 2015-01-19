<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package PowerMag
 * @since PowerMag 1.0
 */

get_header();

$pm_full_width = get_post_meta(get_the_ID(), 'pm_full_width_switch', true); ?>

<div class="row">
		
		<div id="primary" class="content-area <?php if ($pm_full_width) { echo 'span12'; } else { echo 'span8'; } ?>">
			<div id="content" class="site-content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

					<?php // Load Facebook or WP Comments
					$pm_comment_type = get_post_meta(get_the_ID(), 'pm_comment_type', true);
					
					$url = (!empty($_SERVER['HTTPS'])) ? "https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] : "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
					?>
					
					<?php if ($pm_comment_type == 'fb') { ?>
							
						<div class="fb-comments" data-width="100%" data-href="<?php echo $url; ?>" data-num-posts="4"></div>
						
					<?php } elseif ($pm_comment_type == 'none') { 
						
								echo '';
					
						  } else {
						
							if ( comments_open() || '0' != get_comments_number() )
							comments_template( '', true );
						  }
					?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

	<?php if (!$pm_full_width) { ?>
	<div class="span4"><?php get_sidebar(); ?></div>
	<?php } ?>
	
</div><!-- .row (single)-->
<?php get_footer(); ?>