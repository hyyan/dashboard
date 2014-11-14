<?php

/*
 * Plugin Name: Hyyan dashboard
 * Plugin URI: https://github.com/hyyan/dashboard/
 * Description: Wordpress plugin to let themes customize the dashboard in their own way
 * Author: Hyyan Abo Fakher
 * Version: 0.3
 * Author URI: https://github.com/hyyan
 * GitHub Plugin URI: hyyan/dashboard
 * Domain Path: /languages
 * Text Domain: dashboard
 * License: MIT License
 */

if (!defined('ABSPATH')) exit('restricted access');

require_once __DIR__ . '/src/HyyanDashboard.php';

/**
 * Bootstrap the plugin
 */
new HyyanDashboard();
