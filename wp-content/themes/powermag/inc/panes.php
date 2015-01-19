<?php
function mm_cat_tabs($content) { ?>

<ul>
	<?php
	$tab_tag = of_get_option($content.'_tag'); 
	$tab_cat = of_get_option($content.'_category');
	$tab_display = of_get_option($content.'_display'); 
	$count = of_get_option($content.'_posts');
     ?>
	
	<?php if($tab_display == 'category') { ?>
	<?php query_posts(array('posts_per_page' => $count, 'cat' => $tab_cat )); ?>
	<?php } ?>
	<?php if($tab_display == 'latest') { ?>
	<?php query_posts(array('posts_per_page' => $count )); ?>
	<?php } ?>
	<?php if($tab_display == 'tag') { ?>
	<?php query_posts(array('posts_per_page' => $count, 'tag' => $tab_tag )); ?>
	<?php } ?>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	
	<?php 
	
	$category = get_the_category(); 
	$category_ID =  $category[0]->cat_ID;		
	$category_parent = pa_category_top_parent_id ($category_ID);
	
	// Get current category CSS
	$category_color = get_tax_meta($category_ID,'pm_color_field_id');

	// Get Video Icon
	$pm_video = get_post_meta(get_the_ID(), 'pm_video_encode', true);
	$pm_has_video = $pm_video != ""; 
?>
	
	<li class="panes clearfix">
	
		<div class="left-wrap panes-left">
			<div class="img-frame <?php if ( !has_post_thumbnail() ) echo 'no-thumb'?>" style="background-color: <?php echo $category_color ?>">
				<?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'tabs-thumbs', array( 'alt' => get_the_title(), 'title' => get_the_title() ) );
						
						} else {
							
					echo '<a href="'. get_permalink() .'" title="'. get_the_title() .'"><span class="no-thumb-img"></span></a>'; }
				
					if ( $pm_has_video ) { echo '<span class="pm-icon"><i class="icon-play"></i></span>'; }
				?>
			</div>
		</div>

		<div class="panes-right entry-info">
			<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		
			<div class="entry-meta">
				<span class="entry-date">
				<?php the_time(get_option('date_format')); ?>
				</span>
				
				<span class="entry-comments">
				<?php comments_number( '0', '1', '%' ); ?>
				</span>
			</div><!--entry-meta-->
			<?php include( 'widgets/cat-angle.php'); ?>
				
		</div><!-- entry-info-->	
		
	</li>
	<?php endwhile; ?>

	<?php  endif; ?>
	<?php wp_reset_query(); ?>
</ul>

<?php } ?>