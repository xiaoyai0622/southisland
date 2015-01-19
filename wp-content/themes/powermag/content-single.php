<?php
/**
 * @package PowerMag
 * @since PowerMag 1.0
 */
?>
<?php include ('inc/rating-values.php'); // Get ratings output ?>

<?php
	// Load Facebook SDK if needed
	$social_multicheck = of_get_option('pm_social_share'); 
	$pm_comment_type = get_post_meta(get_the_ID(), 'pm_comment_type', true); /* @since PM 1.4.0 */ 
	
	if ($social_multicheck['fb_share'] == true OR $pm_comment_type == 'fb') {
		echo '<div id="fb-root"></div>';
		echo '
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, "script", "facebook-jssdk"));
		</script>';		
	}
?>

<?php 

$std_style = of_get_option('pm_blogstyle') == 'default';
$pm_video = get_post_meta(get_the_ID(), 'pm_video_encode', true);
$pm_has_video = $pm_video != ""; 
$full_width = get_post_meta(get_the_ID(), 'pm_full_width_switch', true);
$small_featured = get_post_meta(get_the_ID(), 'pm_small_featured_switch', true); /* @since PM 1.4.0 */ 

$hide_featured = get_post_meta(get_the_ID(), 'pm_hide_featured_switch', true); /* @since PM 1.5.0 */
$has_post_thumbnail = has_post_thumbnail();

	if ($hide_featured) {
	
		$has_post_thumbnail = !$hide_featured;
		$small_featured = !$hide_featured;
		
	}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<div class="article-content-wrapper<?php if ( !has_post_thumbnail() ) echo ' img-less' /* @since PM 1.5.1 */ ?>">
		<header class="entry-header">
			
			<?php if ( of_get_option('pm_breadcrumb') ) echo pm_breadcrumb(); ?>

			<div class="entry-img">	
				
			<?php if (!$small_featured) { /* @since PM 1.4.0 */  ?>
				
				<?php if ($has_post_thumbnail OR $pm_has_video ) { ?>
					
				<span class="entry-img-src">
				<?php 
					if ($has_post_thumbnail AND !$pm_has_video AND !$full_width) { the_post_thumbnail('slider-cat');} 
					elseif ($has_post_thumbnail AND !$pm_has_video AND $full_width ) { the_post_thumbnail('slider-single');} /* @since PM 1.1 */
					elseif ($pm_has_video) echo $pm_video;
				
				} ?>
				</span>
				
			<?php } ?>
			
				<span class="entry-img-info">
					<span class="flex-cat">						
					<?php
						$category = get_the_category($post->ID);
						$cat_id = get_cat_ID( $name );
						$link = get_category_link( $cat_id );
						
						if ( of_get_option('pm_parentcat') == 'end' ) {
							echo '<a href="'. get_category_link( end($category)->term_id ) .'">'. end($category)->cat_name .'</a>';
						} else {
						
						$parentscategory ="";
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
					<abbr class="updated" title="<?php the_modified_time(); ?>"></abbr>
				</span>
			
			<?php if ( !$small_featured ) { ?>
			
				<?php if ($has_post_thumbnail OR $pm_has_video) { ?>
				<span class="cat-angle angle-right"></span>
				<?php } ?>
			
			<?php } ?>
			
		</div><!-- entry-img -->
		<div class="clear"></div>
		
		<?php /* Display top rating box if enabled */ 
			if ( ($pm_review_enable) AND ($pm_box_position) == 'top' ) {  
				
				if ( ($pm_review_type) == 'percent' ) {
					include('partials/part-review-percent.php');
				} else {
					include('partials/part-review-stars.php');	
				}
			}
		?>
				
		</header><!-- .entry-header -->
		
		<div class="boxed clearfix <?php if (!$has_post_thumbnail AND !$pm_has_video OR $small_featured) echo 'in-content-featured'?>">
		
		<?php if ( !$small_featured ) { ?>
		
			<?php if ($has_post_thumbnail OR $pm_has_video) { ?>
			<hr style="margin:0 0 20px" />
			<?php } ?>
		
		<?php } ?>
		
			<h1 class="entry-title <?php if (!$has_post_thumbnail AND !$pm_has_video OR $small_featured) echo 'no-featured'?>"><?php the_title(); ?></h1>
			<hr />
			
			<div class="entry-content">
			
			<?php /*Small Featured Image/Video Option - @since PM 1.4.0 */
							
				if ($small_featured AND !$pm_has_video) { ?><div class="entry-img"><span class="entry-img-src"><?php the_post_thumbnail('loop'); ?></span></div>
				
			<?php } 
			
				 if ($small_featured AND $pm_has_video) { ?><div class="entry-img"><span class="entry-img-src"><?php echo $pm_video; ?></span></div>
				
			<?php } ?>
	
			<?php /* Display floated rating box if enabled */ 
				if ( ($pm_review_enable) AND ($pm_box_position) == 'floated' ) {  
					
					if ( ($pm_review_type) == 'percent' ) {
						include('partials/part-review-percent.php');
					} else {
						include('partials/part-review-stars.php');	
					}
				}
			?>
				
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'powermag' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->
		
			<?php /* Display bottom rating box if enabled */ 
				if ( ($pm_review_enable) AND ($pm_box_position) == 'bottom' ) {  
					
					if ( ($pm_review_type) == 'percent' ) {
						include('partials/part-review-percent.php');
					} else {
						include('partials/part-review-stars.php');	
					}
				}
			?>
			
			<?php //Get user rating standalone @since PM 1.7.0
			$pm_user_rating_switch = get_post_meta($post->ID, 'pm_user_rating_switch', true);
				if ( ($pm_user_rating_switch) AND (!$pm_review_enable) ) { get_template_part ('partials/part', 'user-rating'); 
			} ?>
				
			<?php //Social Share Links
			$social_multicheck = of_get_option('pm_social_share');
			
			if ($social_multicheck['twitter_share'] == true OR $social_multicheck['fb_share'] == true OR $social_multicheck['google_share'] == true OR $social_multicheck['linkedin_share'] == true OR $social_multicheck['pinit_share'] == true OR $social_multicheck['stumble_share'] == true)  {
				echo '<hr /><ul class="social-share">';
				echo get_template_part( 'partials/part', 'social-share' );
				echo '</ul>';
			} ?>
		
		</div><!-- .boxed-->
		
		<footer class="entry-meta">
			<?php
				/* translators: used between list items, there is a space after the comma */
				$category_list = get_the_category_list('','powermag');
	
				/* translators: used between list items, there is a space after the comma */
				$tag_list = '<div class="tag-list">' . get_the_tag_list() . '</div>';
	
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
	
			<?php edit_post_link( '<i class="icon-edit"></i>', '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
	
	</div><!-- article-content-wrapper-->
	
</article><!-- #post-<?php the_ID(); ?> -->


<?php //Get Author Box
if ('post' == get_post_type() && ( of_get_option('pm_author')) ) echo get_template_part ('partials/part', 'author');
?>

<?php //Get Related Posts
if (of_get_option('pm_related')) get_template_part('partials/part', 'related');?>