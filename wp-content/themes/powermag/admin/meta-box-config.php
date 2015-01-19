<?php

$prefix = 'pm_';

global $meta_boxes;

$meta_boxes = array();

// 1st meta box
$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box
	'id' => 'review',

	// Meta box title - Will appear at the drag and drop handle bar
	'title' => 'Rating Options',

	// Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
	'pages' => array( 'post'),

	// Where the meta box appear: normal (default), advanced, side; optional
	'context' => 'normal',

	// Order of meta box: high (default), low; optional
	'priority' => 'low',

	// List of meta fields
	'fields' => array(
		array(
			'name'		=> 'Enable Review?',
			'id'		=> $prefix . 'review_enable',
			'clone'		=> false,
			'type'		=> 'checkbox',
			'std'		=> false
		),
		array(
			'name'		=> 'Enable User Ratings?',
			'id'		=> $prefix . 'user_rating_switch',
		    'class' 	=> 'sep',
			'type'		=> 'checkbox',
			'std'		=> false
		),
		
		// CRITERIA ONE
		
		array(
			'name'		=> '<strong>Criteria 1</strong> name:',
			'desc'		=> 'Leave empty not to show',
			'id'		=> "{$prefix}description_c1",
			'type'		=> 'text',
		),
	
		/* Slider 1 */
		array(
			'id'   => "{$prefix}rating_c1",
			'type' => 'slider',
			'class' => "sep",
			'js_options' => array(
				'min'   => 0,
				'max'   => 100,
				'step'  => 1,
			),
		),
		
		
		//CRITERIA TWO
		
		array(
			'name'		=> '<strong>Criteria 2</strong> name:',
			'desc'		=> 'Leave empty not to show',
			'id'		=> "{$prefix}description_c2",
			'type'		=> 'text',
		),
		
		/* Slider 2 */
		array(
			'id'   => "{$prefix}rating_c2",
			'type' => 'slider',
			'class' => "sep",
			'js_options' => array(
				'min'   => 0,
				'max'   => 100,
				'step'  => 1,
			),
		),
		
		//CRITERIA THREE
		
		array(
			'name'		=> '<strong>Criteria 3</strong> name:',
			'desc'		=> 'Leave empty not to show',
			'id'		=> "{$prefix}description_c3",
			'type'		=> 'text',
		),

		/* Slider 3 */
		array(
			'id'   => "{$prefix}rating_c3",
			'type' => 'slider',
			'class' => "sep",
			'js_options' => array(
				'min'   => 0,
				'max'   => 100,
				'step'  => 1,
			),
		),
		
		//CRITERIA FOUR
		
		array(
			'name'		=> '<strong>Criteria 4</strong> name:',
			'desc'		=> 'Leave empty not to show',
			'id'		=> "{$prefix}description_c4",
			'type'		=> 'text',
		),

		/* Slider 4 */
		array(
			'id'   => "{$prefix}rating_c4",
			'type' => 'slider',
			'class' => "sep",
			'js_options' => array(
				'min'   => 0,
				'max'   => 100,
				'step'  => 1,
			),
		),
		
		//CRITERIA FIVE
		
		array(
			'name'		=> '<strong>Criteria 5</strong> name:',
			'desc'		=> 'Leave empty not to show',
			'id'		=> "{$prefix}description_c5",
			'type'		=> 'text',
		),
		
		/* Slider 5 */
		array(
			'id'   => "{$prefix}rating_c5",
			'type' => 'slider',
			'class' => "sep",
			'js_options' => array(
				'min'   => 0,
				'max'   => 100,
				'step'  => 1,
			),
		),
		
		//CRITERIA SIX
		
		array(
			'name'		=> '<strong>Criteria 6</strong> name:',
			'desc'		=> 'Leave empty not to show',
			'id'		=> "{$prefix}description_c6",
			'type'		=> 'text',
		),
		
		/* Slider 6 */
		array(
			'id'   => "{$prefix}rating_c6",
			'type' => 'slider',
			'class' => "sep",
			'js_options' => array(
				'min'   => 0,
				'max'   => 100,
				'step'  => 1,
			),
		),
		
		array(
			'name' => '<strong>Average</strong>',
			'id'   => "{$prefix}overall_score",
			'class' => "average-value",
			'type' => 'text',
		),
		
		//RATING TYPE
			
		array(
			'name'		=> '<strong>Rating Type</strong>',
			'id'		=> "{$prefix}review_type",
			'class'		=> "sep",
			'type'		=> 'select',
			'options'	=> array(
				'stars'	  => 'Stars',
				'percent' => 'Percentage'
			),
			'std'		=> 'stars',
			
		),
		
		
		//ADDITIONAL INFO
		
		array(
			'name'		=> 'Criteria Header',
			'desc'		=> "Disabled if empty",
			'id'		=> "{$prefix}review_header",
			'type'		=> 'text',
		),
		array(
			'name'		=> 'Rating Tag',
			'desc'		=> "One or two words",
			'id'		=> "{$prefix}tagline",
			'type'		=> 'text',
		),
		array(
			'name'		=> 'Longer Summary',
			'id'		=> "{$prefix}summary",
			'type'		=> 'textarea',
			'class'		=> "sep",
			'cols'		=> "50",
			'rows'		=> "5"
		),
		
		array(
			'name'		=> 'Affiliate Link',
			'desc'		=> "Enter an affiliate link - Disabled if empty",
			'id'		=> "{$prefix}affiliate",
			'type'		=> 'text',
		),
		
		array(
			'name'		=> 'Affiliate Catch Phrase',
			'desc'		=> "Some catching words here",
			'id'		=> "{$prefix}affiliate_catch",
			'type'		=> 'text',
		),
		
		array(
			'name'		=> 'Affiliate Button Text',
			'desc'		=> "One or two words to display inside the button (e.g.'Buy now')",
			'id'		=> "{$prefix}affiliate_btn",
			'type'		=> 'text',
		),
		
		array(
			'name'		=> 'Cart Icon on Button',
			'desc'		=> "Insert a cart icon inside the button",
			'id'		=> "{$prefix}affiliate_btn_icon",
			'type'		=> 'checkbox',
			'class'		=> "sep",
		),
		
		//RATING BOX POSITION
		array(
			'name'		=> 'Position',
			'id'		=> "{$prefix}box_position",
			'type'		=> 'select',
			'options'	=> array(
				'top'			=> 'Top (Full Width, right under the featured media)',
				'floated'		=> 'Floated (Half Width, after the title)',
				'bottom'		=> 'Bottom (at the end of the post, with regular padding)'
			),
			'std'		=> 'bottom',
			'desc'		=> 'Select where the review box should appear in the page'
		)
		
	)
);


