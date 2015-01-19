<?php

global $wp_query;

/*
==========================================================
SET TOP LEVEL PARENT
==========================================================
*/

function pa_category_top_parent_id ($catid) {
	while ($catid) {
	$cat = get_category($catid); // get the object for the catid
	$catid = $cat->category_parent; // assign parent ID (if exists) to $catid
	// the while loop will continue whilst there is a $catid
	// when there is no longer a parent $catid will be NULL so we can assign our $catParent
	$catParent = $cat->cat_ID;
	}
	return(isset($catParent)?$catParent:null);
}

/*
==========================================================
OUTPUT CAT STYLES @since PM 1.1
==========================================================
*/

function pm_output_cat_options(){

	$skin_color = of_get_option( 'pm_color_skin' );
	
	$category = get_the_category(); 
	if (!is_page()) { $category_ID =  $category[0]->cat_ID; } else {$category_ID =  '';} 	
	$category_parent = pa_category_top_parent_id ($category_ID);
	
	// Get current category CSS
	$category_color = get_tax_meta($category_ID,'pm_color_field_id');
	$category_background_image = get_tax_meta($category_ID,'pm_image_field_id');
	$category_background_position = get_tax_meta($category_ID,'pm_background_position');
	$category_custom_css = get_tax_meta($category_ID,'pm_category_custom_css');
	
	// Get parent category CSS 
	$category_parent_color = get_tax_meta($category_parent,'pm_color_field_id');
	$category_parent_background = get_tax_meta($category_parent,'pm_image_field_id');
	$category_parent_background_position = get_tax_meta($category_parent,'pm_background_position');
	$category_parent_custom_css = get_tax_meta($category_parent,'pm_category_custom_css');

	
	// if current category bg returns nothing then set to parent value
	if ($category_background_image == '') {
		$category_background_image = $category_parent_background;		
	}	
	
	// if current category bg position returns nothing then set to parent value
	if ($category_background_position == '') {
		$category_background_position = $category_parent_background_position;		
	}
	
	// if current category css returns nothing then set to parent value
	if ($category_custom_css == '') {
		$category_custom_css = $category_parent_custom_css;		
	}	
	
	// if current category returns no color then set to parent value
	if (strlen($category_color) < 2) {
		$category_color = $category_parent_color;		
	}	
	
	// if there's no parent then use the global option
	if (strlen($category_color) < 2) {
		$category_color = $category_color;		
	}

// Check to make sure the varialbe are set
if (isset($category_background_image) && $category_background_image !== '') { $category_src = $category_background_image['src']; }


if (is_page() || is_search() || is_author() || is_tag() || is_home()) {
	if ( have_posts() ) : while ( have_posts() ) : the_post();
		$category_color = get_post_meta(get_the_ID(), 'pm_page_color', true);
		if (strlen($category_color) < 2 || $category_color === NULL) {
		$category_color = $category_color;		
	}	
	endwhile; endif;
}

	
	// if front page set to posts
$show_on_front = get_option('show_on_front');

if ($show_on_front === 'posts' && empty($category_color) OR $category_color == ' ' /* inheritance fix @since PM 1.4.0 */ ) {$category_color = $skin_color; }
	
	?><style>
		
	<?php
	// Category Colors Inline CSS
	if (!empty($category_color)) { echo('
	
	::-moz-selection {
		background:'.$category_color.'!important;
		color: #fff;
	}
	::selection {
		background:'.$category_color.'!important;
		color: #fff;
	}
	
	*:focus {
		outline-color: '.$category_color.'!important;
	}
	
	.page-nav .current,
	#comments .page-numbers.current,
	.breadcrumb .icon-chevron-right,
	#secondary ul li:before,
	#widgetized-footer ul li:before,
	#secondary ul li:after,
	#widgetized-footer ul li:after,
	.arch-chevron 
	{color:' . $category_color . '}	
	
	.widget-title-bg .widget-title span.inner,
	.widget-title-bg .simil-widget-comment,
	.flex-cat,
	#full-site-info,
	#full-collapsible,
	footer.entry-meta span,
	footer.entry-meta a,
	.flex-control-paging li a.flex-active,
	#carousel div span.selected,
	.reply a,
	#author-wrap .author-name,
	#ticker-wrap span.ticker-title,
	.img-frame,
	.entry-content .gallery .img-frame,
	.rw-end .rw-overall,
	span.criteria-percentage,
	.label,
	#wp-calendar tbody td#today,
	#widgetized-footer #wp-calendar tbody td#today,
	#wp-calendar thead th,
	#wp-calendar tfoot #next,
	#wp-calendar tfoot #prev,
	#wp-calendar tfoot .pad,
	#logo a.demologo,
	div.item-list-tabs ul li a span,
	div.activity-meta a,
	a.bp-primary-action span,
	#reply-title small a span,
	.pm-bp-badge
	{background-color:' . $category_color . '}
	
	.ticker-swipe span
	{border-bottom: 2px solid ' . $category_color . '}

	.cat-diagonal
	{ background: -moz-linear-gradient(-45deg,  ' . $category_color . ' 0%, ' . $category_color . ' 50%, rgba(0,0,0,0) 51%, rgba(0,0,0,0) 100%);
	background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,' . $category_color . '), color-stop(50%,' . $category_color . '), color-stop(51%,rgba(0,0,0,0)), color-stop(100%,rgba(0,0,0,0)));
	background: -webkit-linear-gradient(-45deg,  ' . $category_color . ' 0%,' . $category_color . ' 50%,rgba(0,0,0,0) 51%,rgba(0,0,0,0) 100%);
	background: -o-linear-gradient(-45deg,  ' . $category_color . ' 0%,' . $category_color . ' 50%,rgba(0,0,0,0) 51%,rgba(0,0,0,0) 100%); 
	background: -ms-linear-gradient(-45deg,  ' . $category_color . ' 0%,' . $category_color . ' 50%,rgba(0,0,0,0) 51%,rgba(0,0,0,0) 100%); 
	background: linear-gradient(135deg,  ' . $category_color . ' 0%,' . $category_color . ' 50%,rgba(0,0,0,0) 51%,rgba(0,0,0,0) 100%); }
	
	#collapse-trigger
	{background: -moz-linear-gradient(45deg,  ' . $category_color . ' 0%, ' . $category_color . ' 50%, ' . $category_color . ' 51%, ' . $category_color . ' 100%);
	background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(0,0,0,0)), color-stop(50%,rgba(0,0,0,0)), color-stop(51%,' . $category_color . '), color-stop(100%,rgba(10,8,9,0)));
	background: -webkit-linear-gradient(45deg,  rgba(0,0,0,0) 0%,rgba(0,0,0,0) 50%,' . $category_color . ' 51%,' . $category_color . ' 100%);
	background: -o-linear-gradient(45deg,  rgba(0,0,0,0) 0%,rgba(0,0,0,0) 50%,' . $category_color . ' 51%,' . $category_color . ' 100%);
	background: -ms-linear-gradient(45deg,  rgba(0,0,0,0) 0%,rgba(0,0,0,0) 50%,' . $category_color . ' 51%,' . $category_color . ' 100%);
	background: linear-gradient(45deg,  rgba(0,0,0,0) 0%,rgba(0,0,0,0) 50%,' . $category_color . ' 51%,' . $category_color . ' 100%);}
	
	.cat-angle,
	.date .corner
	{background: -moz-linear-gradient(-45deg,  rgba(0,0,0,0) 0%, rgba(0,0,0,0) 50%, ' . $category_color . ' 51%, ' . $category_color . ' 83%, ' . $category_color . ' 100%);
	background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(0,0,0,0)), color-stop(50%,rgba(0,0,0,0)), color-stop(51%,' . $category_color . '), color-stop(83%,' . $category_color . '), color-stop(100%,' . $category_color . '));
	background: -webkit-linear-gradient(-45deg,  rgba(0,0,0,0) 0%,rgba(0,0,0,0) 50%,' . $category_color . ' 51%,' . $category_color . ' 83%,' . $category_color . ' 100%);
	background: -o-linear-gradient(-45deg, rgba(0,0,0,0) 0%,rgba(0,0,0,0) 50%,' . $category_color . ' 51%,' . $category_color . ' 83%,' . $category_color . ' 100%);
	background: -ms-linear-gradient(-45deg, rgba(0,0,0,0) 0%,rgba(0,0,0,0) 50%,' . $category_color . ' 51%,' . $category_color . ' 83%,' . $category_color . ' 100%);
	background: linear-gradient(135deg,  rgba(0,0,0,0) 0%,rgba(0,0,0,0) 50%,' . $category_color . ' 51%,' . $category_color . ' 83%,' . $category_color . ' 100%);}

	');}
	            
	/* Category Backgrounds */
	
