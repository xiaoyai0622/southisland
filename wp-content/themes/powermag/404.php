<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package PowerMag
 * @since PowerMag 1.0
 */

get_header(); ?>

<div class="row">
	<div id="primary" class="content-area span8">
		<div id="content" class="site-content" role="main">

			<article id="post-0" class="post error404 not-found boxed">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Whoopsie! That page can&rsquo;t be found.', 'powermag' ); ?></h1>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'powermag' ); ?></p>

					<?php get_search_form(); ?>

					<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

					<div class="widget">
						<h2 class="widgettitle"><?php _e( 'Most Used Categories', 'powermag' ); ?></h2>
						<ul>
						<?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
						</ul>
					</div><!-- .widget -->

					<?php
					/* translators: %1$s: smilie */
					$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'powermag' ), convert_smilies( ':)' ) ) . '</p>';
					the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
					?>

					<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>

				</div><!-- .entry-content -->
			</article><!-- #post-0 .post .error404 .not-found -->

		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->

	<div class="span4"><?php get_sidebar(); ?></div>
	
</div><!-- .row (single)-->
<?php get_footer(); ?>