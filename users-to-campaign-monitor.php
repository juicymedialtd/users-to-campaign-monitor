<?php
/*
Plugin Name: Users to Campaign Monitor
Plugin URI: https://github.com/juicymedialtd/users-to-campaign-monitor
Description: A plugin to push all new registered user's emails to Campaign Monitor.
Version: 1.0.0
Author: Juicy Media
Author URI: https://juicymedia.co.uk
License: MIT License
Text Domain: utcm
*/

defined('ABSPATH') || exit;

if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
	require_once dirname(__FILE__) . '/vendor/autoload.php';
}

if (!class_exists('UsersToCampaignMonitor')) {
	class UsersToCampaignMonitor {
	    public $plugin;

		public function __construct() {
			$this->plugin = plugin_basename(__FILE__);
		}

		public function register() {
			add_action('admin_menu', array($this, 'pages'));
			add_filter('plugin_action_links_' . $this->plugin, function ($links) {
                array_push( $links, '<a href="admin.php?page=users_to_campaign_monitor">Settings</a>' );
                return $links;
            });
		}

		public function pages() {
            add_submenu_page('tools.php', 'Users to Campaign Monitor', 'Users to Campaign Monitor', 'manage_options', 'users-to-campaign-monitor', array($this, 'admin_index'));
        }

		public function admin_index() {
			require_once plugin_dir_path( __FILE__ ) . 'templates/admin.php';
		}

		function activate() {
            flush_rewrite_rules();
		}
	}

	$usersToCampaignMonitor = new UsersToCampaignMonitor();
    $usersToCampaignMonitor->register();

	// activation
	register_activation_hook(__FILE__, array($usersToCampaignMonitor, 'activate'));

	// deactivation
	register_deactivation_hook(__FILE__, array('Deactivate', 'deactivate'));
}
