<?php
/*
==========================================================
RECENT POSTS
==========================================================
*/

class recent_posts_custom extends WP_Widget {
	function recent_posts_custom() {
		$widget_ops = array('classname' => 'custom-widget', 'description' => 'The recent posts with thumbnails' );
		$this->WP_Widget('recent_posst_custom', 'PowerMag - Recent Posts', $widget_ops);
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		echo $before_widget;
		$items = empty($instance['items']) ? ' ' : apply_filters('widget_title', $instance['items']);
		if(!is_numeric($items))
		{
			$items = 3;
		}
		if(!empty($items))
		{
			pm_posts('recent', $items, TRUE);
		}
		echo $after_widget;
	}
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['items'] = strip_tags($new_instance['items']);

		return $instance;
	}
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'items' => '') );
		$items = strip_tags($instance['items']);
?>

<p>
	<label for="<?php echo $this->get_field_id('items'); ?>">Items (default 3):
		<input class="widefat" id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>" type="text" value="<?php echo esc_attr($items); ?>" />
	</label>
</p>
<?php
	}
}

register_widget('recent_posts_custom');


/*
==========================================================
POPULAR POSTS
==========================================================
*/

class popular_posts_custom extends WP_Widget {
	function popular_posts_custom() {
		$widget_ops = array('classname' => 'custom-widget', 'description' => 'Popular posts with thumbnails' );
		$this->WP_Widget('popular_posts_custom', 'PowerMag - Popular Posts', $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		echo $before_widget;
		$items = empty($instance['items']) ? ' ' : apply_filters('widget_title', $instance['items']);
		if(!is_numeric($items))
		{
			$items = 3;
		}
		if(!empty($items))
		{
			pm_posts('popular', $items, TRUE);
		}
		echo $after_widget;
	}
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['items'] = strip_tags($new_instance['items']);

		return $instance;
	}
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'items' => '') );
		$items = strip_tags($instance['items']);
?>
<p>
	<label for="<?php echo $this->get_field_id('items'); ?>">Items (default 3):
		<input class="widefat" id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>" type="text" value="<?php echo esc_attr($items); ?>" />
	</label>
</p>
<?php
	}
}

register_widget('popular_posts_custom');


/*
==========================================================
RECENT AND POPULAR POSTS SETUP
==========================================================
*/

