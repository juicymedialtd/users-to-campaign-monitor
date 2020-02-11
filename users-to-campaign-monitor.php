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

use \Curl\Curl;

if (!class_exists('UsersToCampaignMonitor')) {
	class UsersToCampaignMonitor {
	    public $plugin;

		public function __construct() {
			$this->plugin = plugin_basename(__FILE__);
		}

		public function register() {
            add_action('admin_init', array($this, 'settings'));

            add_action('admin_menu', function() {
                add_submenu_page('tools.php', 'Users to Campaign Monitor', 'Users to Campaign Monitor', 'manage_options', 'users-to-campaign-monitor', array($this, 'admin_index'));
            });

            add_filter('plugin_action_links_' . $this->plugin, function ($links) {
                array_push($links, '<a href="admin.php?page=users_to_campaign_monitor">Settings</a>');
                return $links;
            });

            add_action('user_register', array($this, 'hook'));

		}

        public function hook($id) {
            $user = get_userdata($id);

            $curl = new Curl();
            $curl->setBasicAuthentication(UTCM_USERNAME, '');
            $curl->setHeader('Content-Type', 'application/json');
            $curl->post('https://api.createsend.com/api/v3.2/subscribers/' . UTCM_LIST_ID . '.json', array(
                'EmailAddress' => $user->data->user_email,
                'Name' => get_user_meta($id, 'first_name', true) . ' ' . get_user_meta($id, 'last_name', true),
                'ConsentToTrack' => 'Yes'
            ));
        }

        public function settings() {
            $fields = ['utcm_username', 'utcm_list_id'];

            foreach ($fields as $field) {
                add_option($field, '');

                register_setting('utcm_options_group', $field, function($value) {
                    return sanitize_text_field($value);
                });
            }
        }

        public function admin_index() {
            require_once plugin_dir_path( __FILE__ ) . 'templates/admin.php';
        }

		public function status_change() {
            flush_rewrite_rules();
		}
	}

	$usersToCampaignMonitor = new UsersToCampaignMonitor();
    $usersToCampaignMonitor->register();

	register_activation_hook(__FILE__, array($usersToCampaignMonitor, 'status_change'));
	register_deactivation_hook(__FILE__, array($usersToCampaignMonitor, 'status_change'));
}
