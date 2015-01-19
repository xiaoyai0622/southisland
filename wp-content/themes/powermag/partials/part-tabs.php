<div class="cat-tabs">
	<ul class="clearfix">
		
		<?php if(of_get_option('tab1_title') != '') { ?>
		<li><a href="#"><?php echo of_get_option('tab1_title'); ?></a></li>
		<?php } ?>
		<?php if(of_get_option('tab2_title') != '') { ?>
		<li><a href="#"><?php echo of_get_option('tab2_title'); ?></a></li>
		<?php } ?>
		<?php if(of_get_option('tab3_title') != '') { ?>
		<li><a href="#"><?php echo of_get_option('tab3_title'); ?></a></li>
		<?php } ?>
		<?php if(of_get_option('tab4_title') != '') { ?>
		<li><a href="#"><?php echo of_get_option('tab4_title'); ?></a></li>
		<?php } ?>
		<?php if(of_get_option('tab5_title') != '') { ?>
		<li><a href="#"><?php echo of_get_option('tab5_title'); ?></a></li>
		<?php } ?>
		<?php if(of_get_option('tab6_title') != '') { ?>
		<li><a href="#"><?php echo of_get_option('tab6_title'); ?></a></li>
		<?php } ?>
		<?php if(of_get_option('tab7_title') != '') { ?>
		<li><a href="#"><?php echo of_get_option('tab7_title'); ?></a></li>
		<?php } ?>
		<?php if(of_get_option('tab8_title') != '') { ?>
		<li><a href="#"><?php echo of_get_option('tab8_title'); ?></a></li>
		<?php } ?>
	</ul>
</div>

<?php
$tab1 = "tab1";
$tab2 = "tab2";
$tab3 = "tab3";
$tab4 = "tab4";
$tab5 = "tab5";
$tab6 = "tab6";
$tab7 = "tab7";
$tab8 = "tab8";
?>
	
	<?php if(of_get_option('tab1_title') != '') { ?>
	<div class="cat-panes-content">
	<?php mm_cat_tabs($tab1); ?>
	</div>
	<?php } ?>
	
	<?php if(of_get_option('tab2_title') != '') { ?>
	<div class="cat-panes-content">
	<?php mm_cat_tabs($tab2); ?>
	</div>
	<?php } ?>
	
	<?php if(of_get_option('tab3_title') != '') { ?>
	<div class="cat-panes-content">
	<?php mm_cat_tabs($tab3); ?>
	</div>
	<?php } ?>
	
	<?php if(of_get_option('tab4_title') != '') { ?>
	<div class="cat-panes-content">
	<?php mm_cat_tabs($tab4); ?>
	</div>
	<?php } ?>
	
	<?php if(of_get_option('tab5_title') != '') { ?>
	<div class="cat-panes-content">
	<?php mm_cat_tabs($tab5); ?>
	</div>
	<?php } ?>
	
	<?php if(of_get_option('tab6_title') != '') { ?>
	<div class="cat-panes-content">
	<?php mm_cat_tabs($tab6); ?>
	</div>
	<?php } ?>
	
	<?php if(of_get_option('tab7_title') != '') { ?>
	<div class="cat-panes-content">
	<?php mm_cat_tabs($tab7); ?>
	</div>
	<?php } ?>
	
	<?php if(of_get_option('tab8_title') != '') { ?>
	<div class="cat-panes-content">
	<?php mm_cat_tabs($tab8); ?>
	</div>
	<?php } ?>