function pm_posts($sort = 'recent', $items = 3, $echo = TRUE, $bg_color = 'black') 
{
	$return_html = '';
	
	if($sort == 'recent')
	{
		$posts = get_posts('numberposts='.$items.'&order=DESC&orderby=date&post_type=post&post_status=publish');
		$title = __('Recent Posts', 'powermag');
	}
	else
	{
		global $wpdb;
		
		$query = "SELECT ID, post_title, post_content FROM {$wpdb->prefix}posts WHERE post_type = 'post' AND post_status= 'publish' ORDER BY comment_count DESC LIMIT 0,".$items;
		$posts = $wpdb->get_results($query);
		$title = __('Popular Posts', 'powermag'); 
	}
	
	if(!empty($posts))
	{

		$return_html.= '<div class="widget-title-bg clearfix"><h4 class="widget-title"><span class="inner">'.$title.'</span><span class="cat-diagonal"></span></h4></div>';
		$return_html.= '<ul class="custom-widget post-widget">';
		
		$count_post = count($posts);
		

			foreach($posts as $post)
			{
				$image_thumb = get_post_meta($post->ID, 'img_url', true);
				$return_html.= '<li class="clearfix">';
							
				$pm_video = get_post_meta($post->ID, 'pm_video_encode', true);
				$pm_has_video = $pm_video != "";
				
				$pm_overall_score = get_post_meta($post->ID, 'pm_overall_score', true);
				$pm_review_enable = get_post_meta($post->ID, 'pm_review_enable', true);
				$pm_review_type = get_post_meta($post->ID, 'pm_review_type', true);
				
				if (has_post_thumbnail($post->ID))
				{
					$image_id = get_post_thumbnail_id($post->ID);
					$image_url = wp_get_attachment_image_src($image_id, 'mini-thumbs', true);
					
					$return_html.= '
					<span class="img-frame">
						<a href="'.get_permalink($post->ID).'">
							<img src="'.$image_url[0].'" width="95" height="53" alt="'. $post->post_title .'" /></a>';
						
						if ($pm_has_video) { $return_html.= '
							<a href="'.get_permalink($post->ID).'"><span class="pm-icon"><i class="icon-play"></i></span></a>'; }
				
					$return_html.= '
					</span>';
					
				} else { 
					$return_html.= ' <a href="'.get_permalink($post->ID).'"><span class="img-frame no-thumb"><span class="no-thumb-img">';
					
						if ($pm_has_video) {$return_html.= '<a href="'.get_permalink($post->ID).'"><span class="pm-icon"><i class="icon-play"></i></span></a>';}
					
					$return_html.= '</span></span></a>';
				}
				
					$return_html.= '
					<a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a>
					
					<div class="clear"></div>
					
					<div class="info-stripe clearfix">
						<span class="cat-stripe pull-left">';
						
					$cat = get_the_category($post->ID);
	
					$return_html.= '
							<a href="'. get_category_link( $cat[0]->term_id ) . '" title=" ' . $cat[0]->name . '">
								'. $cat[0]->cat_name .'
							</a>';	
							
					$return_html.= '
						</span>
					
					<span class="post-attribute pull-left">' . get_the_time('F j, Y', $post->ID) .' </span>
					
					<a href="' . get_permalink($post->ID) .'" title="' . $post->post_title . '"><i class="icon-chevron-right pull-right"></i></a>
					';
					
				
				if ( $pm_review_enable AND $pm_review_type == 'stars') {
					
					$return_html.= '
					<div class="rw-criteria stars-preview stars-small pull-right">
						<span class="criteria-stars-color">
							<span class="criteria-stars-overlay" style="width:' . $pm_overall_score . '%"></span>
						</span>
					</div>
				';
				}
				
				if ( $pm_review_enable AND $pm_review_type == 'percent') {
					
					$return_html.= '
					<span class="percent-stripe">' . $pm_overall_score . '</span>
				';
				}
				
			$return_html.= '</div><!--info-stripe-->
		</li><!--end post li item-->';
				
			}
		
		$return_html.= '</ul>';

	}
	
	if($echo)
	{
		echo $return_html;
	}
	else
	{
		return $return_html;
	}
}


/*
==========================================================
FACEBOOK FANS
==========================================================
*/

class facebook_page_custom extends WP_Widget {
	function facebook_page_custom() {
		$widget_ops = array('classname' => 'facebook_page_custom', 'description' => 'Official Facebook Like Box' );
		$this->WP_Widget('facebook_page_custom', 'PowerMag - Facebook Page', $widget_ops);
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$fb_page_url = $instance['fb_page_url'];
		
		if(!empty($fb_page_url))
		{
			if(isset($_SESSION['pm_menu_style']))
			{
				$pm_menu_style = $_SESSION['pm_menu_style'];
			}
			else
			{
				$pm_menu_style = of_get_option('alt_stylesheet');
			}
			
			$fb_skin = 'light';
			$fb_border = 'ffffff';
			if($pm_menu_style != 3 && $pm_menu_style != 6)
			{
				$fb_skin = 'light';
				$fb_border = 'ffffff';
			}
			else
			{
				$fb_skin = 'dark';
				$fb_border = '191919';
			}
?>
<div class="widget-title-bg clearfix">
	<h4 class="widget-title">
		<span class="inner"><?php _e('Facebook', 'powermag') ?></span>
		<span class="cat-diagonal"></span>
	</h4>
</div>

<div class="widget-wrapper">
	<iframe seamless src="//www.facebook.com/plugins/likebox.php?href=<?php echo urlencode($fb_page_url); ?>&amp;width=280&amp;height=258&amp;colorscheme=<?php echo $fb_skin; ?>&amp;show_faces=true&amp;border_color=%23<?php echo $fb_border; ?>&amp;stream=false&amp;header=false&amp;appId=268239076529520" style="background: #f2f2f2; overflow:hidden; height: 258px; width:100%%; border-bottom: 2px solid rgba(0,0,0,0.1);"></iframe>
</div>
<?php
		}
		
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['fb_page_url'] = strip_tags($new_instance['fb_page_url']);

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'fb_page_url' => '') );
		$fb_page_url = strip_tags($instance['fb_page_url']);

?>
<p>
	<label for="<?php echo $this->get_field_id('fb_page_url'); ?>">Facebook Page URL:
		<input class="widefat" id="<?php echo $this->get_field_id('fb_page_url'); ?>" name="<?php echo $this->get_field_name('fb_page_url'); ?>" type="text" value="<?php echo esc_attr($fb_page_url); ?>" />
	</label>
</p>
<?php
	}
}

