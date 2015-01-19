<?php if ( of_get_option('pm_third_sidebar') == 'widgetized' ) { ?>
<div class="span3 widgetized-small">
	<?php
	if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('HomePage Small')): 
	endif;
	?>
</div>
<?php } else { ?>
<div class="span3 widgetized-small">
	<?php
	if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar')): 
	endif;
	?>
</div>
<?php } ?>