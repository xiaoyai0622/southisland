<?php
/**
 * Copyright (c) 2012 Khang Minh <betterwp.net>
 * @license http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE VERSION 3.0 OR LATER
 */
 
define('BWP_FRAMEWORK_VERSION', '1.0.0');

class BWP_FRAMEWORK {

	/**
	 * Database related data
	 */	
	var $options = array();

	/**
	 * Default data
	 */	
	var $options_default = array(), $site_options = array();

	/**
	 * Hold db option keys
	 */	
	var $option_keys = array();
	
	/**
	 * Hold extra option keys
	 */	
	var $extra_option_keys = array();

	/**
	 * Hold old option pages
	 */	
	var $option_pages = array();

	/**
	 * Key to identify plugin
	 */	
	var $plugin_key;

	/**
	 * Constant Key to identify plugin
	 */	
	var $plugin_ckey;
	
	/**
	 * Domain Key to identify plugin
	 */	
	var $plugin_dkey;

	/**
	 * Title of the plugin
	 */	
	var $plugin_title;

	/**
	 * Homepage of the plugin
	 */	
	var $plugin_url;
	
	/**
	 * Plugin file
	 */	
	var $plugin_file;
	
	/**
	 * Version of the plugin
	 */	
	var $plugin_ver = '';
	
	/**
	 * Message shown to user (Warning, Notes, etc.)
	 */	
	var $notices = array(), $notice_shown = false;
	
	/**
	 * Capabilities to manage this plugin
	 */	
	var $plugin_cap = 'manage_options';
	
	/**
	 * Whether or not to create filter for media paths
	 */	
	var $need_media_filters;
	
	/**
	 * Form tabs to build
	 */	
	var $form_tabs = array();

	/**
	 * Other things
	 */
	var $wp_ver = '2.8';
	var $php_ver = '5';

	/**
	 * Other special variables
	 */
	protected static $_menu_under_settings = false;
	protected static $_simple_menu = false;

	/**
	 * Build base properties
	 */
	function build_properties($key, $dkey, $options, $plugin_title = '', $plugin_file = '', $plugin_url = '', $need_media_filters = true)
	{		
		$this->plugin_key = strtolower($key);
		$this->plugin_ckey = strtoupper($key);
		$this->plugin_dkey = $dkey;
		$this->plugin_title = $plugin_title;
		$this->plugin_url = $plugin_url;
		// The default options
		$this->options_default = $options;
		$this->need_media_filters = (boolean) $need_media_filters;
		$this->plugin_file = $plugin_file;
		// Load locale
		load_plugin_textdomain($dkey, false, basename(dirname($plugin_file)) . '/languages');
	}

	function add_option_key($key, $option, $title)
	{
		$this->option_keys[$key] = $option;
		$this->option_pages[$key] = $title;
	}
	
	function add_extra_option_key($key, $option, $title)
	{
		$this->extra_option_keys[$key] = $option;
		$this->option_pages[$key] = $title;
	}

	function add_icon()
	{
		return '<div class="icon32" id="icon-bwp-plugin" style=\'background-image: url("' . constant($this->plugin_ckey . '_IMAGES') . '/icon_menu_32.png");\'><br></div>'  . "\n";
	}

	function set_version($ver = '', $type = '')
	{
		switch ($type)
		{
			case '': $this->plugin_ver = $ver;
			break;
			case 'php': $this->php_ver = $ver;
			break;
			case 'wp': $this->wp_ver = $ver;
			break;
		}
	}
	
	function get_version($type = '')
	{
		switch ($type)
		{
			case '': return $this->plugin_ver;
			break;
			case 'php': return $this->php_ver;
			break;
			case 'wp': return $this->wp_ver;
			break;
		}
	}

	function check_required_versions()
	{
		if (version_compare(PHP_VERSION, $this->php_ver, '<') || version_compare(get_bloginfo('version'), $this->wp_ver, '<'))
		{
			add_action('admin_notices', array($this, 'warn_required_versions'));
			add_action('network_admin_notices', array($this, 'warn_required_versions'));
			return false;
		}
		else
			return true;
	}