register_widget('facebook_page_custom');

/*
==========================================================
FLICKR STREAM
==========================================================
*/

	class flickr_custom extends WP_Widget {
	function flickr_custom() {
		$widget_ops = array('classname' => 'flickr_stream', 'description' => 'Flickr Widget' );
		$this->WP_Widget('flickr_stream', 'PowerMag - Flickr', $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
        $user = empty($instance['user']) ? ' ' : apply_filters('widget_user', $instance['user']);
        $counter = empty($instance['counter']) ? ' ' : apply_filters('widget_counter', $instance['counter']);
		echo $before_title;
        echo $title;
		echo $after_title;
        echo '
			<div class="flickr clearfix">
			<script src="http://www.flickr.com/badge_code_v2.gne?show_name=1&amp;count='.$counter.'&amp;display=latest&amp;size=s&amp;layout=v&amp;source=user&amp;user='.$user.'" type="text/javascript">
			</script>
			</div>
			';
        echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
        $instance['user'] = strip_tags($new_instance['user']);
        $instance['counter'] = strip_tags($new_instance['counter']);
		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'user' => '', 'counter' => '' ) );
		$title = strip_tags($instance['title']);
        $user = strip_tags($instance['user']);
        $counter = strip_tags($instance['counter']);
?>
<p>
	<label for="<?php echo $this->get_field_id('title'); ?>">Title:
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
	</label>
</p>
<p>
	<label for="<?php echo $this->get_field_id('user'); ?>">Flickr User ID: <a href="http://idgettr.com/" target="_blank">Find it here</a>
		<input class="widefat" id="<?php echo $this->get_field_id('user'); ?>" name="<?php echo $this->get_field_name('user'); ?>" type="text" value="<?php echo $instance['user']; ?>" />
	</label>
</p>
<p>
	<label for="<?php echo $this->get_field_id('counter'); ?>">Counter: <br /> <small>Max. 10</small>
		<input class="widefat" id="<?php echo $this->get_field_id('counter'); ?>" name="<?php echo $this->get_field_name('counter'); ?>" type="text" value="<?php echo $instance['counter']; ?>" />
	</label>
</p>
<?php
	}
}
register_widget('flickr_custom');


/*
==========================================================
DOUBLE ADS
==========================================================
*/

class pm_custom_ads extends WP_Widget {
	var $settings = array( 'title', 'adcode', 'image', 'href', 'alt', 'title1', 'adcode1', 'image1', 'href1', 'alt1' );

	function pm_custom_ads() {
		$widget_ops = array('description' => 'Add Double Side by Side Banners to Your Content (e.g. 2x 260x120px in Main or 2x 125x125 in Sidebars)' );
		parent::WP_Widget(false, __('PowerMag - Double Ads Widget', 'powermag'),$widget_ops);      
	}

	function widget($args, $instance) {
		$settings = $this->pm_get_settings();
		extract( $args, EXTR_SKIP );
		$instance = wp_parse_args( $instance, $settings );
		extract( $instance, EXTR_SKIP );

		if ( $title != '' )
			echo $before_title . apply_filters( 'widget-title', $title, $instance, $this->id_base ) . $after_title;

?>

<div class="ads-widget widget double-ad clearfix">

<?php

		if ( $adcode != '' ) {
			echo '<span class="left-ad">';
			echo $adcode;
			echo '</span>';
		} else {
			?>
			
	<a class="left-ad" href="<?php echo esc_url( $href ); ?>"><img src="<?php echo $image; ?>" alt="<?php echo esc_attr( $alt ); ?>" /></a>
	<?php
		}
		
		if ( $adcode1 != '' ) {
			echo '<span class="right-ad">';
			echo $adcode1;
			echo '</span>';
		} else {
			?>
	<a class="right-ad" href="<?php echo esc_url( $href1 ); ?>"><img src="<?php echo $image1; ?>" alt="<?php echo esc_attr( $alt1 ); ?>" /></a>
	<?php
		}
		echo '</div>';
		
	}

