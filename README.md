# [Wordpress Dashboard ](https://github.com/hyyan/dashboard/)

[![project status](http://stillmaintained.com/hyyan/dashboard.png)](http://stillmaintained.com/hyyan/dashboard)
[![Latest Stable Version](https://poser.pugx.org/hyyan/dashboard/v/stable.svg)](https://packagist.org/packages/hyyan/dashboard)
[![Total Downloads](https://poser.pugx.org/hyyan/dashboard/downloads.svg)](https://packagist.org/packages/hyyan/dashboard)
[![License](https://poser.pugx.org/hyyan/dashboard/license.svg)](https://packagist.org/packages/hyyan/dashboard)

Wordpress plugin to let themes customize the dashboard in their own way

## Features

1. Changing Dashboard Title
2. Changing Dashboard Heading
3. Changing Welcome Panel Content Or Disable it 
4. Changing version 
5. Changing Copyright 
6. Removing selected dashboard metaboxes (default ones only)
7. Removing adminbar menus
8. Removing menu pages
9. Disable theme switch


## How to install

### Classical way
    
1. Download the plugin as zip archive and then upload it to your wordpress plugins folder and 
extract it there.
2. Activate the plugin from your admin panel

### Composer way

1. run composer command : ``` composer require hyyan/dashboard```

## How to use

### Plugin configutaion

The plugin comes with following configuration as default :

```php
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
        'welcome_panel' => false,
    ),
    // diable the ability to switch themes 
    'disable-theme-switch' => true,
    // replace wordpress version
    'version' => '',
    // replace wordpress copyright
    'copyright' => '',
    // adminbar menus to remove
    'remove-adminbar-menus' => array(
        'wp-logo',
        'about',
        'wporg',
        'documentation',
        'support-forums',
        'feedback',
        'updates',
        'themes'
    ),
    // menu pages to remove
    'remove-menus' => array()
);
```

You can override the default configuration using ```add_filter``` function like 
in the following example :

```php
// in the your theme's functions.php file

add_filter('Hyyan\Dashboard.options', function($default) {

    $default['title'] = 'This is a test';
    $default['heading'] = 'This is heading';
    $default['remove-metaboxes'] = array_merge($default['remove-metaboxes'], array(
        'dashboard_quick_press' => false
    ));

    return $default;
});
```

## Contributing

Everyone is welcome to help contribute and improve this plugin. There are several 
ways you can contribute:

* Reporting issues (please read [issue guidelines](https://github.com/necolas/issue-guidelines))
* Suggesting new features
* Writing or refactoring code
* Fixing [issues](https://github.com/hyyan/dashboard/issues)

