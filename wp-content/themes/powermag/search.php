<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package PowerMag
 * @since PowerMag 1.0
 */

get_header(); ?>

<div class="row">

		<section id="primary" class="content-area span8">
			<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="boxed-title">
					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'powermag' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header><!-- .page-header -->
	
				<?php 
				$std_style = of_get_option('pm_blogstyle') == 'default';
				
				if ($std_style) { ?>
				<div id="loop-wrap">
				<?php } ?>
				
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content' ) ?>

				<?php endwhile; ?>
				
				<?php 	
				if ($std_style) { ?>
				</div><!-- #loop-wrap-->
				<?php } ?>		

				<?php pm_num_pagination(); ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'search' ); ?>

			<?php endif; ?>

			</div><!-- #content .site-content -->
		</section><!-- #primary .content-area -->

	<div class="span4"><?php get_sidebar(); ?></div>
	
</div><!-- .row (search)-->
<?php get_footer(); ?>