	function update( $new_instance, $old_instance ) {
		foreach ( array( 'title', 'alt', 'image', 'href', 'title1', 'alt1', 'image1', 'href1' ) as $setting )
			$new_instance[$setting] = strip_tags( $new_instance[$setting] );
			
		// You need to enable unfiltered_html in order to update this field
		if ( !current_user_can( 'unfiltered_html' ) )
			$new_instance['adcode'] = $old_instance['adcode'];
		return $new_instance;
	
		if ( !current_user_can( 'unfiltered_html' ) )
			$new_instance['adcode1'] = $old_instance['adcode1'];
		return $new_instance;
	}


	function pm_get_settings() {
		// Blank string Defaults
		$settings = array_fill_keys( $this->settings, '' );
		// Specific defaults
		return $settings;
	}

	function form($instance) {
		$instance = wp_parse_args( $instance, $this->pm_get_settings() );
		extract( $instance, EXTR_SKIP );
?>
<p>
	<label for="<?php echo $this->get_field_id('title'); ?>">
		<?php _e('Title (optional):','powermag'); ?>
	</label>
	<input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
</p>
<p style="font-style:italic"><strong>Box No. 1</strong></p>
<?php if ( current_user_can( 'unfiltered_html' ) ) : ?>
<p>
	<label for="<?php echo $this->get_field_id('adcode'); ?>">
		<?php _e('Ad Code:','powermag'); ?>
	</label>
	<textarea name="<?php echo $this->get_field_name('adcode'); ?>" class="widefat" id="<?php echo $this->get_field_id('adcode'); ?>"><?php echo esc_textarea( $adcode ); ?></textarea>
</p>
<p style="font-style:italic"><strong>or</strong></p>
<?php endif; ?>
<p>
	<label for="<?php echo $this->get_field_id('image'); ?>">
		<?php _e('Image Url:','powermag'); ?>
	</label>
	<input type="text" name="<?php echo $this->get_field_name('image'); ?>" value="<?php echo esc_attr( $image ); ?>" class="widefat" id="<?php echo $this->get_field_id('image'); ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id('href'); ?>">
		<?php _e('Link URL:','powermag'); ?>
	</label>
	<input type="text" name="<?php echo $this->get_field_name('href'); ?>" value="<?php echo esc_attr( $href ); ?>" class="widefat" id="<?php echo $this->get_field_id('href'); ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id('alt'); ?>">
		<?php _e('Alt text:','powermag'); ?>
	</label>
	<input type="text" name="<?php echo $this->get_field_name('alt'); ?>" value="<?php echo esc_attr( $alt ); ?>" class="widefat" id="<?php echo $this->get_field_id('alt'); ?>" />
</p>
<br />
<p style="font-style:italic"><strong>Box No. 2</strong></p>
<?php if ( current_user_can( 'unfiltered_html' ) ) : ?>
<p>
	<label for="<?php echo $this->get_field_id('adcode1'); ?>">
		<?php _e('Ad Code:','powermag'); ?>
	</label>
	<textarea name="<?php echo $this->get_field_name('adcode1'); ?>" class="widefat" id="<?php echo $this->get_field_id('adcode1'); ?>"><?php echo esc_textarea( $adcode1 ); ?></textarea>
</p>
<p style="font-style:italic"><strong>or</strong></p>
<?php endif; ?>
<p>
	<label for="<?php echo $this->get_field_id('image1'); ?>">
		<?php _e('Image Url:','powermag'); ?>
	</label>
	<input type="text" name="<?php echo $this->get_field_name('image1'); ?>" value="<?php echo esc_attr( $image1 ); ?>" class="widefat" id="<?php echo $this->get_field_id('image1'); ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id('href1'); ?>">
		<?php _e('Link URL:','powermag'); ?>
	</label>
	<input type="text" name="<?php echo $this->get_field_name('href1'); ?>" value="<?php echo esc_attr( $href1 ); ?>" class="widefat" id="<?php echo $this->get_field_id('href1'); ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id('alt1'); ?>">
		<?php _e('Alt text:','powermag'); ?>
	</label>
	<input type="text" name="<?php echo $this->get_field_name('alt1'); ?>" value="<?php echo esc_attr( $alt1 ); ?>" class="widefat" id="<?php echo $this->get_field_id('alt1'); ?>" />
</p>
<?php
	}
} 