	function warn_required_versions()
	{
		echo '<div class="error"><p>' . sprintf(__('%s requires WordPress <strong>%s</strong> or higher and PHP <strong>%s</strong> or higher. The plugin will not function until you update your software. Please deactivate this plugin.', $this->plugin_dkey), $this->plugin_title, $this->wp_ver, $this->php_ver) . '</p></div>';
	}

	function show_donation()
	{
		$showable = apply_filters('bwp_donation_showable', true);		
?>
<!-- djwd removed -->
<?php
		if (true == $showable || ($this->is_multisite() && is_super_admin()))
		{
?>
<!-- djwd removed -->
<?php
		}
?>
</div>
<div id="bwp-seperator">
	<div style="height: 10px; width: 5px; background-color: #cccccc; margin: 0 auto;"><!-- --></div>
</div>
<div id="bwp-contact">
<!-- djwd removed -->
</div>
</div>
<?php
	}
	
	function show_version()
	{
		if (empty($this->plugin_ver)) return '';
		return '<a class="nav-tab version" title="' . sprintf(esc_attr(__('You are using version %s!', $this->plugin_dkey)), $this->plugin_ver) . '">' . $this->plugin_ver . '</a>';
	}
	
	function init()
	{
		// Build constants
		$this->build_constants();
		// Build options
		$this->build_options();
		// Load libraries
		$this->load_libraries();
		// Add actions and filters		
		$this->add_hooks();
		// Enqueue needed media, conditionally
		add_action('init', array($this, 'enqueue_media'));
		// Load other properties
		$this->init_properties();
		// Loaded everything for this plugin, now you can add other things to it, such as stylesheet, etc.
		do_action($this->plugin_key . '_loaded');
		// Support installation and uninstallation
		register_activation_hook($this->plugin_file, array($this, 'install'));
		register_deactivation_hook($this->plugin_file, array($this, 'uninstall'));
		// icon 32px
		if ($this->is_admin_page())
		{
			add_filter('bwp-admin-form-icon', array($this, 'add_icon'));
			add_filter('bwp-admin-plugin-version', array($this, 'show_version'));
			add_action('bwp_option_action_before_form', array($this, 'show_donation'), 12);
		}
	}
	
	function add_cap($cap)
	{
		$this->plugin_cap = $cap;
	}

	function build_constants()
	{
		define($this->plugin_ckey . '_PLUGIN_URL', $this->plugin_url);
		// Path
		if (true == $this->need_media_filters)
		{
			define($this->plugin_ckey . '_IMAGES', apply_filters($this->plugin_key . '_image_path', plugin_dir_url($this->plugin_file) . 'images'));
			define($this->plugin_ckey . '_CSS', apply_filters($this->plugin_key . '_css_path', plugin_dir_url($this->plugin_file) . 'css'));
			define($this->plugin_ckey . '_JS', apply_filters($this->plugin_key . '_js_path', plugin_dir_url($this->plugin_file) . 'js'));
		}
		else
		{
			define($this->plugin_ckey . '_IMAGES', plugin_dir_url($this->plugin_file) . 'images');
			define($this->plugin_ckey . '_CSS', plugin_dir_url($this->plugin_file) . 'css');
			define($this->plugin_ckey . '_JS', plugin_dir_url($this->plugin_file) . 'js');			
		}
		// Option page related
		define($this->plugin_ckey . '_CAPABILITY', $this->plugin_cap); // the capability needed to configure this plugin
		
		foreach ($this->option_keys as $key => $option)
		{
			define(strtoupper($key), $option);
		}

		foreach ($this->extra_option_keys as $key => $option)
		{
			define(strtoupper($key), $option);
		}
	}

