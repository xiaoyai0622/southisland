		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">
			
			<div id="loop-wrap">
			
			<?php //Get Sliders if at least one is enabled
			
			if ( of_get_option('pm_slider_1') ) get_template_part ('partials/part', 'sliders');?>
			
				<div class="row" id="widgetized-home">
				
					<?php if (of_get_option('pm_sidebar_position') == 'sidebar-content') get_template_part('partials/part', 'home-sidebar'); ?>

					<div class="span5 widgetized-big">
					
						<?php
						//get tabs categories BEFORE main widgets //FIRST Column
						if ( of_get_option('tabs_activate') AND of_get_option('tabs_position') == 'before' AND of_get_option('tabs_column') == 'first' )  get_template_part( 'partials/part', 'tabs' ); ?>
					
						<?php
						if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('HomePage Big')): 
						endif;
						?>

						<?php 
						//get tabs categories AFTER main widgets //First Column
						if ( of_get_option('tabs_activate') AND of_get_option('tabs_position') == 'after' AND of_get_option('tabs_column') == 'first' )  get_template_part( 'partials/part', 'tabs' ); ?>
					</div>
					
					<div class="span4 widgetized-medium">
					
						<?php 
						//get tabs categories BEFORE main widgets //SECOND Column

						if ( of_get_option('tabs_activate') AND of_get_option('tabs_position') == 'before' AND of_get_option('tabs_column') == 'second' )  get_template_part( 'partials/part', 'tabs' ); ?>
						
						<?php
						if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('HomePage Medium')): 
						endif;
						?>
						
						<?php 
						//get tabs categories AFTER main widgets //Second Column
						if ( of_get_option('tabs_activate') AND of_get_option('tabs_position') == 'after' AND of_get_option('tabs_column') == 'second' )  get_template_part( 'partials/part', 'tabs' ); ?>
					</div>	
					
					<?php if (of_get_option('pm_sidebar_position') == 'content-sidebar') get_template_part('partials/part', 'home-sidebar'); ?>
					
				</div><!-- .row #widgetized-home -->
				
				</div>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->