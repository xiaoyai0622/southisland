<?php

function pm_user_css () {
		
		$output = '';

/*
==========================================================
SKIN COLOR
==========================================================

Check partials/part-cat-options.php to edit inline 
styles for global skin and categories colors
*/

	/*
	======================================================
	Text Color On Skin
	======================================================
	*/
	
	$color_skin_text = of_get_option('pm_color_skin_text');
	
		{
			/* All */
			$output .= 
			'
			.widget-title span.inner,
			.widget-title span.inner a,
			.simil-widget-comment span.inner,
			.simil-widget-comment span.inner a,
			#collapse-trigger a:hover,
			#newsletter h2,
			.main-navigation ul ul a,
			.main-small-navigation ul.sub-menu li a,
			.entry-img-info .flex-cat a,
			footer.entry-meta span,
			footer.entry-meta .edit-link a,
			.reply a,
			div.activity-meta a,
			#author-wrap .author-name,
			#author-wrap .author-name a,
			#ticker-wrap span.ticker-title,
			.label a,
			.label,
			.rw-overall,
			#wp-calendar thead th, #wp-calendar tbody td#today,
			#wp-calendar tfoot #next a, #wp-calendar tfoot #prev a, #wp-calendar tfoot #next, #wp-calendar tfoot #prev, #wp-calendar tfoot .pad,
			.utilities.footer ul li a,
			#carousel div span.selected,
			div.item-list-tabs ul li a span,
			.pm-bp-badge
			{color:' . $color_skin_text . '}
			';
		}	

/*
==========================================================
PRIMARY COLOR
==========================================================
*/

$color_primary = of_get_option( 'pm_color_primary' );
		
		{
			
			$output .= 
			'
			#full-top,
			#full-footer,
			.main-navigation li,
			.menu-toggle,
			#carousel div span,
			.es-nav span.es-nav-next,
			.es-nav span.es-nav-prev,
			.widget-title-bg,
			.widget-post.pm-first,
			#ticker-wrap,
			.ticker,
			.ticker-swipe,
			.ticker-swipe span,
			.rw-criteria,
			.rw-end,
			.rw-user-rating-wrapper,
			.post-widget li:hover .info-stripe i,
			.wpcf7 label,
			.wp-caption-text,
			.gallery-caption,
			.gallery-caption:before,
			.social-count-plus a:hover .social-count-go,
			.cat-tabs ul,
			.cat-tabs ul li a,
			.reply a:hover,
			div.activity-meta a:hover,
			.tooltip-inner,
			.activity-content a.loading,
			.activity-content.no-inner-content .activity-meta a:hover
			{background-color:' . $color_primary . '}
			';
			
			$output .= 
			'
			.label:hover
			{background: ' . $color_primary . '!important}
			';

			$output .= 
			'
			.post-widget li:hover .info-stripe i
			{border-left: 1px solid ' . $color_primary . '}
			';

			$output .= 
			'
			.social-count-plus a:hover .social-count-go
			{border: 1px solid ' . $color_primary . '}
			';
			
			$output .= 
			'
			.tooltip.right .tooltip-arrow
			{border-right-color: ' . $color_primary . ' }
			';

		}
		
	/*
	======================================================
	Text Color On Primary
	======================================================
	*/
	
	$color_primary_link = of_get_option('pm_color_primary_link');
	$color_primary_hover = of_get_option('pm_color_primary_hover');
	$color_primary_body = of_get_option('pm_color_primary_body');
	
			{
				/*Links*/
				$output .= 
				'
				.main-navigation a,
				.widget-post.pm-first a,
				.ticker-content a,
				.utilities ul li a,
				.cat-tabs ul li a,
				.reply a:hover,
				.activity-content.no-inner-content .activity-meta a:hover
				{color:' . $color_primary_link . '}
				';
				
				/*Hovers*/
				$output .= 
				'
				.main-navigation a:hover,
				.widget-post.pm-first a:hover,
				.ticker-content a:hover,
				.utilities ul li a:hover,
				.cat-tabs ul li a:hover
				{color:' . $color_primary_hover . '; 
				text-shadow: 0px 0px 2px rgba(255, 255, 255, 0.3);}
				';
				
				/*Regular Text*/
				$output .= 
				'
				#widgetized-footer .widget-title span.inner,
				#widgetized-footer .widget-title span.inner a,
				.widget-post.pm-first,
				.menu-toggle,
				article .entry-rating-wrap,
				.post-widget li:hover .info-stripe i,
				.social-count-plus a:hover .social-count-go,
				.es-nav span.es-nav-next i,
				.es-nav span.es-nav-prev i,
				#rating-box,
				.rw-user-rating-desc,
				.wpcf7 label,
				#carousel div span
				{color:' . $color_primary_body . '}
				';
	
			}

		
/*
==========================================================
SECONDARY COLOR
==========================================================
*/
		
$color_secondary = of_get_option( 'pm_color_secondary' );
		
		{
			
			$output .= 
			'
			#full-bar,
			.boxed,
			#respond,
			.boxed-title,
			.main-small-navigation ul li a,
			.related-posts .pm-first,
			footer.entry-meta li a,
			footer.entry-meta .tag-list a,
			.carousel-text,
			.widget-post,
			.widget ul li,
			a.follow-us,
			a.twtr-join-conv,
			.twtr-widget .twtr-tweet-wrap,
			.twtr-widget .twtr-hd,
			.ads-widget,
			.comment.boxed,
			.nocomments,
			.lwa.default, 
			.lwa-register.default,
			.date,
			.cat-panes-content li.panes,
			.breadcrumb,
			#wp-calendar caption,
			#wp-calendar tbody .pad:hover,
			#wp-calendar tbody td,
			.widget-text-only,
			div.item-list-tabs,
			div.activity-comments form.ac-form,
			div.activity-comments > ul li,
			ul#members-list li,
			ul#group-members-list li,
			ul#groups-list li,
			ul#friend-list li,
			.activity-list li .activity-content,
			.padder div.pagination,
			div.messages-options-nav,
			table#message-threads tr td,
			div.activity-meta
			{background-color:' . $color_secondary . '}
			';

		}
		

	/*
	======================================================
	Text Color On Secondary
	======================================================
	*/
	
	$color_secondary_link = of_get_option('pm_color_secondary_link');
	$color_secondary_hover = of_get_option('pm_color_secondary_hover');
	$color_secondary_body = of_get_option('pm_color_secondary_body');
	
			{
				/*Links*/
				$output .= 
				'
				a,
				.date a,
				.related-posts .pm-first a
				{color:' . $color_secondary_link . '}
				';
				
				/*Hovers*/
				$output .= 
				'
				a:hover,
				.date a:hover,
				.related-posts .pm-first a:hover,
				.widget .widget-post.pm-rest a:hover
				{color:' . $color_secondary_hover . '}
				';
				
				/*Regular Text*/
				$output .= 
				'
				body,
				.affiliate-wrap p
				{color:' . $color_secondary_body . '}
				';
				
			}

/*
==========================================================
FREE OR BOXED
==========================================================
*/

$boxed = of_get_option('pm_boxed') == 'boxed';
$boxed_bg = of_get_option('pm_boxed_bg');
$boxed_shadow = of_get_option('pm_boxed_shadow') == 'true';

			if ($boxed) {

				$output .= 
				'
				.full-main {
				 	padding: 0 20px;
				';
				
			if ( $boxed_shadow ) {
				
				$output .= '	
					-moz-box-shadow: 0 20px 150px -40px #000;
					-ms-box-shadow: 0 20px 150px -40px #000;
					-o-box-shadow: 0 20px 150px -40px #000;
					-webkit-box-shadow: 0 20px 150px -40px #000;
					box-shadow: 0 20px 150px -40px #000;
				';
			}

			if ( $boxed_bg['image'] ) {
				
				$output .= '	
					background-image:url('. $boxed_bg['image']. '); 
					background-repeat:' . $boxed_bg['repeat'] . '; 
					background-position:' . $boxed_bg['position'] . ';
					background-attachment:' . $boxed_bg['attachment'] . ';
					background-color:' . $boxed_bg['color'] . ';
				}';
			} else {
					
				$output .= '
					background-color:' . $boxed_bg['color'] . ';
				}';
			}

				$output .= '	
				
				#full-top, #full-bar, #full-footer, #full-site-info, #full-collapsible {
				 	margin-left: -20px;
					margin-right: -20px;
				}
				
				.logged-in #collapse-trigger {
					right: -20px!important;
				}
				
				.util-menu ul {
				 	text-align: left!important;
				}';
				
				/* reset on mobiles */
				$output .= '
				
				@media (max-width: 767px) {
					.full-main {
						padding: 0;
						box-shadow: none;
						background: none;
					}
					#full-top, #full-bar, #full-footer, #full-site-info, #full-collapsible {
				 		
					}
					.utilities ul {
					 	text-align: center;
					}
				}';
			
			}
			