// Tools Metabox
$meta_boxes[] = array(
	'id'		=> 'post_extension',
	'title'		=> 'Single Post Options',
	'pages'		=> array( 'post', 'page' ),

	'fields'	=> array(
	
		array(
			'name'		=> 'Feature this Post on <strong>Primary Slider?</strong>',
			'id'		=> $prefix . 'featured_post_1',
			'clone'		=> false,
			'type'		=> 'checkbox',
			'std'		=> false
		),
		
		array(
			'name'		=> 'Feature this Post on <strong>Secondary Slider?</strong>',
			'id'		=> $prefix . 'featured_post_2',
			'clone'		=> false,
			'class'		=> 'sep',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		array(
			'name'		=> 'Video Embed Code',
			'id'		=> $prefix . 'video_encode',
			'clone'		=> false,
			'type'		=> 'textarea',
			'class'		=> 'sep',
			'desc'		=> 'Paste in the iframe in here',
			'std'		=> false
		),				
		array(
			'name'		=> 'Comment Type',
			'id'		=> "{$prefix}comment_type",
			'class'		=> "",
			'type'		=> 'radio',
			'options'	=> array(
				'fb'	=> 'Facebook Comments',
				'wp'	=> 'WP Comments',
				'none'  => 'None'
			),
			'std'		=> 'wp',
			'desc'		=> ''
		)
	)
);


// Pages Only Options
$meta_boxes[] = array(
	'id'		=> 'page_extension',
	'title'		=> 'Page Color',
	'pages'		=> array( 'page' ),

	'fields'	=> array(
		
		array(
			'name'	=> 'Skin Color',
			'desc'	=> '',
			'id'	=> "{$prefix}page_color",
			'type'	=> 'color'
		)
	)
);


// Full Width Option
$meta_boxes[] = array(
	'id'		=> 'full_width',
	'title'		=> 'Full Width Layout',
	'pages'		=> array( 'page', 'post' ),
	'priority'  => 'low',
	'fields'	=> array(

		array(
			'name'	=> 'Disable Sidebar',
			'id'	=> $prefix . 'full_width_switch',
			'type'	=> 'checkbox',
			'std'	=> false,
		),
	)
);


// Full Width Option
$meta_boxes[] = array(
	'id'		=> 'full_width',
	'title'		=> 'Full Width Layout',
	'pages'		=> array( 'page', 'post' ),
	'priority'  => 'low',
	'fields'	=> array(

		array(
			'name'	=> 'Disable Sidebar',
			'id'	=> $prefix . 'full_width_switch',
			'type'	=> 'checkbox',
			'std'	=> false,
		),
	)
);


// Small Featured Image Option
$meta_boxes[] = array(
	'id'		=> 'small_featured',
	'title'		=> 'Small Featured Image',
	'pages'		=> array( 'page', 'post' ),
	'priority'  => 'low',
	'context' => 'side',
	'fields'	=> array(

		array(
			'name'	=> '',
			'id'	=> $prefix . 'small_featured_switch',
			'type'	=> 'checkbox',
			'std'	=> false,
			'desc'	=> 'Check this option if you wish to use a smaller in-content featured image/video. <br><br> <strong>Note:</strong> to wrap text around the image, enter it through the default text editor and <strong>not</strong> through the Visual Composer ',
		),
	)
);

// Hide Featured Image in Single Post Page @since PM 1.5.0

$meta_boxes[] = array(
	'id'		=> 'hide_featured',
	'title'		=> 'Hide Featured Image',
	'pages'		=> array( 'page', 'post' ),
	'priority'  => 'low',
	'context' => 'side',
	'fields'	=> array(

		array(
			'name'	=> '',
			'id'	=> $prefix . 'hide_featured_switch',
			'type'	=> 'checkbox',
			'std'	=> false,
			'desc'	=> 'Hide featured image in single post page',
		),
	)
);

/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function pm_register_meta_boxes()
{
	global $meta_boxes;

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $meta_boxes as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded
//  before (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'pm_register_meta_boxes' );