register_widget( 'pm_custom_ads' );


/*
==========================================================
SINGLE AD
==========================================================
*/

class pm_custom_single_ad extends WP_Widget {
	var $settings = array( 'title', 'adcode', 'image', 'href', 'alt');

	function pm_custom_single_ad() {
		$widget_ops = array('description' => 'Add a Single Banner to Your Content (e.g. 468x60 in Main or 230x230 in Sidebars)' );
		parent::WP_Widget(false, __('PowerMag - Single Ad Widget', 'powermag'),$widget_ops);      
	}

	function widget($args, $instance) {
		$settings = $this->pm_get_settings();
		extract( $args, EXTR_SKIP );
		$instance = wp_parse_args( $instance, $settings );
		extract( $instance, EXTR_SKIP );
		
		
?><div class="ads-widget single-ad widget"><?php

		if ( $title != '' )
			echo $before_title . apply_filters( 'widget-title', $title, $instance, $this->id_base ) . $after_title;

		if ( $adcode != '' ) {
			echo $adcode;
		} else {
			?>

<a href="<?php echo esc_url( $href ); ?>"><img src="<?php echo $image; ?>" alt="<?php echo esc_attr( $alt ); ?>" /></a>

<?php }
		echo '</div>';
		
	}

	function update( $new_instance, $old_instance ) {
		foreach ( array( 'title', 'alt', 'image', 'href') as $setting )
			$new_instance[$setting] = strip_tags( $new_instance[$setting] );
			
		// You need to enable unfiltered_html in order to update this field
		if ( !current_user_can( 'unfiltered_html' ) )
			$new_instance['adcode'] = $old_instance['adcode'];
		return $new_instance;
	}

	function pm_get_settings() {
		// Blank string Defaults
		$settings = array_fill_keys( $this->settings, '' );
		// Specific defaults
		return $settings;
	}

	function form($instance) {
		$instance = wp_parse_args( $instance, $this->pm_get_settings() );
		extract( $instance, EXTR_SKIP );
?>
<p>
	<label for="<?php echo $this->get_field_id('title'); ?>">
		<?php _e('Title (optional):','powermag'); ?>
	</label>
	<input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
</p>
<p style="font-style:italic"><strong>Box No. 1</strong></p>
<?php if ( current_user_can( 'unfiltered_html' ) ) : ?>
<p>
	<label for="<?php echo $this->get_field_id('adcode'); ?>">
		<?php _e('Ad Code:','powermag'); ?>
	</label>
	<textarea name="<?php echo $this->get_field_name('adcode'); ?>" class="widefat" id="<?php echo $this->get_field_id('adcode'); ?>"><?php echo esc_textarea( $adcode ); ?></textarea>
</p>
<p style="font-style:italic"><strong>or</strong></p>
<?php endif; ?>
<p>
	<label for="<?php echo $this->get_field_id('image'); ?>">
		<?php _e('Image Url:','powermag'); ?>
	</label>
	<input type="text" name="<?php echo $this->get_field_name('image'); ?>" value="<?php echo esc_attr( $image ); ?>" class="widefat" id="<?php echo $this->get_field_id('image'); ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id('href'); ?>">
		<?php _e('Link URL:','powermag'); ?>
	</label>
	<input type="text" name="<?php echo $this->get_field_name('href'); ?>" value="<?php echo esc_attr( $href ); ?>" class="widefat" id="<?php echo $this->get_field_id('href'); ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id('alt'); ?>">
		<?php _e('Alt text:','powermag'); ?>
	</label>
	<input type="text" name="<?php echo $this->get_field_name('alt'); ?>" value="<?php echo esc_attr( $alt ); ?>" class="widefat" id="<?php echo $this->get_field_id('alt'); ?>" />
</p>

<?php
	}
} 

