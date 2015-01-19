<?php 
$user_rating = new pm_user_rating();
$pm_review_type = get_post_meta(get_the_ID(), 'pm_review_type', true);
?>

<div class="rw-user-rating-wrapper">
	<div class="rw-user-rating-desc">
		<span class="your_rating" style="display:none;"><?php _e('Your Rating', 'powermag'); ?></span>
		<span class="user_rating"><?php _e('Readers Rating', 'powermag'); ?></span><br />
		<span class="count"><?php echo $user_rating->count; ?> <?php _e('votes', 'powermag'); ?></span>
		
		<div class="rw-user-rating-right">
		
		<?php if (($pm_review_type) == 'percent') { ?>
			<span class="score percent"><?php echo $user_rating->current_rating ?></span>
		<?php } else { ?>
			<span class="score"><?php echo floor($user_rating->current_rating/2) /10 ?></span>
		<?php } ?>
			<span class="rw-user-rating">
				<span class="criteria-stars-color">
					<span class="criteria-stars-overlay" style="width:<?php echo $user_rating->current_position; ?>%"></span>
				</span>
			</span>
		</div><!--rw-user-rating-right-->
	
	</div><!--.rw-user-rating-desc-->
	
	
</div><!-- .rw-user-rating-wrapper -->