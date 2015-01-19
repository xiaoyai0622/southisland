<?php $posts_per_page = of_get_option('pm_ticker_count'); ?>

<div class="row">

	<div id="ticker-wrap" class="span12">	
		
		<span class="widget-title-bg">
				<span class="widget-title">
					<span class="inner"><?php echo of_get_option('pm_ticker_title') ?></span>
					<span class="cat-diagonal"></span>
				</span>
		</span><!-- .widget-title-bg-->

			<ul id="js-news" class="js-hidden">
			<?php 
				query_posts( array(
					
					'posts_per_page' => $posts_per_page,
					'cat' => of_get_option('pm_ticker_cat')
				));
			?>
			
				<?php if (have_posts()) : while (have_posts()) : the_post();  ?>
				<li class="news-item">
					<a href='<?php the_permalink(); ?>' title='<?php the_title() ?>'><?php the_title(); ?></a>
				</li>
				<?php endwhile; 
				endif; ?>
				
				<?php wp_reset_query() ?>
			</ul>
	</div><!-- #ticker -->
</div><!-- .row -->