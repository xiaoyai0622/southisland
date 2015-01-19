<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {


	// Background Defaults
	$background_defaults = array(
		'color' => '#ffffff',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );
		
	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);
	
	// Yes/No Array
	$yesno_array = array(
		'true' => __('Yes', 'powermag'),
		'false' => __('No', 'powermag'),
	);
	
	// Social Share Multicheck Array
	$social_share_array = array(
		'twitter_share' => __('Share on Twitter', 'powermag'),
		'google_share' => __('Google +1', 'powermag'),
		'fb_share' => __('Facebook Like', 'powermag'),
		'linkedin_share' => __('Linked In Share', 'powermag'),
		'pinit_share' => __('Pin it Button', 'powermag'),
		'stumble_share' => __('Stumble Upon Share', 'powermag')
	);
	
	// Social Share Multicheck Defaults
	$social_share_defaults = array(
		'twitter_share' => '1',
		'google_share' => '1',
		'facebook_share' => '1'
	);
	
	//Mixing Standard and Google Fonts Arrays (font arrays in admin/functions-extended/fn-typography.php)
	$typography_mixed_fonts = array_merge( pm_get_os_fonts() , pm_get_google_fonts() );
	asort($typography_mixed_fonts);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
		$options_categories['all'] = 'All Categories';
	}
	
	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}
	
	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/admin/options-core/images/';

	
	// OPTIONS

	$options = array();
	
	// Basics

	$options[] = array(
		'name' => __('Basic Settings', 'powermag'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Header Logo Upload', 'powermag'),
		'desc' => __('Select the image to use as logo.', 'powermag'),
		'id' => 'pm_logo',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Home Style', 'powermag'),
		'id' => 'pm_homestyle',
		'std' => 'widgetized',
		'type' => 'select',
		'options' => array(
			'widgetized' => 'Widgetized Home (Magazine)',
			'classic' => 'Classic Blog' )
		);

	$options[] = array(
		'name' => __('Blog Entries Style', 'powermag'),
		'id' => 'pm_blogstyle',
		'std' => 'default',
		'type' => 'images',
		'options' => array(
			'default' => $imagepath . 'entry_small.png',
			'alternative' => $imagepath . 'entry_big.png',
		)
		);
		
	$options[] = array(
		'name' => __('Post Excerpts', 'powermag'),
		'id' => 'pm_excerpt',
		'desc' => __('Select <em>More Tag</em> if you use the Wordpress --more-- tag for post excerpts, otherwise select <em>Auto Trim</em><strong><em> Notice: </strong>Please be aware that using Auto Trim will not output shortcodes in post excerpts.</em>', 'powermag'),
		'std' => 'autotrim',
		'class' => 'mini',
		'type' => 'select',
		'options' => array(
			'autotrim' => 'Auto Trim',
			'moretag' => 'More Tag')
		);
		
	$options[] = array(
		'name' => __('Words Count', 'powermag'),
		'id' => 'pm_excerpt_count',
		'std' => '25',
		'class' => 'sub',
		'type' => 'range',
			'min' => '5',
			'max' => '100',
			'step' => '1',
			'suffix' => 'words'
		);
		
	$options[] = array(
		'name' => __('Retina Support', 'powermag'),
		'id' => 'pm_retina',
		'type' => 'checkbox',
		'std' => true,
		);	
		
	$options[] = array(
		'name' => __('Display Parent Category', 'powermag'),
		'desc' => __('Choose whether to show the parent category of a post or the end category (default) on post entries (e.g on archive pages and on blog style homepage)', 'powermag'),
		'id' => 'pm_parentcat',
		'type' => 'images',
		'std' => 'end',
		"options" => 
		array (
			'parent' => $imagepath . 'cat_parent.png',
			'end' => $imagepath . 'cat_end.png',
			),
		);

	$options[] = array(
		'name' => __('Full Categories Tooltip', 'powermag'),
		'desc' => __('Show full list of a post categories when hovering an entry in a tooltip.', 'powermag'),
		'id' => 'pm_cat_tooltip',
		'type' => 'checkbox',
		'std' => false,
		);
		
/*	$options[] = array(
		'name' => __('Responsive Layout', 'powermag'),
		'id' => 'pm_responsive',
		'type' => 'checkbox',
		'std' => '1',
		);*/
		
$options[] = array( 
		'name' => __('Custom Favicon','powermag'),
		'desc' => __('Upload a 16px x 16px Png/Gif image to represent your website, this will be displayed right next to your address URL and as a bookmark icon.','powermag'),
		'id' => 'pm_favicon',
		'type' => 'upload');
		
	$options[] = array(
		'name' => __('Footer Logo Upload', 'powermag'),
		'desc' => __('Select the image to use as logo for the footer', 'powermag'),
		'id' => 'pm_footer_logo',
		'type' => 'upload');
		
	$options[] = array(
		'name' => __('Footer Credits', 'powermag'),
		'desc' => __('The text appearing at the bottom of the page. HTML is allowed.', 'powermag'),
		'id' => 'pm_credits',
		'type' => 'textarea',
		'std' => 'PowerMag Magazine WP Theme by djwd. Remove this after purchase.',
		);
		
	// Single
		
	$options[] = array(
		'name' => __('Single', 'powermag'),
		'type' => 'heading');
	
	$options[] = array(
		'name' => __('Display Breadcrumb', 'powermag'),
		'id' => 'pm_breadcrumb',
		'type' => 'checkbox',
		'std' => true,
		);
		
	$options[] = array(
		'name' => __('Display Related Posts', 'powermag'),
		'id' => 'pm_related',
		'type' => 'checkbox',
		'std' => true,
	);
		
	$options[] = array(
		'name' => __('Related Posts Count', 'powermag'),
		'id' => 'pm_related_count',
		'std' => '4',
		'class' => 'sub',
		'type' => 'range',
			'min' => '2',
			'max' => '8',
			'step' => '2',
			'suffix' => 'posts'
		);
		
	$options[] = array(
		'name' => __('Author Info', 'powermag'),
		'desc' => __('Show Author information after a post or review', 'powermag'),
		'id' => 'pm_author',
		'std' => true,
		'type' => 'checkbox'
	);
		
	$options[] = array(
		'name' => __('Back To Top', 'powermag'),
		'desc' => __('Enable/Disable scroll to top button', 'powermag'),
		'id' => 'pm_scrollup',
		'type' => 'checkbox',
		'std' => true
	);
	
	$options[] = array(
		'name' => __('Category Pages Prefix', 'powermag'),
		'desc' => __('Enter the word you want to appear before each category name (i.e. <strong>Category</strong> -> Fashion). Leave empty not to set any.', 'powermag'),
		'id' => 'pm_archive_text',
		'type' => 'text',
		'std' => 'Category'
	);
	
	$options[] = array(
		'name' => __('Facebook Comments USER ID', 'powermag'),
		'desc' => __('Enter your USER ID to allow FB comment moderation', 'powermag'),
		'id' => 'pm_fb_userid',
		'type' => 'text',
		'std' => ''
	);
	
	$options[] = array(
		'name' => __('Facebook Comments APP ID', 'powermag'),
		'desc' => __('Enter your APP ID to allow FB comment moderation', 'powermag'),
		'id' => 'pm_fb_appid',
		'type' => 'text',
		'std' => ''
	);
		
	// Sidebars
	
	$options[] = array(
			'name' => __('Sidebars', 'powermag'),
			'type' => 'heading');		
			
	$options[] = array(
		'name' => __('Sidebar Position', 'powermag'),
		'desc' => __('Move the sidebar left or right', 'powermag'),
		'id' => 'pm_sidebar_position',
		'type' => 'images',
		'std' => 'content-sidebar',
		'options' => array(
			'sidebar-content' => $imagepath . '2col-l.png',
			'content-sidebar' => $imagepath . '2col-r.png',
		)
	);
			
	$options[] = array(
			"name" => "Sidebar Generator",
			"desc" => "Create sidebar for later use on pages and posts",
			"id" => "pm_sidebars",
			"std" => "",
			"type" => "sidebar");
			
	$options[] = array(
		'name' => __('Home Page Sidebar', 'powermag'),
		'desc' => __('Select whether to use the default sidebar or a third homepage widgetized area', 'powermag'),
		'id' => 'pm_third_sidebar',
		'type' => 'select',
		'std' => 'widgetized',
		'options' => array(
			'widgetized' => 'Homepage Third Widgetized Area',
			'standard' => 'Default Sidebar',
		));
		
	$options[] = array(
		'name' => __('BuddyPress Sidebar', 'powermag'),
		'desc' => __('Select whether to use the default sidebar or the BuddyPress sidebar for BP pages', 'powermag'),
		'id' => 'pm_bp_sidebar',
		'type' => 'select',
		'std' => 'standard',
		'options' => array(
			'buddypress_sidebar' => 'BuddyPress Sidebar',
			'standard' => 'Default Sidebar',
		));
		

	// News Ticker

	$options[] = array(
		'name' => __('News Ticker', 'powermag'),
		'type' => 'heading');
		
	$options[] = array(
		'name' => __('Enable News Ticker', 'powermag'),
		'id' => 'pm_ticker',
		'std' => true,
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('Ticker Category', 'powermag'),
		'id' => 'pm_ticker_cat',
		'std' => '1',
		'type' => 'select',
		'class' => 'sub',
		'options' => $options_categories
		);

	$options[] = array(
		'name' => __('Where to display', 'powermag'),
		'id' => 'pm_ticker_where',
		'std' => 'all',
		'type' => 'select',
		'class' => 'sub',
		'options' => array(
			'home' => 'On the homepage only',
			'all' => 'Everywhere',
		));

	$options[] = array(
		'name' => __('Title', 'powermag'),
		'std' => 'Breaking News',
		'id' => 'pm_ticker_title',
		'class' => 'sub',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('News Ticker Post Count', 'powermag'),
		'id' => 'pm_ticker_count',
		'std' => '6',
		'class' => 'sub',
		'type' => 'range',
			'min' => '1',
			'max' => '25',
			'step' => '1',
			'suffix' => 'posts'
		);
		
	$options[] = array(
		'name' => __('Show Controls', 'powermag'),
		'id' => 'pm_ticker_controls',
		'std' => true,
		'class' => 'sub',
		'type' => 'checkbox'
		);
		
	$options[] = array(
		'name' => __('Animation', 'powermag'),
		'id' => 'pm_ticker_animation',
		'std' => 'reveal',
		'class' => 'sub mini',
		'type' => 'select',
		'options' => array(
			'reveal' => 'Reveal',
			'fade' => 'Fade' )
		);
		
	$options[] = array(
		'name' => __('Pause Duration Before Being Replaced', 'powermag'),
		'id' => 'pm_ticker_revealspeed',
		'std' => '0.1',
		'class' => 'sub',
		'type' => 'range',
			'min' => '0.01',
			'max' => '0.99',
			'step' => '0.01',
			'suffix' => 'ms'
		);
		
	$options[] = array(
		'name' => __('Pause Duration Before Being Replaced', 'powermag'),
		'id' => 'pm_ticker_pause',
		'std' => '2000',
		'class' => 'sub',
		'type' => 'range',
			'min' => '200',
			'max' => '10000',
			'step' => '100',
			'suffix' => 'ms'
		);
		
	$options[] = array(
		'name' => __('Speed of Fade In Animation', 'powermag'),
		'id' => 'pm_ticker_speedin',
		'std' => '600',
		'class' => 'sub',
		'type' => 'range',
			'min' => '100',
			'max' => '1000',
			'step' => '100',
			'suffix' => 'ms'
		);
		
	$options[] = array(
		'name' => __('Speed of Fade Out Animation', 'powermag'),
		'id' => 'pm_ticker_speedout',
		'std' => '300',
		'class' => 'sub',
		'type' => 'range',
			'min' => '100',
			'max' => '1000',
			'step' => '100',
			'suffix' => 'ms'
		);
			

	// Sliders

$options[] = array(
	'name' => __('Sliders', 'powermag'),
	'type' => 'heading');

	$options[] = array( 
		"name" => "Enable Primary Slider",
		"id" => "pm_slider_1",
		"desc" => "*Please keep in mind that activating at least the primary slider is <strong>mandatory</strong> for the rest to appear",
		"type" => "checkbox",
		"std" => false,
		);

	$options[] = array(
		'name' => __('Post Count', 'powermag'),
		'id' => 'pm_slider_1_count',
		'std' => '4',
		'class' => 'sub',	
		'type' => 'range',
			'min' => '1',
			'max' => '20',
			'step' => '1',
			'suffix' => 'posts'
			);
			
	$options[] = array(
		'name' => __('Excerpt Words Count', 'powermag'),
		'id' => 'pm_slider_1_words',
		'std' => '18',
		'class' => 'sub',	
		'type' => 'range',
			'min' => '0',
			'max' => '100',
			'step' => '1',
			'suffix' => 'words'
			);
			
	$options[] = array(
		'name' => __('Starting Slide', 'powermag'),
		'id' => 'pm_slider_1_start',
		'std' => '0',
		'class' => 'sub',
		'type' => 'range',
			'min' => '0',
			'max' => '20',
			'step' => '1',
			'suffix' => 'slide'
		);
			
	$options[] = array(
		'name' => __('Animation', 'powermag'),
		'id' => 'pm_slider_1_animation',
		'std' => 'slide',
		'class' => 'sub mini',
		'type' => 'select',
		'options' => array(
			'slide' => 'Slide',
			'fade' => 'Fade' )
		);
			
	$options[] = array(
		'name' => __('Direction', 'powermag'),
		'id' => 'pm_slider_1_direction',
		'std' => 'vertical',
		'class' => 'sub mini',
		'type' => 'select',
		'options' => array(
			'vertical' => 'Vertical',
			'horizontal' => 'Horizontal' )
		);

	$options[] = array(
		'name' => __('SlideShow Speed', 'powermag'),
		'id' => 'pm_slider_1_slide_speed',
		'std' => '7000',
		'class' => 'sub',
		'type' => 'range',
			'min' => '1000',
			'max' => '9999',
			'step' => '100',
			'suffix' => 'milliseconds'
		);
		
	$options[] = array(
		'name' => __('Animation Speed', 'powermag'),
		'id' => 'pm_slider_1_anim_speed',
		'std' => '600',
		'class' => 'sub',
		'type' => 'range',
			'min' => '200',
			'max' => '2000',
			'step' => '100',
			'suffix' => 'milliseconds'
		);
	
$options[] = array( 
	"name" => "Enable Secondary Slider",
	"id" => "pm_slider_2",
	"type" => "checkbox",
	"std" => false,
	);

	$options[] = array(
		'name' => __('Secondary Slider Post Count', 'powermag'),
		'id' => 'pm_slider_2_count',
		'std' => '4',
		'class' => 'sub',	
		'type' => 'range',
			'min' => '1',
			'max' => '20',
			'step' => '1',
			'suffix' => 'posts'
		);
		
	$options[] = array(
		'name' => __('Excerpt Words Count', 'powermag'),
		'id' => 'pm_slider_2_words',
		'std' => '18',
		'class' => 'sub',	
		'type' => 'range',
			'min' => '0',
			'max' => '100',
			'step' => '1',
			'suffix' => 'words'
			);
		
	$options[] = array(
		'name' => __('Starting Slide', 'powermag'),
		'id' => 'pm_slider_2_start',
		'std' => '0',
		'class' => 'sub',	
		'type' => 'range',
			'min' => '0',
			'max' => '20',
			'step' => '1',
			'suffix' => 'slide'
		);
		
	$options[] = array(
		'name' => __('Animation', 'powermag'),
		'id' => 'pm_slider_2_animation',
		'std' => 'slide',
		'class' => 'sub',
		'type' => 'select',
		'options' => array(
			'slide' => 'Slide',
			'fade' => 'Fade' )
		);
		
	$options[] = array(
		'name' => __('Direction', 'powermag'),
		'id' => 'pm_slider_2_direction',
		'std' => 'vertical',
		'class' => 'sub',
		'type' => 'select',
		'options' => array(
			'vertical' => 'Vertical',
			'horizontal' => 'Horizontal' )
		);
		
	$options[] = array(
		'name' => __('SlideShow Speed', 'powermag'),
		'id' => 'pm_slider_2_slide_speed',
		'std' => '7000',
		'class' => 'sub',
		'type' => 'range',
			'min' => '1000',
			'max' => '9999',
			'step' => '100',
			'suffix' => 'milliseconds'
		);
		
	$options[] = array(
		'name' => __('Animation Speed', 'powermag'),
		'id' => 'pm_slider_2_anim_speed',
		'std' => '600',
		'class' => 'sub',
		'type' => 'range',
			'min' => '200',
			'max' => '2000',
			'step' => '100',
			'suffix' => 'milliseconds'
		);
	
	$options[] = array( 
		"name" => "Enable Home Vertical Carousel",
		"id" => "pm_carousel",
		"type" => "checkbox",
		"std" => true,
		);
	
		$options[] = array( 
			"name" => "Position",
			"id" => "pm_carousel_position",
			"type" => "select",
			"std" => "right",
			"class" => "sub mini",
			"options" => array(
				'left' => 'Left',
				'center' => 'Center',
				'right' => 'Right',
				)
			);
		
	// Socials
		
	$options[] = array(
			'name' => __('Social Media', 'powermag'),
			'type' => 'heading');

	$options[] = array(
			'name' => __('Social Share', 'options_framework_theme'),
			'desc' => __('Select which share buttons to display after a post.', 'powermag'),
			'id' => 'pm_social_share',
			'std' => $social_share_defaults,
			'type' => 'multicheck',
			'options' => $social_share_array);
			
	$options[] = array( 
			/* @since PM 1.5.0 */
			"name" => "Open on a blank page",
			'desc' => __('If enabled, social links are opened on a new window.', 'powermag'),
			"id" => "pm_social_target",
			"type" => "checkbox",
			"std" => false,
		);
			
	$options[] = array( 
			"name" => "Vimeo URL",
			"id" => "pm_sm_vimeo",
			"type" => "text",
			"std" => "");
			
	$options[] = array( 
			"name" => "Google Plus URL",
			"id" => "pm_sm_gplus",
			"type" => "text",
			"std" => "");
/*			
	$options[] = array( 
			"name" => "Technorati URL",
			"id" => "pm_sm_technorati",
			"type" => "text",
			"std" => "");*/
			
	$options[] = array( 
			"name" => "Skype URL",
			"id" => "pm_sm_skype",
			"type" => "text",
			"std" => "");
			
/*	$options[] = array( 
			"name" => "Blogger URL",
			"id" => "pm_sm_blogger",
			"type" => "text",
			"std" => "");*/
			
	$options[] = array( 
			"name" => "FeedBurner URL",
			"id" => "pm_sm_rss",
			"type" => "text",
			"std" => "");
			
	$options[] = array( 
			"name" => "Facebook URL",
			"id" => "pm_sm_facebook",
			"type" => "text",
			"std" => "");
			
	/*$options[] = array( 
			"name" => "Instagram URL",
			"id" => "pm_sm_instagram",
			"type" => "text",
			"std" => "");*/
			
	$options[] = array( 
			"name" => "Twitter URL",
			"id" => "pm_sm_twitter",
			"type" => "text",
			"std" => "Your Twitter URL");
			
	$options[] = array( 
			"name" => "Delicious URL",
			"id" => "pm_sm_delicious",
			"type" => "text",
			"std" => "");
			
	$options[] = array( 
			"name" => "YouTube URL",
			"id" => "pm_sm_youtube",
			"type" => "text",
			"std" => "");
			
	$options[] = array( 
			"name" => "Flickr URL",
			"id" => "pm_sm_flickr",
			"type" => "text",
			"std" => "");
			
	$options[] = array( 
			"name" => "Digg URL",
			"id" => "pm_sm_digg",
			"type" => "text",
			"std" => "");
			
/*	$options[] = array( 
			"name" => "Stumble Upon URL",
			"id" => "pm_sm_stumble",
			"type" => "text",
			"std" => "");*/
			
	$options[] = array( 
			"name" => "Linked In URL",
			"id" => "pm_sm_linkedin",
			"type" => "text",
			"std" => "");
			
	$options[] = array( 
			"name" => "Deviant Art URL",
			"id" => "pm_sm_deviant",
			"type" => "text",
			"std" => "");
			
/*	$options[] = array( 
			"name" => "Picasa URL",
			"id" => "pm_sm_picasa",
			"type" => "text",
			"std" => "");*/
			
	$options[] = array( 
			"name" => "Dribbble URL",
			"id" => "pm_sm_dribbble",
			"type" => "text",
			"std" => "");
			
	$options[] = array( 
			"name" => "Tumblr URL",
			"id" => "pm_sm_tumblr",
			"type" => "text",
			"std" => "");
			
	$options[] = array( 
			"name" => "Forrst URL",
			"id" => "pm_sm_forrst",
			"type" => "text",
			"std" => "");
			

	// Backgrounds

	$options[] = array(
		'name' => __('Backgrounds', 'powermag'),
		'type' => 'heading');
		
	$options[] = array(
		'name' =>  __('Set a Background color or Pattern', 'powermag'),
		'desc' => __('Change the background CSS.', 'powermag'),
		'id' => 'pm_bg',
		'std' => $background_defaults,
		'type' => 'background' );
		
	$options[] = array(
		'name' =>  __('Full Page Background', 'powermag'),
		'desc' => __('Set a full page background', 'powermag'),
		'id' => 'pm_full_bg',
		'type' => 'upload' );
		
		$options[] = array( 
			"name" => __("Make the Background an Ad", "powermag"),
			"desc" => __('Enter an URL to link the background (E.g. for advertising purposes), otherwise leave empty.', 'powermag'),
			"id" => "pm_wall_ad",
			"type" => "text",
			"class" => "sub",
			"std" => "");
			
	$options[] = array(
		'name' => __('Layout Style', 'powermag'),
		'id' => 'pm_boxed',
		'std' => 'free',
		'type' => 'select',
		'options' => array(
			'free' => 'Free Blocks',
			'boxed' => 'Boxed' )
		);
	
		$options[] = array(
			'name' =>  __('Background color or Pattern', 'powermag'),
			'desc' => __('Set a Background color or a Pattern for the inner container', 'powermag'),
			'id' => 'pm_boxed_bg',
			'class' => 'sub hide',
			'std' => $background_defaults,
			'type' => 'background' );
			
		$options[] = array(
			'name' =>  __('Box Shadow', 'powermag'),
			'desc' => __('Enable/Disable the shadow outside the box', 'powermag'),
			'id' => 'pm_boxed_shadow',
			'class' => 'sub hide mini',
			'std' => 'true',
			'type' => 'select',
			'options' => $yesno_array
			);
			
	// Colors

	$options[] = array(
		'name' => __('Colors', 'powermag'),
		'type' => 'heading');
		
	$options[] = array(
		"name" => "GrayScale Effect On Images",
	    "id" => "pm_grayscale",
	    "std" => false,
	    "type" => "checkbox" );

	$options[] = array(
		"name" => "Skin Color",
	    "id" => "pm_color_skin",
	    "std" => "#8cc63f",
	    "type" => "color" );
		
		$options[] = array(
			"name" => "Text Color",
			"id" => "pm_color_skin_text",
			"class" => "sub",
			"std" => "#ffffff",
			"type" => "color" );
		
	$options[] = array(
		"name" => "Primary Color",
	    "id" => "pm_color_primary",
	    "std" => "#282828",
	    "type" => "color" );
		
		$options[] = array(
			"name" => "Links Color",
			"id" => "pm_color_primary_link",
			"class" => "sub",
			"std" => "#e0e0e0",
			"type" => "color" );
			
		$options[] = array(
			"name" => "Links Hover Color",
			"id" => "pm_color_primary_hover",
			"class" => "sub",
			"std" => "#ffffff",
			"type" => "color" );
			
		$options[] = array(
			"name" => "Body Copy Color",
			"id" => "pm_color_primary_body",
			"class" => "sub",
			"std" => "#ffffff",
			"type" => "color" );
		
	$options[] = array(
		"name" => "Secondary Color",
	    "id" => "pm_color_secondary",
	    "std" => "#f2f2f2",
	    "type" => "color" );
		
		$options[] = array(
			"name" => "Links Color",
			"id" => "pm_color_secondary_link",
			"class" => "sub",
			"std" => "#555555",
			"type" => "color" );
			
		$options[] = array(
			"name" => "Links Hover Color",
			"id" => "pm_color_secondary_hover",
			"class" => "sub",
			"std" => "#000000",
			"type" => "color" );
			
		$options[] = array(
			"name" => "Body Copy Color",
			"id" => "pm_color_secondary_body",
			"class" => "sub",
			"std" => "#333333",
			"type" => "color" );
			
	// Typography 
	
	$options[] = array(
		'name' => __('Typography', 'powermag'),
		'type' => 'heading');
		
	$options[] = array( 
		'name' => __('Enable Custom Typography Styles', "powermag"),
		'desc' => __('Enable the use of custom typography for your site. Custom styling will be output in your sites HEAD.', "powermag"),
		'id' => 'pm_enable_styles',
		'type' => 'checkbox',
		'std' => false,
		);
		
	$options[] = array( 
		'name' => __('Headings', 'powermag'),
		'desc' => '',
		'id' => 'pm_headings_font',
		'std' => array('face' => 'PT Serif'),
		'type' => 'typography',
		'options' => array(
			'faces' => $typography_mixed_fonts,
			'styles' => false,
			'color' => false,
			'sizes' => array( '10','11','12','13', '14', '15', '16', '17', '18') )
		);
		
	$options[] = array( 
		'name' => __('Body Font', "powermag"),
		'desc' => __('Select the body font and its base size. Since font sizes are specified with relative values, all other sizes will change accordingly', 'powermag'),
		'type' => 'info',
		);
		
	$options[] = array( 
		'name' => __('Face', "powermag"),
		'id' => 'pm_body_font',
		'std' => array( 'face' => 'PT Sans', 'sizes' => '12'),
		'type' => 'typography',
		'class' => 'sub',
		'options' => array(
			'faces' => $typography_mixed_fonts,
			'sizes' => array( '10','11','12','13', '14', '15', '16', '17', '18'),
			'styles' => false,
			'color' => false )
		);

	$options[] = array(
		'name' => __('Base Size', 'powermag'),
		'id' => 'pm_font_size',
		'std' => '12',
		'class' => 'sub',
			'type' => 'range',
			'min' => '8',
			'max' => '22',
			'step' => '1',
			'suffix' => 'px'
		);

	// Miscellaneous
	
	$options[] = array(
		'name' => __('Miscellaneous', 'powermag'),
		'type' => 'heading');
		
	$options[] = array(
		'name' => __('Top Ad Code', 'powermag'),
		'desc' => __('Insert Advertising Code (E.g Google Adsense Code)', 'powermag'),
		'id' => 'pm_top_ad',
		'std' => '',
		'type' => 'textarea');

		$options[] = array(
			'name' => __('Leaderboard', 'powermag'),
			'desc' => __('Enable this option if the above Advert has a leaderboard format (728x90) to adjust the header accordingly', 'powermag'),
			'id' => 'pm_leaderboard',
			'type' => 'checkbox',
			'class' => 'sub',
			'std' => false,
			);		

	$options[] = array(
		'name' => __('Sticky Navigation', 'powermag'),
		'id' => 'pm_stickynav',
		'desc' => __('Enable/disable sticky navigation upon scrolling'),
		'type' => 'checkbox',
		'std' => false,
		);

	$options[] = array(
		'name' => __('Collapsible Box', 'powermag'),
		'id' => 'pm_collapsible',
		'type' => 'checkbox',
		'std' => true,
		);
		
		$options[] = array(
			'name' => __('Insert Newsletter Box', 'powermag'),
			'id' => 'pm_collapsible_newsletter',
			'type' => 'checkbox',
			'class' => 'sub',
			'std' => true,
			);
			
		$options[] = array(
			'name' => __('Insert Newsletter Box', 'powermag'),
			'id' => 'pm_collapsible_nl_catch',
			'type' => 'textarea',
			'class' => 'sub',
			'std' => __('// Join our awesome newsletter! <small>* You can also place any other content here</small>','powermag'),
			);
			
		$options[] = array(
			'name' => __('MailChimp URL', 'magma'),
			'desc' => __('<strong>Example: </strong>http://yourdomain.us5.list-manage.com/subscribe/post?u=f05988bb168246549b08542d68&id=8acf9edf41', 'magma'),
			'id' => 'pm_collapsible_nl_action',
			'class' => 'sub',
			'std' => '',
			'type' => 'text');
			
		$options[] = array(
			'name' => __('MailChimp Name Code', 'magma'),
			'desc' => __('Enter here the "name" code. <a href="' . get_stylesheet_directory_uri(). '/admin/options-core/images/mailchimp_help.png">Click here for a helpful screenshot</a> (Alt+click to open in an new page)', 'magma'),
			'id' => 'pm_collapsible_nl_name',
			'class' => 'sub',
			'std' => '',
			'type' => 'text');
			
		$options[] = array(
			'name' => __('Insert Custom Content', 'powermag'),
			'id' => 'pm_collapsible_custom',
			'type' => 'checkbox',
			'class' => 'sub',
			'std' => false,
			);
			
		$options[] = array(
			'name' => __('Custom Content', 'powermag'),
			'desc' => __('', 'powermag'),
			'id' => 'pm_toggle_textarea',
			'class' => 'sub',
			'std' => 'Hidden Content Goes Here',
			'type' => 'textarea');
		
	$options[] = array(
		'name' => __('Fade In Content only When is Fully Loaded', 'powermag'),
		'id' => 'pm_fadein',
		'type' => 'checkbox',
		'std' => false,
		);

	$options[] = array(
		'name' => __('Fade In Speed', 'powermag'),
		'id' => 'pm_fadein_speed',
		'std' => '800',
		'class' => 'sub',	
		'type' => 'range',
			'min' => '100',
			'max' => '2000',
			'step' => '100',
			'suffix' => 'ms'
		);
		
	$options[] = array(
		'name' => __('Enable Ajax Comments (no page reload)', 'powermag'),
		'desc' => __('Please be aware this is only appliable to default WP Comments', 'powermag'),
		'id' => 'pm_ajax_comments',
		'type' => 'checkbox',
		'std' => true,
		);
		
	$options[] = array(
		'name' => __('Comments Per Page', 'powermag'),
		'id' => 'pm_ajax_comments_per_page',
		'std' => '800',
		'class' => 'sub',	
		'type' => 'range',
			'min' => '1',
			'max' => '50',
			'step' => '1',
			'suffix' => 'comments'
		);
		
	$options[] = array(
		'name' => __('Enable Jackbox Lightbox', 'powermag'),
		'desc' => __('Disable this if you are using other galleries/lightbox plugins', 'powermag'),
		'id' => 'pm_jackbox',
		'type' => 'checkbox',
		'std' => true,
		);
		
	$options[] = array(
		'name' => __('Link to full size', 'powermag'),
		'desc' => __('Link featured image to full size image', 'powermag'),
		'id' => 'pm_linkfullsize',
		'type' => 'checkbox',
		'std' => true,
		);
		
	$options[] = array(
		'name' => __('Display Meta Details on Archive Pages', 'powermag'),
		'id' => 'pm_archive_entry_meta',
		'desc' => __('Enable/disable tags and categories on archive pages.
', 'powermag'),
		'type' => 'checkbox',
		'std' => false,
		);

	$options[] = array(
		'name' => __('Display Current Date', 'powermag'),
		'id' => 'pm_date',
		'desc' => __('Show/Hide the date block next to the navigation.', 'powermag'),
		'type' => 'checkbox',
		'std' => true,
		);

	// Category Tabs
	
	$options[] = array(
		'name' => __('Home Tabs', 'powermag'),
		'type' => 'heading', 
		"class" => "sub"
);
	$options[] = array( "name" => __('Activate Home Tabs', 'powermag'),
						"id" => "tabs_activate",
						"type" => "checkbox",
						"desc" => __('Enable/Disable Home Tabs', 'powermag'),
						'std' => false,
);

	$options[] = array( "name" => __('Tabs Column', 'powermag'),
						"id" => "tabs_column",
						"type" => "images",
						"desc" => __('Choose on which column display the tabs', 'powermag'),
						"std" => "first",
						"options" => 
						array (
							'first' => $imagepath . 'tab_1col.png',
							'second' => $imagepath . 'tab_2col.png',
						)
);

	$options[] = array( "name" => __('Tabs Position', 'powermag'),
						"id" => "tabs_position",
						"type" => "images",
						"desc" => __('Choose wheather to display the home tabs before or after widgets', 'powermag'),
						"std" => "before",
						"options" => 
						array (
							'before' => $imagepath . 'tab_before.png',
							'after' => $imagepath . 'tab_after.png',
						)
);

$options[] = array( "name" => __('Autoplay', 'powermag'),
						"id" => "tabs_autoplay",
						"type" => "checkbox",
						'std' => false,
						"desc" => __('Enable/Disablea auto Tabs rotation', 'powermag'),
);

$options[] = array( "name" => __('Duration', 'powermag'),
						"id" => "tabs_duration",
						"std" => "4000",
						"step" => "500",
						"min" => "500",
						"max" => "9500",
						"type" => "range",
						"class" => "sub",
						"suffix" => "ms"				
);
	
	$options[] = array( "name" => __('Tab 1', 'powermag'),
						"type" => "info",
);


	$options[] = array( "name" => __('Tab Title', 'powermag'),
						"id" => "tab1_title",
						"type" => "text",
						"desc" => __('Leave it empty if you do not need this tab', 'powermag'),
						"class" => "sub",
						"std" => "",
);

	$options[] = array( "name" => __('Display', 'powermag'),
						"id" => "tab1_display",
						"type" => "select",
						"std" => "latest",
						"class" => "sub",
						"options" => 
						array (
							'latest' => 'Latest Posts',
							'category' => 'Category',
							'tag' 	=> 'Tag'
						)
);


	$options[] = array( "name" => __('Tab 1 Category', 'powermag'),
						"id" => "tab1_category",
						"type" => "select",
						"class" => "hide",
						"options" => $options_categories,
						"class" => "hide sub"
);

	$options[] = array( "name" => __('Tab 1 Tag', 'powermag'),
						"id" => "tab1_tag",
						"type" => "text",
						"class" => "hide sub"
);
						

	$options[] = array( "name" => __('Post Count', 'powermag'),
						"id" => "tab1_posts",
						"std" => "4",
						"step" => "1",
						"min" => "1",
						"max" => "50",
						"type" => "range",
						"class" => "sub",
						"suffix" => "posts"
);

						
	$options[] = array( "name" => __('Tab 2', 'powermag'),
						"type" => "info",
);


	$options[] = array( "name" => __('Tab Title', 'powermag'),
						"id" => "tab2_title",
						"type" => "text",
						"desc" => __('Leave it empty if you do not need this tab', 'powermag'),
						"class" => "sub",
						"std" => "",
);

	$options[] = array( "name" => __('Display', 'powermag'),
						"id" => "tab2_display",
						"type" => "select",
						"std" => "latest",
						"class" => "sub",
						"options" => 
						array (
							'latest' => 'Latest Posts',
							'category' => 'Category',
							'tag' 	=> 'Tag'
						)
);


	$options[] = array( "name" => __('Tab 2 Category', 'powermag'),
						"id" => "tab2_category",
						"type" => "select",
						"class" => "hide",
						"options" => $options_categories,
						"class" => "hide sub"
);

	$options[] = array( "name" => __('Tab 2 Tag', 'powermag'),
						"id" => "tab2_tag",
						"type" => "text",
						"class" => "hide sub"
);
						

	$options[] = array( "name" => __('Post Count', 'powermag'),
						"id" => "tab2_posts",
						"std" => "4",
						"step" => "1",
						"min" => "1",
						"max" => "50",
						"type" => "range",
						"class" => "sub",
						"suffix" => "posts"
);

	$options[] = array( "name" => __('Tab 3', 'powermag'),
						"type" => "info",
);


	$options[] = array( "name" => __('Tab Title', 'powermag'),
						"id" => "tab3_title",
						"type" => "text",
						"desc" => __('Leave it empty if you do not need this tab', 'powermag'),
						"class" => "sub",
						"std" => "",
);

	$options[] = array( "name" => __('Display', 'powermag'),
						"id" => "tab3_display",
						"type" => "select",
						"std" => "latest",
						"class" => "sub",
						"options" => 
						array (
							'latest' => 'Latest Posts',
							'category' => 'Category',
							'tag' 	=> 'Tag'
						)
);


	$options[] = array( "name" => __('Tab 3 Category', 'powermag'),
						"id" => "tab3_category",
						"type" => "select",
						"class" => "hide",
						"options" => $options_categories,
						"class" => "hide sub"
);

	$options[] = array( "name" => __('Tab 3 Tag', 'powermag'),
						"id" => "tab3_tag",
						"type" => "text",
						"class" => "hide sub",
);
						

	$options[] = array( "name" => __('Post Count', 'powermag'),
						"id" => "tab3_posts",
						"std" => "4",
						"step" => "1",
						"min" => "1",
						"max" => "50",
						"type" => "range",
						"class" => "sub",
						"suffix" => "posts"
);

	$options[] = array( "name" => __('Tab 4', 'powermag'),
						"type" => "info",
);


	$options[] = array( "name" => __('Tab Title', 'powermag'),
						"id" => "tab4_title",
						"type" => "text",
						"desc" => __('Leave it empty if you do not need this tab', 'powermag'),
						"class" => "sub",
						"std" => "",
);

	$options[] = array( "name" => __('Display', 'powermag'),
						"id" => "tab4_display",
						"type" => "select",
						"std" => "latest",
						"class" => "sub",
						"options" => 
						array (
							'latest' => 'Latest Posts',
							'category' => 'Category',
							'tag' 	=> 'Tag'
						)
);


	$options[] = array( "name" => __('Tab 4 Category', 'powermag'),
						"id" => "tab4_category",
						"type" => "select",
						"class" => "sub hide",
						"options" => $options_categories
);

	$options[] = array( "name" => __('Tab 4 Tag', 'powermag'),
						"id" => "tab4_tag",
						"type" => "text",
						"class" => "hide sub",
);
						

	$options[] = array( "name" => __('Post Count', 'powermag'),
						"id" => "tab4_posts",
						"std" => "4",
						"step" => "1",
						"min" => "1",
						"max" => "50",
						"type" => "range",
						"class" => "sub",
						"suffix" => "posts"
);

	$options[] = array( "name" => __('Tab 5', 'powermag'),
						"type" => "info",
);


	$options[] = array( "name" => __('Tab Title', 'powermag'),
						"id" => "tab5_title",
						"type" => "text",
						"desc" => __('Leave it empty if you do not need this tab', 'powermag'),
						"class" => "sub",
);

	$options[] = array( "name" => __('Display', 'powermag'),
						"id" => "tab5_display",
						"type" => "select",
						"std" => "latest",
						"class" => "sub",
						"options" => 
						array (
							'latest' => 'Latest Posts',
							'category' => 'Category',
							'tag' 	=> 'Tag'
						)
);


	$options[] = array( "name" => __('Tab 5 Category', 'powermag'),
						"id" => "tab5_category",
						"type" => "select",
						"class" => "hide",
						"options" => $options_categories,
						"class" => "hide sub"
);

	$options[] = array( "name" => __('Tab 5 Tag', 'powermag'),
						"id" => "tab5_tag",
						"type" => "text",
						"class" => "hide sub",);
						

	$options[] = array( "name" => __('Post Count', 'powermag'),
						"id" => "tab5_posts",
						"std" => "4",
						"step" => "1",
						"min" => "1",
						"max" => "50",
						"type" => "range",
						"class" => "sub",
						"suffix" => "posts"
);

	$options[] = array( "name" => __('Tab 6', 'powermag'),
						"type" => "info",
);


	$options[] = array( "name" => __('Tab Title', 'powermag'),
						"id" => "tab6_title",
						"type" => "text",
						"desc" => __('Leave it empty if you do not need this tab', 'powermag'),
						"class" => "sub",
);

	$options[] = array( "name" => __('Display', 'powermag'),
						"id" => "tab6_display",
						"type" => "select",
						"std" => "latest",
						"class" => "sub",
						"options" => 
						array (
							'latest' => 'Latest Posts',
							'category' => 'Category',
							'tag' 	=> 'Tag'
						)
);


	$options[] = array( "name" => __('Tab 6 Category', 'powermag'),
						"id" => "tab6_category",
						"type" => "select",
						"class" => "hide sub",
						"options" => $options_categories
);

	$options[] = array( "name" => __('Tab 6 Tag', 'powermag'),
						"id" => "tab6_tag",
						"type" => "text",
						"class" => "hide",
						"class" => "sub"
);
						

	$options[] = array( "name" => __('Post Count', 'powermag'),
						"id" => "tab6_posts",
						"std" => "4",
						"step" => "1",
						"min" => "1",
						"max" => "50",
						"type" => "range",
						"class" => "sub",
						"suffix" => "posts"
);

	$options[] = array( "name" => __('Tab 7', 'powermag'),
						"type" => "info",
);

	$options[] = array( "name" => __('Tab Title', 'powermag'),
						"id" => "tab7_title",
						"type" => "text",
						"desc" => __('Leave it empty if you do not need this tab', 'powermag'),
						"class" => "sub"
);


	$options[] = array( "name" => __('Display', 'powermag'),
						"id" => "tab7_display",
						"type" => "select",
						"std" => "latest",
						"class" => "sub",
						"options" => 
						array (
							'latest' => 'Latest Posts',
							'category' => 'Category',
							'tag' 	=> 'Tag'
						)
);


	$options[] = array( "name" => __('Tab 7 Category', 'powermag'),
						"id" => "tab7_category",
						"type" => "select",
						"class" => "hide",
						"options" => $options_categories,
						"class" => "hide sub"
);

	$options[] = array( "name" => __('Tab 7 Tag', 'powermag'),
						"id" => "tab7_tag",
						"type" => "text",
						"class" => "hide sub",
);
						

	$options[] = array( "name" => __('Post Count', 'powermag'),
						"id" => "tab7_posts",
						"std" => "4",
						"step" => "1",
						"min" => "1",
						"max" => "50",
						"type" => "range",
						"class" => "sub",
						"suffix" => "posts"
);
						
						
$options[] = array( "name" => __('Tab 8', 'powermag'),
						"type" => "info",
);

	$options[] = array( "name" => __('Tab Title', 'powermag'),
						"id" => "tab8_title",
						"type" => "text",
						"desc" => __('Leave it empty if you do not need this tab', 'powermag'),
						"class" => "sub",
);


	$options[] = array( "name" => __('Display', 'powermag'),
						"id" => "tab8_display",
						"type" => "select",
						"std" => "latest",
						"class" => "sub",
						"options" => 
						array (
							'latest' => 'Latest Posts',
							'category' => 'Category',
							'tag' 	=> 'Tag'
						)
);


	$options[] = array( "name" => __('Tab 8 Category', 'powermag'),
						"id" => "tab8_category",
						"type" => "select",
						"class" => "hide sub",
						"options" => $options_categories
);

	$options[] = array( "name" => __('Tab 8 Tag', 'powermag'),
						"id" => "tab8_tag",
						"type" => "text",
						"class" => "hide sub",
);
						

	$options[] = array( "name" => __('Post Count', 'powermag'),
						"id" => "tab8_posts",
						"std" => "4",
						"step" => "1",
						"min" => "1",
						"max" => "50",
						"type" => "range",
						"class" => "sub",
						"suffix" => "posts"
);

	// Advanced Settings
	
	$options[] = array(
		'name' => __('Advanced', 'powermag'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Minify Stylesheets', 'powermag'),
		'id' => 'pm_minify_css',
		'desc' => __('Enable/disable front-end CSS minifier', 'powermag'),
		'type' => 'checkbox',
		'std' => false,
		);
		
	$options[] = array(
		'name' => __('Minify Javascrips', 'powermag'),
		'id' => 'pm_minify_js',
		'desc' => __('Enable/disable front-end JS minifier', 'powermag'),
		'type' => 'checkbox',
		'std' => false,
		);

	$options[] = array(
		'name' => __("Custom CSS", "powermag"),
		'desc' => __("Add some CSS to your theme by adding it to this block.", "powermag"),
		'id' => 'pm_custom_css',
		'std' => "",
		'type' => 'textarea' );

	$options[] = array(
		'name' => __("Tracking Code", "powermag"),
		'desc' => __("Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.", "powermag"),
		'id' => 'pm_google_analytics',
		'std' => "",
		'type' => 'textarea' );
		
	$options[] = array(
		'name' => __("Custom Javascript", "powermag"),
		'desc' => __("Paste any Javascript you want to load in the Head section.", "powermag"),
		'id' => 'pm_custom_js',
		'std' => "",
		'type' => 'textarea' );

	/**
	 * For $settings options see:
	 * http://codex.wordpress.org/Function_Reference/wp_editor
	 *
	 * 'media_buttons' are not supported as there is no post to attach items to
	 * 'textarea_name' is set by the 'id' you choose
	 */

	$wp_editor_settings = array(
		'wpautop' => true, // Default
		'textarea_rows' => 5,
		'tinymce' => array( 'plugins' => 'wordpress' )
	);
	
	$options[] = array(
		'name' => __('Default Text Editor', 'powermag'),
		'desc' => sprintf( __( 'You can also pass settings to the editor.  Read more about wp_editor in <a href="%1$s" target="_blank">the WordPress codex</a>', 'powermag' ), 'http://codex.wordpress.org/Function_Reference/wp_editor' ),
		'id' => 'example_editor',
		'type' => 'editor',
		'settings' => $wp_editor_settings );
		
	return $options;
}

include_once('options-js.php'); // OF Javascripts