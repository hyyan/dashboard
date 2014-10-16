<?php

/*
 * This file is part of the hyyan/login-style package.
 * (c) Hyyan Abo Fakher <tiribthea4hyyan@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * HyyanLoginStyle
 *
 * @author Hyyan
 */
class HyyanDashboard {

    public function __construct() {
        add_filter('admin_title', array($this, 'replaceTitle'), 10, 2);
        add_action('admin_head', array($this, 'replaceHeading'));
        remove_action('welcome_panel', 'wp_welcome_panel');
        add_action('welcome_panel', array($this, 'replaceWelcomePanelContent'));
        add_action('wp_dashboard_setup', array($this, 'removeMetaboxex'));
    }

    /**
     * Get the new title for wordpress title
     * 
     * @return string
     */
    public function replaceTitle($admin_title) {
        $options = $this->getOptions();
        return $options['title'];
    }

    /**
     * Print the new dashboard heading
     * 
     * @global object $current_screen
     */
    public function replaceHeading() {
        $options = $this->getOptions();
        global $current_screen;
        if (isset($current_screen) && ($current_screen->id == 'dashboard' )) {
            echo '<style type="text/css">#wpbody-content .wrap h2 { visibility: hidden; }</style>
                        <script type="text/javascript">
                                jQuery(document).ready(function($) {
                                        $("#wpbody-content .wrap h2:eq(0)").html("' . $options['heading'] . '");
                                        $("#wpbody-content .wrap h2").css("visibility","visible");
                                });
                        </script>';
        }
    }

    /**
     * Replace the welcome panel content
     * 
     * @return boolean false if options or the file does not exist
     */
    public function replaceWelcomePanelContent() {
        $options = $this->getOptions();

        if (!$options['welcome-panel']) {
            wp_welcome_panel();
            return false;
        }

        if (!file_exists($file = get_template_directory() . $options['welcome-panel'])) {
            printf('<pre>Welcome panel file "%s" does not exis</pre>', $file);
            wp_welcome_panel();
            return false;
        }
        ob_start();
        include($file );
        echo ob_get_clean();
    }

    /**
     * Remove default dashboard metaboxes
     * 
     * @global array $wp_meta_boxes
     * @return false if the option is disables
     */
    public function removeMetaboxex() {

        global $wp_meta_boxes;
        $options = $this->getOptions();

        if (!$options['remove-metaboxes'])
            return false;

        $options = $options['remove-metaboxes'];

        if (true == $options['dashboard_plugins'])
            unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);

        if (true == $options['dashboard_primary'])
            unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);

        if (true == $options['dashboard_secondary'])
            unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);

        if (true == $options['dashboard_incoming_links'])
            unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);

        if (true == $options['dashboard_quick_press'])
            unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);

        if (true == $options['dashboard_recent_drafts'])
            unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);

        if (true == $options['custom_help_widget'])
            unset($wp_meta_boxes['dashboard']['normal']['core']['custom_help_widget']);
    }

    /**
     * Get options
     * 
     * @return array
     */
    public function getOptions() {
        $default = array(
            // dashboard title
            'title' => __('Dashboard'),
            // dashboard heading
            'heading' => __('Dashboard'),
            // welcome panel file
            'welcome-panel' => '/welcome-panel.php',
            // array of dashboardd metaboxes to remove
            'remove-metaboxes' => array(
                'dashboard_plugins' => true,
                'dashboard_primary' => true,
                'dashboard_secondary' => true,
                'dashboard_incoming_links' => true,
                'dashboard_quick_press' => false,
                'dashboard_recent_drafts' => false,
                'custom_help_widget' => false,
            )
        );
        return apply_filters('Hyyan\Dashboard.options', $default);
    }

}