	function build_options()
	{
		// Get all options and merge them
		$options = $this->options_default;
		foreach ($this->option_keys as $option)
		{
			$db_option = get_option($option);
			if ($db_option && is_array($db_option))
				$options = array_merge($options, $db_option);
			unset($db_option);
			// Also check for global options if in Multi-site
			if ($this->is_multisite())
			{
				$db_option = get_site_option($option);
				if ($db_option && is_array($db_option))
				{
					$temp = array();
					foreach ($db_option as $k => $o)
					{
						if (in_array($k, $this->site_options))
							$temp[$k] = $o;
					}
					$options = array_merge($options, $temp);
				}
			}
		}
		$this->options = $options;
	}

	function init_properties()
	{
		/* intentionally left blank */
	}

	function load_libraries()
	{
		/* intentionally left blank */
	}

	function add_hooks()
	{
		/* intentionally left blank */
	}
	
	function enqueue_media()
	{
		/* intentionally left blank */
	}

	function install()
	{
		/* intentionally left blank */
	}

	function uninstall()
	{
		/* intentionally left blank */
	}
	
	function is_admin_page()
	{
		if (is_admin() && !empty($_GET['page']) && (in_array($_GET['page'], $this->option_keys) || in_array($_GET['page'], $this->extra_option_keys)))
			return true;
	}

	function plugin_action_links($links, $file) 
	{
		$option_script = (!self::$_menu_under_settings && !self::$_simple_menu) ? 'admin.php' : 'options-general.php';
		$option_keys = array_values($this->option_keys);
		if ($file == plugin_basename($this->plugin_file))
			$links[] = '<a href="' . $option_script . '?page=' . $option_keys[0] . '">' . __('Settings') . '</a>';

		return $links;
	}

	function init_admin()
	{
		self::$_menu_under_settings = apply_filters('bwp_menus_under_settings', false);

		add_filter('plugin_action_links', array($this, 'plugin_action_links'), 10, 2);

		if ($this->is_admin_page())
		{
			// Build tabs
			$this->build_tabs();
			// Load option page builder
			if (!class_exists('BWP_OPTION_PAGE'))
				require_once(dirname(__FILE__) . '/bwp-option-page/bwp-option-page.php');
			// Enqueue style sheets and scripts for the option page
			wp_enqueue_style('bwp-option-page',  plugin_dir_url($this->plugin_file) . 'includes/bwp-option-page/css/bwp-option-page.css', array(), '1.0.1');
			wp_enqueue_script('bwp-paypal-js',  plugin_dir_url($this->plugin_file) . 'includes/bwp-option-page/js/paypal.js', array('jquery'));
		}

		$this->build_menus();
	}

	/**
	 * Build the Menus
	 */
	function build_menus()
	{
		/* intentionally left blank */
	}
	
	function build_tabs()
	{
		$option_script = (!self::$_menu_under_settings) ? 'admin.php' : 'options-general.php';
		foreach ($this->option_pages as $key => $page)
		{
			$pagelink = (!empty($this->option_keys[$key])) ? $this->option_keys[$key] : $this->extra_option_keys[$key];
			$this->form_tabs[$page] = get_option('siteurl') . '/wp-admin/' . $option_script . '?page=' . $pagelink;
		}
	}

	/**
	 * Build the option pages
	 *
	 * Utilizes BWP Option Page Builder (@see BWP_OPTION_PAGE)
	 */	
	function build_option_pages()
	{
		/* intentionally left blank */
	}

	function add_notice($notice)
	{
		if (!in_array($notice, $this->notices))
		{
			$this->notices[] = $notice;
			add_action('bwp_option_action_before_form', array($this, 'show_notices'));
		}
	}
	
	function show_notices()
	{
		if (false == $this->notice_shown)
		{
			foreach ($this->notices as $notice)
			{
				echo '<div class="updated fade"><p>' . $notice . '</p></div>';
			}
			$this->notice_shown = true;
		}
	}
	
	function is_multisite()
	{
		if (function_exists('is_multisite') && is_multisite())
			return true;
		return false;
	}
	
	function is_normal_admin()
	{
		if ($this->is_multisite() && !is_super_admin())
			return true;
		return false;
	}
}
?>