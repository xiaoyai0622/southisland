<?php // include('../inc/rating-values.php'); // Get ratings output ?>

<?php
$tags = wp_get_post_tags($post->ID);
if ($tags) {
$tag_ids = array();
foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;

$pm_related_count = of_get_option('pm_related_count');

$args=array(
'tag__in' => $tag_ids,
'post__not_in' => array($post->ID),
'showposts'=> $pm_related_count,  // Number of related posts that will be shown.
'ignore_sticky_posts'=>1
);

$i = 1;

$my_query = new wp_query($args);
if( $my_query->have_posts() ) {
echo '<div class="related-posts row">';
while ($my_query->have_posts()) {
$my_query->the_post();
?>

<?php 
$pm_video = get_post_meta(get_the_ID(), 'pm_video_encode', true);
$pm_has_video = $pm_video != ""; 
?>

<div class="widget-post pm-first span2 clearfix">
		<div class="img-frame <?php if ( !has_post_thumbnail() ) echo 'no-thumb'?>">
			<?php if ( has_post_thumbnail() ) { the_post_thumbnail('small-thumbs', array('alt' => get_the_title(), 'title' => get_the_title())); 
			} else {
				echo '<a href="'. get_permalink() .'" alt="'. get_the_title() .'" title="'. get_the_title() .'"><span class="no-thumb-img"></span></a>'; 
				}
				
				if ( $pm_has_video ) { echo '<span class="pm-icon"><i class="icon-play"></i></span>'; }
			?>
			
			<?php 
			$pm_review_enable = get_post_meta(get_the_ID(), 'pm_review_enable', true);
			$pm_overall_score = get_post_meta(get_the_ID(), 'pm_overall_score', true);
			$pm_review_type = get_post_meta(get_the_ID(), 'pm_review_type', true);

			
			if ( $pm_review_enable ) { 
			
				if ( $pm_review_type == 'percent' ) {
			
				?>
			
				<div class="entry-rating-wrap percent-small">
					<span class="entry-rating"><?php echo $pm_overall_score ?></span>
				</div>
			
				<?php } else { ?>
				
				<div class="rw-criteria stars-preview stars-small">
					<span class="criteria-stars-color">
						<span class="criteria-stars-overlay" style="width:<?php echo $pm_overall_score; ?>%"></span>
					</span>
				</div>
				
				<?php } 
			} ?>
			
		</div>
		
	<div class="entry-info">

		<h4 class="entry-title">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
		</h4>
		
		<div class="entry-meta">
			<span class="entry-date">
			<?php the_time(get_option('date_format')); ?>
			</span>
			
			<span class="entry-comments">
			<?php comments_number( '0', '1', '%' ); ?>
			</span>
		</div>

	</div><!--entry-info-->
</div><!-- .widget-post -->

<?php 

if ( ($i % 4 == 0) && $pm_related_count > 4 ) { /* @since PM 1.5.0 */
	
	echo '<div class="clear" style="margin-bottom: 20px;"></div>';} 

$i++;

}
echo '</div>';
}
}
wp_reset_query();
?>
