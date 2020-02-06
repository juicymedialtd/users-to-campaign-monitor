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

		function status_change() {
            flush_rewrite_rules();
		}
	}

	$usersToCampaignMonitor = new UsersToCampaignMonitor();
    $usersToCampaignMonitor->register();

	register_activation_hook(__FILE__, array($usersToCampaignMonitor, 'status_change'));
	register_deactivation_hook(__FILE__, array($usersToCampaignMonitor, 'status_change'));
}
