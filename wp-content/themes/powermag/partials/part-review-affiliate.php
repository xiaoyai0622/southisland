<?php
$link = get_post_meta(get_the_ID(), 'pm_affiliate', true);
$catch = get_post_meta(get_the_ID(), 'pm_affiliate_catch', true);
$btn_txt = get_post_meta(get_the_ID(), 'pm_affiliate_btn', true);
$btn_icon = get_post_meta(get_the_ID(), 'pm_affiliate_btn_icon', true);
?>

<div class="affiliate-wrap clearfix">
	<p><?php echo $catch; ?></p>
	<span class="affiliate-link"><a href="<?php echo $link; ?>" target="_blank" class="btn"><?php if ($btn_icon) { echo '<i class="icon-shopping-cart"></i> '; } ?><?php echo $btn_txt; ?></a></span>
</div>