register_widget( 'pm_custom_single_ad' );


/*
==========================================================
VIDEOS
==========================================================
*/

add_action('widgets_init','pm_video_custom');


function pm_video_custom(){
		register_widget("pm_video_widget");
}

class pm_video_widget extends WP_widget{
	
	function pm_video_widget(){
		$widget_ops = array('classname' => 'pm_video_widget', 'description' => 'Video Widget');

		$control_ops = array('id_base' => 'pm_video_widget');

		$this->WP_Widget('pm_video_widget', 'PowerMag - Video Embed', $widget_ops, $control_ops);
		
	}
	
	function widget($args,$instance){
		extract($args);

		$title = apply_filters('widget_title', $instance['title'] );
		$type = $instance['type'];
		$id = $instance['id'];

			echo $before_widget;

		if ( $title )
			echo $before_title . $title . $after_title;
		?>
<div class="videostream">
	<?php if($type == 'Youtube') { ?>
	<iframe src="http://www.youtube.com/embed/<?php echo $id; ?>?wmode=opaque&amp;modestbranding=1&amp;rel=0" frameborder="0" allowfullscreen></iframe>
	<?php } elseif($type == 'Vimeo') { ?>
	<iframe src="http://player.vimeo.com/video/<?php echo $id; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ba0d16" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
	<?php } elseif($type == 'Dailymotion') { ?>
	<iframe frameborder="0" src="http://www.dailymotion.com/embed/video/<?php echo $id ?>?logo=0"></iframe>
	<?php } ?>
</div>
<?php 

		echo $after_widget;
	}
	
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['type'] = $new_instance['type'];
		$instance['id'] = $new_instance['id'];
		return $instance;
	}
	
	function form($instance){
		$defaults = array( 'title' => 'Video' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>">
		<?php _e('Title:', 'powermag') ?>
	</label>
	<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  class="widefat" />
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'type' ); ?>">
		<?php _e('type', 'powermag') ?>
	</label>
	<select id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" class="widefat">
		<option <?php if (isset($instance['type']) && 'Youtube' == $instance['type'] ) echo 'selected="selected"'; ?>>Youtube</option>
		<option <?php if (isset($instance['type']) && 'Vimeo' == $instance['type'] ) echo 'selected="selected"'; ?>>Vimeo</option>
		<option <?php if (isset($instance['type']) && 'Dailymotion' == $instance['type'] ) echo 'selected="selected"'; ?>>Dailymotion</option>
	</select>
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'id' ); ?>">
		<?php _e('Video <strong>ID</strong>:', 'powermag') ?>
	</label>
	<input id="<?php echo $this->get_field_id( 'id' ); ?>" name="<?php echo $this->get_field_name( 'id' ); ?>" value="<?php if (isset($instance['id']) ) echo $instance['id']; ?>" class="widefat" />
</p>
<?php

	}
}


/*
==========================================================
BEST REVIEWS
==========================================================
*/

class best_reviews_widget extends WP_Widget {


    function best_reviews_widget() {
        parent::WP_Widget(false, $name = 'PowerMag - Best Reviews');	
    }

