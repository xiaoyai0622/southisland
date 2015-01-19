<?php
/**
 * The Header for PowerMag.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package PowerMag
 * @since PowerMag 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> <?php get_template_part( 'partials/part', 'background');?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/modernizr-2.5.3.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="ie8.css" />
<![endif]-->

<?php include('partials/part-cat-options.php' );?>

<?php
/* FB comments moderation - @since PM 1.7.0 */
$fb_userID = of_get_option('pm_fb_userid');
$fb_appID = of_get_option('pm_fb_appid');

if (is_single() AND $fb_userID != NULL) {
	echo '<meta property="fb:admins" content="' . $fb_userID . '"/>';
}

if (is_single() AND $fb_appID != NULL) {
	echo '<meta property="fb:app_id" content="' . $fb_appID . '"/>';
}

?>

<?php wp_head(); ?>
</head>

<body <?php if (of_get_option('pm_homestyle') == 'widgetized' ) { body_class(); } else { body_class('classic-blog'); } ?>>

<?php if ( of_get_option('pm_fadein') ) { ?>
<noscript><style scoped>#main { visibility: visible!important } </style></noscript>
<?php } ?>

<?php if (of_get_option('pm_wall_ad') != NULL) { //Link Wallpaper if enabled ?>
<div id="wallpaper">
	<?php if( of_get_option('pm_wall_ad')) { ?>
	<a href="<?php echo of_get_option('pm_wall_ad'); ?>" class="wallpaper-link"  target="_blank"></a>
	<?php } ?>
</div><!--wallpaper-->
<?php } ?>

<?php $boxed = of_get_option('pm_boxed') == 'boxed';
if ($boxed) { ?>
<div class="container full-main boxed-layout">
<?php } ?>

<div id="page" class="hfeed site">

	<?php do_action( 'before' ); ?>
	
	<div id="header-wrap">
	
		<div id="full-top">
			
			<!-- Masthead
			================================================== -->
			<header id="masthead" class="site-header" role="banner">
				<div class="container">
					<div class="row">
						<div class="span12 header-wrap">
							<div class="branding">
								
								<?php if (of_get_option('pm_logo') == NULL) { ?>
								
								<h1 class="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
								
								<?php } else { 
								
								//list($width, $height, $type, $attr) = getimagesize( of_get_option('pm_logo') );
								
								?>
								
								<div id="logo">
									<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo of_get_option('pm_logo'); ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"/></a>
								</div>
								<?php } ?>
							
							</div>
							
							<?php if (of_get_option('pm_top_ad') != NULL) { //Top Banner ?>
							<div id="top-ad">
								<?php echo ( of_get_option('pm_top_ad') ); ?>
							</div>
							<?php } ?>
							
							<div class="utilities">
								<?php wp_nav_menu( array( 'theme_location' => 'utilities', 'container_class' => 'util-menu', 'depth' => 1 ) ); ?>
								<?php get_template_part( 'partials/part', 'socials');?>
							</div>
							
						</div><!--span12-->
					</div><!--row-->
				</div><!--.container-->
			</header><!-- #masthead .site-header -->
		</div><!-- #full-top -->
		
		<!-- Login Bar and Search
		================================================== -->
		<div id="full-bar">
			<div class="container">
				<div class="row full-bar-relative">
					<div class="span4"><?php get_search_form(); ?></div>
					
					<div class="signin">
						<?php
							if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('login-sidebar')): 
							endif;
						?>
					</div>
				</div><!-- full-bar-relative .row -->
			</div><!-- .container -->
		</div><!-- #full-bar -->
		
		<?php if (of_get_option ('pm_collapsible')) get_template_part( 'partials/part', 'collapsible'); //Get Hidden Row if enabled ?>
	
	</div><!--header-wrap-->
	
	<?php if (!$boxed) { ?>
	<div class="container full-main free-layout">
	<?php } ?>
	
	<div id="nav-wrap">
		<div class="row">
			<div class="navi-class span12 clearfix">
				<nav role="navigation" class="site-navigation main-navigation">
							<h1 class="assistive-text"><?php _e( 'Menu', 'powermag' ); ?><i class="icon-reorder"></i></h1>
							<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'powermag' ); ?>"><?php _e( 'Skip to content', 'powermag' ); ?></a></div>
							
							<?php wp_nav_menu( array( 'theme_location' => 'primary', 'after' => '<span class="corner custom-color"></span>', 'walker' => new Description_Walker ) ); ?>
							
							<?php if (of_get_option('pm_date') ) { //Get current date if enabled ?>
							<div class="date">
								<a href="<?php echo get_day_link('', '', ''); ?>" rel="tooltip" data-original-title="<?php _e('Check out today&#39s posts!', 'powermag')?>" data-placement="left"><?php echo date_i18n(get_option('date_format')); ?></a>
								<span class="corner custom-color"></span>
							</div>
							<?php } ?>
	
				</nav><!-- .site-navigation .main-navigation -->
			</div><!-- #nav-wrap -->
		</div><!-- nav .row -->
	</div>

		<?php if ( of_get_option('pm_ticker') ) { //Get NewsTicker if Enabled ?>
			<?php if ( of_get_option('pm_ticker_where') == 'all' ) { get_template_part( 'partials/part', 'ticker'); }
				  elseif ( of_get_option('pm_ticker_where') == 'home' AND is_home() ) { get_template_part( 'partials/part', 'ticker');}
			?>
		<?php } ?>
		
		<div id="main" class="site-main">
		<?php if ( of_get_option('pm_fadein') ) { echo '<span class="spinner"></span>'; }?>