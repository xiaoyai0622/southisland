<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package PowerMag
 * @since PowerMag 1.0
 */
?>

<?php 

$pm_video = get_post_meta(get_the_ID(), 'pm_video_encode', true);
$pm_has_video = $pm_video != ""; 
$full_width = get_post_meta(get_the_ID(), 'pm_full_width_switch', true);

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		
		<?php if ( of_get_option('pm_breadcrumb') ) echo pm_breadcrumb(); ?>
		
		<div class="entry-img">		
			<?php if (has_post_thumbnail() OR $pm_has_video ) { ?>
	
				<?php 
					if (has_post_thumbnail() AND !$pm_has_video AND !$full_width) { the_post_thumbnail('slider-cat');}
					elseif (has_post_thumbnail() AND !$pm_has_video AND $full_width ) { the_post_thumbnail('slider-single');} /* @since PM 1.1 */
					elseif ($pm_has_video) echo $pm_video;
				?>
			<?php } ?>
				
			<?php if (has_post_thumbnail() OR $pm_has_video) { ?>
				<span class="cat-angle angle-right"></span>
				
				<h1 class="entry-title page-featured-title"><?php the_title(); ?></h1>
			<?php } ?>
			
		</div><!-- entry-img -->
			
	</header><!-- .entry-header -->
	
	<div class="boxed clearfix">
	
		<?php if ( !has_post_thumbnail() AND !$pm_has_video) { ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<hr />
		<?php } ?>

		
		
		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'powermag' ), 'after' => '</div>' ) ); ?>
			<?php edit_post_link( '<div class="clear"></div><i class="icon-edit"></i>', '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-content -->
	</div><!--boxed-->
	
</article><!-- #post-<?php the_ID(); ?> -->