if ( !is_home() ) {	
				
	if ($category_background_image != NULL) { // If has an image uploaded, do the following:
		
		// Tiled Background
		if ($category_background_position == 'tiled') {
			
			echo '
			
			body {
				background-image: url('.$category_src.')!important;
			}';
			
		}
		
		// Static Background	
		if ($category_background_position == 'static') {
			
			echo '
			
			body {
				background-attachment:fixed; background-image: url('.$category_src.')!important;
			}';
			
		}
			
		// CSS3 Full Page Background	
		if ($category_background_position == 'fullscreen') {
			
			echo '
			
			html { 
				background: url('.$category_src.') no-repeat center center fixed!important; 
				-webkit-background-size: cover!important;
				-moz-background-size: cover!important;
				-o-background-size: cover!important;
				background-size: cover!important; 
			}';
			
		}
	}
}

// Remove Ad Wallpaper Link if another BG is set for the category

if ( ($category_background_image != NULL) AND !is_home() ) {
	
	echo '
		
		#wallpaper {
			display: none!important;
			visibility: hidden!important;
		}
	';

}
	
// Check and echo custom CSS for this cat 
	if (isset($category_custom_css) && $category_custom_css !== '') { echo ($category_custom_css.' '); }

?> </style>

<?php }; 
	
add_action('wp_head','pm_output_cat_options');