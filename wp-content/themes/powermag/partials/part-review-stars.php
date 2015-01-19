<div id="rating-box" class="<?php if ( ($pm_box_position) == 'floated' ) echo ' floated'?>">

	<?php if ( ($pm_review_header) != '' ) { ?>
	<div class="widget-title-bg clearfix">
		<h4 class="widget-title">
			<span class="inner"><span itemprop="name"><?php echo $pm_review_header; ?></span></span>
			<span class="cat-diagonal"></span>
		</h4>
	</div>
	<?php } ?>
	
	
	<?php
	$i = 0;
	while( $i < 6 ){
	$i ++;
	
	$criteria = "pm_rating_c".$i."";
	$description = "pm_description_c".$i."";
	$width = "pm_width_c".$i."";
	
	if (isset($$criteria) && $$description != '') { ?>
	
	<div class="rw-criteria">
			<span class="criteria-stars-color">
				<span class="criteria-stars-overlay" style="width:<?php echo $$width; ?>%"></span>
			</span>
		<span class="criteria-description"><?php echo $$description ?></span>
	</div>
	<?php }
	} ?>
	
	<div itemprop="review" itemscope itemtype="http://schema.org/Review">
		<div class="rw-end">
			<div class="rw-summary">
				<span class="rw-overall-titles"><?php _e('Final Thoughts', 'powermag'); ?></span>
				<p itemprop="description"><?php echo $pm_summary ?></p>
			</div>
	
			<div class="rw-overall">
				<span class="rw-overall-titles"><?php _e('Overall Score', 'powermag'); ?></span>
				
				<span itemprop="reviewRating" class="rw-overall-number"><?php echo (intval($pm_overall_score/2))/10 . "\n"; ?></span>
				
				<meta itemprop="itemReviewed" content="<?php the_title(); ?>" />
				<meta itemprop="author" content="<?php the_author(); ?>" />
				<meta itemprop="datePublished" content="<?php echo get_the_date(); ?>">
				
				<span class="rw-overall-titles"><?php echo $pm_tagline ?>
					<span id="rw-overall-stars-overlay">
						<span id="rw-overall-stars-color" style="width:<?php echo $pm_overall_width;?>%"></span>
					</span>
				</span>
				
			</div><!--.rw-overall -->	
		</div><!--.rw-end -->
		
		<?php //Get user rating for the post 
		$pm_user_rating_switch = get_post_meta($post->ID, 'pm_user_rating_switch', true);
			if ($pm_user_rating_switch) { get_template_part ('partials/part', 'user-rating'); 
		} ?>
		
		<?php //Get Affiliate Link Stripe
		$pm_affiliate = get_post_meta($post->ID, 'pm_affiliate', true);
			if ($pm_affiliate != NULL ) { get_template_part ('partials/part', 'review-affiliate'); 
		} ?>
		
	</div><!--schema.org wrap-->
</div><!-- #rating-box -->