    function widget($args, $instance) {	
        extract( $args );
		global $wpdb;
		
        $title = apply_filters('widget_title', $instance['image']);
		$alt = $instance['alt'];
		$image = $instance['image'];
		$number = $instance['number'];
	
		
		echo $before_widget; ?>
  	<?php echo $before_title . $alt . $after_title; ?>
	
	<ul class="custom-widget post-widget">
		<?php  	
				$idObj = get_category_by_slug($image);
				$id = $idObj->term_id;
				$category_link = get_category_link( $id );
				$category_name = get_cat_name( $id );
		
				$r = new WP_Query(array('showposts' => $number, 'meta_key' => 'pm_overall_score', 'orderby' => 'meta_value', 'cat' => $id, 'nopaging' => 0, 'post_status' => 'publish'));
				if ($r->have_posts()) : while ($r->have_posts()) : $r->the_post(); 
				
				$pm_video = get_post_meta(get_the_ID(), 'pm_video_encode', true);
				$pm_has_video = $pm_video != ""; 
				$pm_review_enable =  get_post_meta(get_the_ID(), 'pm_review_enable', true);
				$pm_overall_score =  get_post_meta(get_the_ID(), 'pm_overall_score', true);
				$pm_overall_percent = $pm_overall_score;
				$pm_review_type = get_post_meta(get_the_ID(), 'pm_review_type', true);
				
		?>
		<li class="clearfix">
			<div class="img-frame <?php if ( !has_post_thumbnail() ) echo 'no-thumb'?>">
							
					<?php if (has_post_thumbnail()) {		
								
							the_post_thumbnail('mini-thumbs', array('class' => 'wpp-thumbnail wp-post-image')); 
													
						} else {
								
						echo '<a href="'. get_permalink() .'" title="'. get_the_title() .'" ><span class="no-thumb-img"></span></a>'; }
					
						if ( $pm_has_video ) { echo '<a href="'. get_permalink() .'" title="'. get_the_title() .'" ><span class="pm-icon"><i class="icon-play"></i></span></a>'; 
					
					} ?>					
				
			</div>		
			
			<a href="<?php the_permalink();?>" title="<?php the_title();?>">			
				<span><?php the_title();?></span>				
			</a>
			
			<div class="clear"></div>
			
			<div class="info-stripe clearfix">
				<span class="cat-stripe pull-left">
					<a href="<?php echo $category_link ?>" title="<?php echo $category_name ?>">
					<?php echo $category_name ?>
					</a>
				</span>
				
				<span class="post-attribute pull-left"><?php echo get_the_time('F j, Y') ?></span>
				
				<a href="<?php the_permalink();?>" title="<?php the_title();?>"><i class="icon-chevron-right pull-right"></i></a>
				
				<?php if ($pm_review_enable) { 
				
						if ($pm_review_type == 'stars') {
				
					?>
					
					<div class="rw-criteria stars-preview stars-small pull-right">
						<span class="criteria-stars-color">
							<span class="criteria-stars-overlay" style="width:<?php echo $pm_overall_score; ?>%"></span>
						</span>
					</div>
		
					<?php } else { ?>
					
					<span class="percent-stripe"><?php echo $pm_overall_score ?></span>

					<?php }
				
				} ?>
			</div><!-- info-stripe -->				
		</li>
		<?php endwhile; endif; wp_reset_query(); ?>
			
	</ul>
	
	<?php echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['image'] = strip_tags($new_instance['image']);
		$instance['alt'] = strip_tags($new_instance['alt']);
		$instance['number'] =  strip_tags($new_instance['number']);
		
		return $instance;
	}

	function form( $instance ) {


?>
	<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="hidden" value="<?php if (isset($title) ) echo $title; ?>"/>
		
		<p>
			<label for="<?php echo $this->get_field_id('alt'); ?>"><?php _e('Title', 'powermag'); ?>
				<input class="widefat" id="<?php echo $this->get_field_id('alt'); ?>" name="<?php echo $this->get_field_name('alt'); ?>" type="text" value="<?php if (isset($instance['alt']) ) echo $instance['alt']; ?>" />
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('image'); ?>"><?php _e('Category Slug', 'powermag'); ?>			
				<input class="widefat" id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" type="text" value="<?php if (isset($instance['image']) ) echo $instance['image']; ?>" />
			</label>
		</p>
		
		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Reviews Count', 'powermag'); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php if (isset($instance['number']) ) echo $instance['number']; ?>" size="3" /><br />
		<small><?php _e('(15 max.)', 'powermag'); ?></small></p>

		<?php  }

} 
add_action('widgets_init', create_function('', 'return register_widget("best_reviews_widget");'));


/*
==========================================================
HOME CAROUSEL WIDGET
==========================================================
*/

add_action( 'widgets_init', 'pm_carousel_load_widgets' );

function pm_carousel_load_widgets() {
	register_widget( 'pm_carousel_widget' );
}

class pm_carousel_widget extends WP_Widget {

