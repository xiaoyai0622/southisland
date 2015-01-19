<?php
//Get the comments option
$pm_comment_type = get_post_meta(get_the_ID(), 'pm_comment_type', true);

//Bring in the ratings data
$pm_review_enable = get_post_meta(get_the_ID(), 'pm_review_enable', true);
$pm_user_rating_switch = get_post_meta(get_the_ID(), 'pm_user_rating_switch', true);
$pm_overall_score = get_post_meta(get_the_ID(), 'pm_overall_score', true);
$pm_summary = get_post_meta(get_the_ID(), 'pm_summary', true);
$pm_tagline = get_post_meta(get_the_ID(), 'pm_tagline', true);
$pm_review_type = get_post_meta(get_the_ID(), 'pm_review_type', true);
$pm_box_position = get_post_meta(get_the_ID(), 'pm_box_position', true);
$pm_review_header = get_post_meta(get_the_ID(), 'pm_review_header', true);
$pm_rating_c1 = get_post_meta(get_the_ID(), 'pm_rating_c1', true);
$pm_description_c1 = get_post_meta(get_the_ID(), 'pm_description_c1', true);
$pm_rating_c2 = get_post_meta(get_the_ID(), 'pm_rating_c2', true);
$pm_description_c2 = get_post_meta(get_the_ID(), 'pm_description_c2', true);
$pm_rating_c3 = get_post_meta(get_the_ID(), 'pm_rating_c3', true);
$pm_description_c3 = get_post_meta(get_the_ID(), 'pm_description_c3', true);
$pm_rating_c4 = get_post_meta(get_the_ID(), 'pm_rating_c4', true);
$pm_description_c4 = get_post_meta(get_the_ID(), 'pm_description_c4', true);
$pm_rating_c5 = get_post_meta(get_the_ID(), 'pm_rating_c5', true);
$pm_description_c5 = get_post_meta(get_the_ID(), 'pm_description_c5', true);
$pm_rating_c6 = get_post_meta(get_the_ID(), 'pm_rating_c6', true);
$pm_description_c6 = get_post_meta(get_the_ID(), 'pm_description_c6', true);

// Calculate the percentages from the star ratings
$pm_percentage_c1 = $pm_rating_c1;
$pm_percentage_c2 = $pm_rating_c2;
$pm_percentage_c3 = $pm_rating_c3;
$pm_percentage_c4 = $pm_rating_c4;
$pm_percentage_c5 = $pm_rating_c5;
$pm_percentage_c6 = $pm_rating_c6;
$pm_overall_percent = $pm_overall_score;

// Setup new variable to echo out the sprite width
$pm_width_c1 = $pm_percentage_c1;
$pm_width_c2 = $pm_percentage_c2;
$pm_width_c3 = $pm_percentage_c3;
$pm_width_c4 = $pm_percentage_c4;
$pm_width_c5 = $pm_percentage_c5;
$pm_width_c6 = $pm_percentage_c6;
$pm_overall_width = $pm_overall_percent;

$format = get_post_format();
if (false === $format)
	$format = 'standard';
?>