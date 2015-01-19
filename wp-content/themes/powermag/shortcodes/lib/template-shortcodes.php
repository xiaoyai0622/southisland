<?php
/*
==========================================================
Default Settings for Shortcodes
==========================================================
*/
//Add our custom action that all PowerMag shortcodes will use
add_action( 'init', 'powermag_register_shortcodes');
//Enable shortcodes in widgets
add_filter('widget_text', 'do_shortcode');

function powermag_register_shortcodes() {
	
	/*
	==========================================================
	Button Group
	==========================================================
	*/
	function powermag_shortcode_button_group( $atts, $content ) {
	
		$output = '<div class="btn-group">';
		$output .= do_shortcode( $content );
		$output .= '</div>';	
		return $output;}
	
	add_shortcode('button_group', 'powermag_shortcode_button_group');
	
	/*
	==========================================================
	Buttons
	==========================================================
	*/
	function powermag_shortcode_buttons( $atts, $content = null ) {
		extract( shortcode_atts( array(
		'type' => 'default', /* primary, default, info, success, danger, warning, inverse */
		'size' => 'medium', /* small, medium, large */
		'url'  => '',
		'text' => '',
		'icon' => 'default',
		'iconcolor' => 'white',
		'target' => '_self',
		), $atts ) );
		
		if($type == "default"){
			$type = "";
		}
		else{ 
			$type = "btn-" . $type;
		}
		
		if($size == "medium"){
			$size = "";
		}
		else{
			$size = "btn-" . $size;
		}
		
		if($icon == 'default'){
			$icon = '';
		}
		else{
			$icon = '<i class="icon-'. $icon . ' icon-'. $iconcolor . '"></i> ';
		}
		
		$output = '<a href="' . $url . '" target="' . $target . '" class="btn '. $type . ' ' . $size . '">';
		$output .= $icon;
		$output .= $text;
		$output .= '</a>';
		
		return $output;
	}
	
	add_shortcode('button', 'powermag_shortcode_buttons'); 
	
	/*
	==========================================================
	Labels
	==========================================================
	*/
	function powermag_shortcode_labels( $atts, $content = null ) {
		extract( shortcode_atts( array(
		'type' => 'default', /* primary, default, info, success, danger, warning, inverse */
		'text' => '',
		), $atts ) );
		
		if($type == "default"){
			$type = "";
		}
		else{ 
			$type = "label-" . $type;
		}
		
		$output = '<span class="label ' . $type . '">';
		$output .= $text;
		$output .= '</span>';
		
		return $output;
	}
	
	add_shortcode('label', 'powermag_shortcode_labels');
	
	/*
	==========================================================
	Badges
	==========================================================
	*/
	function powermag_shortcode_badges( $atts, $content = null ) {
		extract( shortcode_atts( array(
		'type' => 'default', /* primary, default, info, success, danger, warning, inverse */
		'text' => '',
		), $atts ) );
		
		if($type == "default"){
			$type = "";
		}
		else{ 
			$type = "label-" . $type;
		}
		
		$output = '<span class="badge ' . $type . '">';
		$output .= $text;
		$output .= '</span>';
		
		return $output;
	}
	
	add_shortcode('badge', 'powermag_shortcode_badges'); 
	
	/*
	==========================================================
	Code
	==========================================================
	*/
	function powermag_shortcode_code( $atts, $content ) {
		extract( shortcode_atts( array(
		'scroll' => 'false',
		), $atts ) );
		
		if($scroll == "false"){
			$scroll = "";
		}
		else{ 
			$scroll = "pre-scrollable";
		}
		
		$output = '<pre class="'. $scroll . ' prettyprint">'. do_shortcode( $content ) . '</pre>';
		
		return $output;
	}
	
	add_shortcode('code', 'powermag_shortcode_code');
	
	/*
	==========================================================
	Row
	==========================================================
	*/
	function powermag_shortcode_row( $atts, $content ) {
	
		$output = '<div class="row-fluid">';
		$output .= do_shortcode( $content );
		$output .= '</div>';	
		return $output;}
	
	add_shortcode('row', 'powermag_shortcode_row');
	
	/*
	==========================================================
	Columns
	==========================================================
	*/
	function powermag_shortcode_columns( $atts, $content ) {
		extract( shortcode_atts( array(
		'span' => '12',
		), $atts ) );
		
		$output = '<div class="span'.$span.'">';
		$output .= do_shortcode( $content );
		$output .= '</div>';	
		return $output;}
	
	add_shortcode('column', 'powermag_shortcode_columns');
	
	/*
	==========================================================
	Lead
	==========================================================
	*/
	
	function powermag_shortcode_lead( $atts, $content ) {
		extract( shortcode_atts( array(
		'align' => '', /* primary, default, info, success, danger, warning, inverse */
		), $atts ) );
	
		if($align == "default"){
			$align = "";
		}
		else{
		$align = 'style="text-align:'. $align . ';"';
		}
	
		$output = '<p class="lead" '.$align.'>';
		$output .= do_shortcode( $content );
		$output .= '</p>';	
		return $output;}
	
	add_shortcode('lead', 'powermag_shortcode_lead');
	
	/*
	==========================================================
	Page Header
	==========================================================
	*/
	function powermag_shortcode_header( $atts, $content = null ) {
		extract( shortcode_atts( array(
		'text' => '', /* primary, default, info, success, danger, warning, inverse */
		'subtext' => '', /* primary, default, info, success, danger, warning, inverse */
		), $atts ) );
		
		if($subtext == "default"){
			$subtext = "";
		}
		else{
		$subtext = ' <small>'. $subtext . '</small>';
		}
		
		$output = '<div class="page-header"><h1>'.$text.'';
		$output .=$subtext;
		$output .= '</h1></div>';
		
		return $output;
	}
	
	add_shortcode('header', 'powermag_shortcode_header');
	
	/*
	==========================================================
	Divider
	==========================================================
	*/
	function powermag_shortcode_divider( $atts, $content = null ) {
	
		$output = '<div class="wpb_separator wpb_content_element" style="margin-top:40px"></div>' /* melting with page builder outputs */;
		return $output;}
	
	add_shortcode('divider', 'powermag_shortcode_divider');
	
	/*
	==========================================================
	Jumbotron
	==========================================================
	*/
	function powermag_shortcode_jumbotron( $atts, $content ) {
		extract( shortcode_atts( array(
		'background' => '', /* alert-info, alert-success, alert-error */ 
		'color' => '', 
	
		), $atts ) );
	
		$output = '<header style="background:'.$background.';color:'.$color.';" class="hero-unit jumbotron masthead">';
		$output .= do_shortcode( $content );
		$output .= '</header>';	
		return $output;}
	
	add_shortcode('jumbotron', 'powermag_shortcode_jumbotron');
	
	/*
	==========================================================
	Alerts
	==========================================================
	*/
	function powermag_shortcode_alerts( $atts, $content = null ) {
		extract( shortcode_atts( array(
		'type' => 'alert-info', /* alert-info, alert-success, alert-error */
		'block' => 'false',
		'close' => 'false', /* display close link */
		'heading' => '',
		'text' => '', 
		), $atts ) );
		if($block == 'true') {$alertblock = 'alert-block';}
		$output = '<div class="fade in alert '. $type . ' '. $block . '">';
		if($close == 'true') {
			$output .= '<a class="close" data-dismiss="alert"><i style="font-size:14px;" class="icon-remove"></i></a>';
		}
		if($heading <> '') {
			$output .= '<h4 class="alert-heading">'.$heading.'</h4>';
		}
		$output .= do_shortcode( $content );
		$output .= '</div>';
		
		return $output;
	}
	
	add_shortcode('alert', 'powermag_shortcode_alerts');
	
	
	/*
	==========================================================
	Blockquotes
	==========================================================
	*/
	function powermag_shortcode_blockquotes( $atts, $content = null ) {
		extract( shortcode_atts( array(
		'float' => '', /* left, right */
		'cite' => '', /* text for cite */
		'align' => '', /* left, right */
		), $atts ) );
		
		$output = '<blockquote class="';
		if($float == 'left') {
			$output .= 'pull-left ';
		}
		elseif($float == 'right'){
			$output .= 'pull-right ';
		}
		if($align == 'left') {
			$output .= 'text-align-left';
		}
		elseif($align == 'right'){
			$output .= 'text-align-right';
		}
		$output .= '"><p>' . $content . '</p>';
		
		if($cite){
			$output .= '<small>' . $cite . '</small>';
		}
		
		$output .= '</blockquote>';
		
		return $output;
	}
	
	add_shortcode('blockquote', 'powermag_shortcode_blockquotes'); 
	
	/*
	==========================================================
	Tooltip
	==========================================================
	*/
	function powermag_shortcode_tooltip( $atts, $content = null) {
		extract( shortcode_atts( array(
		'text' => '',
		'link' => '',
		'title' => '',
		'button' => '',
		'size' => '',
		'type' => '',
		'target' => '_self',
		'icon' => 'none',
		'iconcolor' => 'white',
		), $atts ) );
	
		if($button == 'true') {
			$button = 'btn';
			$size = 'btn-'.$size;
			$type = 'btn-'.$type;
		} else {
			$button = '';
			$size = '';
			$type = '';
		}
	
		if($icon == "none"){
			$icon = "";
		}
		else{
			$icon = '<i class="icon-'. $icon . ' icon-'. $iconcolor . '"></i> ';
		}
	
		$output = '<a target="'.$target.'" class="'.$button.' '.$size.' '.$type.'" rel="tooltip" href="'.$link.'" title="'.$title.'">';
		$output .= $icon;
		$output .= $text;
		$output .= '</a>';
		return $output;}
	
	add_shortcode('tooltip', 'powermag_shortcode_tooltip');
	
	function powermag_shortcode_popover( $atts, $content = null) {
		extract( shortcode_atts( array(
		'text' => '',
		'link' => '',
		'title' => '',
		'desc' =>'',
		'button' => '',
		'size' => '',
		'type' => '',
		'target' => '_self',
		), $atts ) );
	
		if($button == 'true') {
			$button = 'btn';
			$size = 'btn-'.$size;
			$type = 'btn-'.$type;
		} else {
			$button = '';
			$size = '';
			$type = '';
		}
		
		$output = '<a target="'.$target.'" class="'.$button.' '.$size.' '.$type.'" rel="popover" href="'.$link.'" data-content="'.$desc.'" data-original-title="'.$title.'">';
		$output .= $text;
		$output .= '</a>';	
		return $output;}
	
	add_shortcode('popover', 'powermag_shortcode_popover');
	
	/*
	==========================================================
	Progress Bar
	==========================================================
	*/
	function powermag_shortcode_progress_bar( $atts, $content = null ) {
		extract( shortcode_atts( array(
		'animate' => 'off',
		'type' => 'default',
		'striped' => 'off',
		'width' =>'20',
		), $atts ) );
		
		if($animate == "on"){
			$animate = "active";
		}
		else{
		$animate = '';
		}
		if($striped == "on"){
			$striped = "progress-striped";
		}
		else{
		$striped = '';
		}
		if($type == "default"){
			$type = "";
		}
		else{
		$type = 'progress-'.$type.'';
		}
	
		
		$output = '<div class="progress '.$type.' '.$striped.' '.$animate.'"><div class="bar" style="width:'.$width.'%;"></div></div>';
		return $output;}
	
	add_shortcode('progress', 'powermag_shortcode_progress_bar');
	
	/*
	==========================================================
	Carousel
	==========================================================
	*/
	function powermag_shortcode_carousel_gallery( $atts, $content = null ) {
		extract( shortcode_atts( array(
		'include' => '',
		'exclude' => '',
		), $atts ) );
		
		$output = '<div id="myCarousel" class="carousel slide"><div class="carousel-inner">';
	
		global $post;
		$id = $post->ID;
	    if ( !empty($include) ) {
	        $include = preg_replace( '/[^0-9,]+/', '', $include );
	        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'title') );
	
	        $attachments = array();
	        foreach ( $_attachments as $key => $val ) {
	            $attachments[$val->ID] = $_attachments[$key];
	        }
	    } elseif ( !empty($exclude) ) {
	        $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
	        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'title') );
	    } else {
	        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'title') );
	    }		
	
		foreach ( $attachments as $id => $attachment ) {
	        $link = wp_get_attachment_url( $id );
	
			$output .='<div class="item';
			if ($attachment === reset($attachments)) {$output .=' active';}
			$output .='"><a href="'.wp_get_attachment_url( $attachment->ID ).'" rel="lightbox[carousel]">';
			$output .='<img src="'.wp_get_attachment_url( $attachment->ID ).'" alt="">';
			$output .='<div class="carousel-caption"><h4>'.$attachment->post_title.'</h4><p>'.$attachment->post_excerpt.'</p></div></a>';
			$output .='</div>';
		}
		
		$output .= '</div><a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a><a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a></div>';
		
		return $output;
	}
	
	add_shortcode('carousel_gallery', 'powermag_shortcode_carousel_gallery');
	
	/*
	==========================================================
	Menu
	==========================================================
	*/
	function powermag_shortcode_menu( $atts, $content = null ) {
		extract( shortcode_atts( array(
		'style' => 'pills',
		'stacked' => 'false',
		'name' => ''
		), $atts ) );
		
		if($stacked == "true"){
			$stacked = "nav-stacked";
		}
		else{
		$stacked = '';
		}
		
		$class = 'nav nav-'.$style.' '.$stacked;
		
		$output = wp_nav_menu( array('depth' => '1', 'fallback_cb' => '', 'menu' => $name, 'menu_class' => $class) );
		
		return $output;
	}
	
	add_shortcode('menu', 'powermag_shortcode_menu');
	
	/*
	==========================================================
	Accordion
	==========================================================
	*/
	function powermag_shortcode_accordion( $atts, $content ) {
		extract( shortcode_atts( array(
		'title' => '', /* alert-info, alert-success, alert-error */
		'id' => '', /* alert-info, alert-success, alert-error */ 
		), $atts ) );
	
		$output = '<div class="accordion-group"><div class="accordion-heading"><a class="accordion-toggle" data-toggle="collapse" data-parent="#'.$id.'" href="#'.$id.'">'.$title.'</a></div>';
		$output .= '<div id="'.$id.'" class="accordion-body collapse"><div class="accordion-inner">';
		$output .= do_shortcode( $content );
		$output .= '</div></div></div>';
		return $output;}
	
	add_shortcode('accordion', 'powermag_shortcode_accordion');
	
	/*
	==========================================================
	Accordion Group
	==========================================================
	*/
	function powermag_shortcode_accordion_group( $atts, $content ) {
	
		$output = '<div class="accordion">';
		$output .= do_shortcode( $content );
		$output .= '</div>';	
		return $output;}
	
	add_shortcode('accordion_group', 'powermag_shortcode_accordion_group');
	
	/*
	==========================================================
	Icon
	==========================================================
	*/
	function powermag_shortcode_icon( $atts, $content = null ) {
		extract( shortcode_atts( array(
		'type' => 'glass', /* primary, default, info, success, danger, warning, inverse */
		'size' => '', /* small, medium, large */
		'color'  => '',
		'float'  => 'none',
		), $atts ) );
		
		if($size == "default"){
			$size = "";
		}
		else{ 
			$size = "font-size:" . $size."px;";
		}
		
		if($color == "default"){
			$color = "";
		}
		else{ 
			$color = "color:" . $color.";";
		}

		if($float == "none"){
			$float = "";
		}
		elseif($float == "left"){ 
			$float = "float:" . $float.";margin-right:8px";
		}
		else{ 
			$float = "float:" . $float.";margin-left:8px";
		}
		
		$output = '<i class="icon-'. $type . '" style="'.$color.' '.$size.' '.$float.'"></i> ';
		
		return $output;
	}
	
	add_shortcode('icon', 'powermag_shortcode_icon');
} /* End powermag_register_shortcodes function */