	function pm_carousel_widget() {
		
		/* General settings. */
		$widget_ops = array( 'classname' => 'pm_carousel_widget', 'description' => __('A carousel widget.', 'pm_carousel_widget') );

		/* Control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'pm_carousel_widget' );

		/* Creation */
		$this->WP_Widget( 'pm_carousel_widget', __('Powermag - Carousel Widget', 'pm_carousel_widget'), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		
		wp_enqueue_script( 'elastislide', get_template_directory_uri() . '/js/jquery.elastislide.min.js', array('jquery'), '1.0', true );

		/* Setting the options */
		$title = apply_filters('widget_title', $instance['title'] );
		$chars = $instance['chars'];
		$number = $instance['number'];
		$tags = $instance['tags'];

		echo $before_widget;

		if ( $title )
			echo $before_title . $title . $after_title;
		?>
		<?php 
			$pm_video = get_post_meta(get_the_ID(), 'pm_video_encode', true);
			$pm_has_video = $pm_video != ""; 
		?>
		
			<div class="carousel es-carousel-wrap">
				<div class="es-carousel">
					<ul>

					<?php 
					if ('all' == $instance['tags']) {
					$recent = new WP_Query(array( 'showposts' => $number));
					} else {
					$recent = new WP_Query(array('tag' => $tags, 'showposts' => $number));					
					}
					
					while($recent->have_posts()) : $recent->the_post();?>
					
						<li>
							<div class="carousel-image img-frame <?php if ( !has_post_thumbnail() ) echo 'no-thumb'?>">
								<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
									<?php the_post_thumbnail('carousel-thumbs'); ?>
								<?php } else {
							
									echo '<a href="'. get_permalink() .'" title="'. get_the_title() .'" ><span class="no-thumb-img"></span></a>'; }
				
									if ( $pm_has_video ) { echo '<span class="pm-icon"><i class="icon-play"></i></span>'; 
								} ?>
							</div><!---carousel-image-->
							
							<div class="carousel-text">
									<a href="<?php the_permalink() ?>"><?php the_trimd_title('...', $chars); ?></a>
							</div><!--carousel-text-->
						</li>
					<?php endwhile;
					wp_reset_query();  /* fix @since PM 1.5.0*/ ?>
					</ul>
				</div><!--es-carousel-->
			</div><!--carousel-->


		<?php

		echo $after_widget;
	}

	/**
	 * Update widget settings
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['chars'] = strip_tags( $new_instance['chars'] );
		$instance['number'] = strip_tags( $new_instance['number'] );
		$instance['tags'] = $new_instance['tags'];


		return $instance;
	}


	function form( $instance ) {

		/* Defaults */
		$defaults = array( 'title' => __('Widget Title', 'powermag'), 'number' => 10, 'chars' => 40, 'tags' => 'all');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Title -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'powermag'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:95%;" />
			<small><?php _e('Leave empty not to show any', 'powermag'); ?></small>
		</p>
		
		<!-- Chars Count -->
		<p>
			<label for="<?php echo $this->get_field_id( 'chars' ); ?>"><?php _e('Maximum chars number to show:', 'powermag'); ?></label>
			<input id="<?php echo $this->get_field_id( 'chars' ); ?>" name="<?php echo $this->get_field_name( 'chars' ); ?>" value="<?php echo $instance['chars']; ?>" size="3" />
		</p>

		<!-- Post Count -->
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e('Maximum number of posts to show:', 'powermag'); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" size="3" />
		</p>

		<!-- Tag Selection -->
		<p>
			<label for="<?php echo $this->get_field_id('tags'); ?>"><?php _e('Select Tag', 'powermag'); ?></label>
			<select id="<?php echo $this->get_field_id('tags'); ?>" name="<?php echo $this->get_field_name('tags'); ?>" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['tags']) echo 'selected="selected"'; ?>><?php _e('All Tags', 'powermag'); ?></option>
				<?php $tags = get_tags('hide_empty=0'); ?>
				<?php foreach($tags as $tag) { ?>
				<option value='<?php echo $tag->slug; ?>' <?php if ($tag->slug == $instance['tags']) echo 'selected="selected"'; ?>><?php echo $tag->name; ?></option>
				<?php } ?>
			</select>
		</p>


	<?php
	}
}

?>