/*
======================================================
GRAYSCALE EFFECT
======================================================
*/

$grayscale = of_get_option('pm_grayscale');

	if ($grayscale) {

		{
			/*All Images*/
			$output .= 
			'
			img {   
				filter: url('. get_template_directory_uri() .'/images/filters.svg#grayscale); /* Firefox 3.5+ */
				filter: gray; /* IE6-9 */
				-webkit-filter: grayscale(1); /* Google Chrome & Safari 6+ */
				-webkit-transition: all 0.6s;
			}';
			
			/*Hovers*/
			$output .= 
			'
			.widget:hover img,
			article:hover img,
			#author-wrap:hover img,
			.sliders:hover img,
			.cat-panes-content:hover img,
			.lwa:hover img,
			.related-posts:hover img {   
				filter: none;
				-webkit-filter: grayscale(0);
			}';
			
			/*Excluded Images*/
			$output .= 
			'
			#logo img,
			ul.socials img,
			.widget:hover img,
			article:hover img,
			#author-wrap:hover img,
			.sliders:hover img,
			.cat-panes-content:hover img,
			.lwa:hover img,
			.related-posts:hover img {
				filter: none;
				-webkit-filter: grayscale(0);
			}';
		}
	}
	
/*
======================================================
LEADERBOARD TOP ADD
======================================================
*/

$leaderboard = of_get_option('pm_leaderboard');

	if ($leaderboard) {

		{
			/* Header Design Adjustments */
			$output .= 
			'
			@media (min-width: 1199px) {
			
				#logo {
					margin-top: 10px;
				}
				#top-ad {
					margin-left: 60px;
				}
				ul.socials {
					max-width: 160px;
					margin-top: 23px
				}
				.util-menu li {
					display: block!important;
					text-align: right;
				}
				.utilities {
					width: 130px;
				}
				.util-menu li {
					padding-right: 0!important;
					padding-bottom: 3px
				}
				.boxed-layout .util-menu ul li {
					text-align: center!important;
				}
			}
			
			@media (max-width: 1199px) {
			
				#top-ad {
				  margin-left: 0;
				}
			}
			
			@media (max-width: 979px) and (min-width: 768px) {
			
				#logo{
					float: none;
					text-align: center;
					margin-bottom: 20px;
				}
			
				.branding {
					float: none;
				}
			}';
		}
	}

/*****Output*****/
		
		if ( $output != '' ) {
			$output = '<style>' . $output . '</style>';
			echo $output;
		}
	}
add_action('wp_head', 'pm_user_css');

?>