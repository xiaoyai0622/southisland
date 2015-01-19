<?php
/**
 * @package PowerMag
 * @since PowerMag 1.0
 */
?>

<?php 
$std_style = of_get_option('pm_blogstyle') == 'default';
$pm_video = get_post_meta(get_the_ID(), 'pm_video_encode', true);
$pm_has_video = $pm_video != ""; 
	
$category = get_the_category(); 
$category_ID =  $category[0]->cat_ID;		
$category_parent = pa_category_top_parent_id ($category_ID);
$cat_tooltip = of_get_option('pm_cat_tooltip');	

// Get current category CSS
$category_color = get_tax_meta($category_ID,'pm_color_field_id');					
?>

<article <?php if ($cat_tooltip) { ?>rel="tooltip" data-html="true" data-title="<ul class='cat-tooltip'>
<?php
//prints category names if cat tooltips are enabled @since PowerMag 1.02

foreach((get_the_category()) as $category) { 
    echo '<li>'.$category->cat_name .'</li>';
}
 
?>
</ul>
" data-placement="right" <?php } ?>id="post-<?php the_ID(); ?>" <?php if ($std_style) { post_class('pull-left box'); } else { post_class(); } // Apply Masonry Class for main layout ?>>

<div class="article-content-wrapper<?php if ( !has_post_thumbnail() ) echo ' img-less' /* @since PM 1.5.0 */ ?>">

	<div class="entry-img">
		<div class="img-frame <?php if ( !has_post_thumbnail() ) echo 'no-thumb'?>" style="background-color:<?php echo $category_color ?>">
			
	<?php if ( has_post_thumbnail() OR $pm_has_video ) { ?>
			
			<?php if ( has_post_thumbnail() ) { ?>
		
					<?php if ( $std_style ) { the_post_thumbnail('loop'); } else { the_post_thumbnail('slider-cat'); } ?>
								
			<?php } else { 
			
			 echo '<a href="'. get_permalink() .'" title="'. get_the_title() .'" ><span class="no-thumb-img"></span></a>'; 
			 
			 } ?>
			
			<?php if ( $pm_has_video ) { echo '<a href="'. get_permalink() .'" title="'. get_the_title() .'" ><span class="pm-icon"><i class="icon-play"></i></span></a>'; } ?>
			
			<?php 			
					$pm_review_enable = get_post_meta(get_the_ID(), 'pm_review_enable', true);
					$pm_review_type = get_post_meta(get_the_ID(), 'pm_review_type', true);
					$pm_overall_score = get_post_meta(get_the_ID(), 'pm_overall_score', true);
	
					if ( $pm_review_enable ) { 
				
						if ( $pm_review_type == 'percent' ) {
					
						?>
					
						<div class="entry-rating-wrap">
							<span class="entry-rating"><?php echo $pm_overall_score ?></span>
						</div>
					
						<?php } else { ?>
						
						<div class="rw-criteria stars-preview">
							<span class="criteria-stars-color">
								<span class="criteria-stars-overlay" style="width:<?php echo $pm_overall_score; ?>%"></span>
							</span>
						</div>
						
						<?php } 
					}
	} ?>
					
					<span class="entry-img-info">
						<span class="flex-cat" style="background:<?php echo $category_color ?>">
						<?php
							$category = get_the_category($post->ID);
							$cat_id = get_cat_ID( $name );
							$link = get_category_link( $cat_id );
							
							if ( of_get_option('pm_parentcat') == 'end' ) {
								echo '<a href="'. get_category_link( end($category)->term_id ) .'">'. end($category)->cat_name .'</a>';
							} else {
							
							$parentscategory = "";
								foreach((get_the_category()) as $category) {
									if ($category->category_parent == 0) {
										$parentscategory .= ' <a href="' . get_category_link($category->cat_ID) . '" title="' . $category->name . '">' . $category->name . '</a>, ';
									}
								}
								echo substr($parentscategory,0,-2);
							}
						?>
						
						</span>
						<span class="entry-posted-on"><?php powermag_posted_on(); ?></span>
					</span>
					
					<?php if ( has_post_thumbnail() OR $pm_has_video ) { ?>
					<?php include( 'inc/widgets/cat-angle.php'); ?>
					<?php } ?>
					
		</div><!--entry-img -->
	</div><!-- img-frame -->
	
	
		<div class="boxed clearfix">	
				<header class="entry-header">
				
					<?php if ( has_post_thumbnail() OR $pm_has_video ) echo '<hr style="margin:0 0 20px">'; ?>
	
					<h1 class="entry-title <?php if( !has_post_thumbnail() AND !$pm_has_video ) echo 'no-featured' ?>"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'powermag' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
					<hr />
			
					<?php if ( 'post' == get_post_type() ) : ?>
					
					<?php endif; ?>
				</header><!-- .entry-header -->
			
				<?php if ( is_search() ) : // Only display Excerpts for Search ?>
				<div class="entry-summary">
					<?php the_excerpt(); ?>
				</div><!-- .entry-summary -->
				<?php else : ?>
				<div class="entry-content">
	
					<?php 
					$excerpt = get_the_excerpt();
					$excerpt_count = of_get_option('pm_excerpt_count');	
						
						if (of_get_option('pm_excerpt') == 'moretag') 
							the_content( '<span class="label label-cat" style="background-color: '. $category_color .'"> ' . __('Continue Reading', 'powermag') . ' <span class="meta-nav">&rarr;</span></span>' );
					
						else {
							 echo '<p>';
							 echo string_limit_words($excerpt,$excerpt_count);
							 echo ' <a href="' . get_permalink() . '" title="' . get_the_title() . '" class="label label-cat" style="background-color: '. $category_color .'">' . __('Continue Reading', 'powermag') . ' <span class="meta-nav">&rarr;</span></a>';
							 echo '</p>';
						};
					?>
	
					<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'powermag' ), 'after' => '</div>' ) ); ?>
				</div><!-- .entry-content -->
				<?php endif; ?>
		</div><!-- .boxed -->
			
		<?php if (of_get_option('pm_archive_entry_meta')) { ?>
		<footer class="entry-meta">
			<?php
				/* translators: used between list items, there is a space after the comma */
				$category_list = get_the_category_list('','powermag');
	
				/* translators: used between list items, there is a space after the comma */
				$tag_list = get_the_tag_list();
	
				if ( ! powermag_categorized_blog() ) {
					// This blog only has 1 category so we just need to worry about tags in the meta text
					if ( '' != $tag_list ) {
						$meta_text = __( '<span class="tags"><i class="icon-tags"></i></span>%2$s', 'powermag' );
					}
	
				} else {
					// But this blog has loads of categories so we should probably display them here
					if ( '' != $tag_list ) {
						$meta_text = __( '<span><i class="icon-folder-open"></i></span>%1$s<span class="tags"><i class="icon-tags"></i></span>%2$s', 'powermag' );
					} else {
						$meta_text = __( '<span><i class="icon-folder-open"></i></span>%1$s', 'powermag' );
					}
	
				} // end check for categories on this blog
	
				
				printf(
					$meta_text,
					$category_list,
					$tag_list,
					get_permalink(),
					the_title_attribute( 'echo=0' )
				);
			?>
			
			<span class="comments-link"><i class="icon-comment"></i></span>
			<?php comments_popup_link( __( 'Leave a comment', 'powermag' ), __( '1 Comment', 'powermag' ), __( '% Comments', 'powermag' ) );?>
	
			<?php edit_post_link( '<i class="icon-edit"></i>', '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
		<?php } ?>
	
	</div><!-- article-content-wrapper-->
</article><!-- #post-<?php the_ID(); ?> -->