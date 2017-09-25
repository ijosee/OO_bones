<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
 * | -------------------------------------------------------------------------
 * | CI Bootstrap 3 Configuration
 * | -------------------------------------------------------------------------
 * | This file lets you define default values to be passed into views
 * | when calling MY_Controller's render() function.
 * |
 * | See example and detailed explanation from:
 * | /application/config/ci_bootstrap_example.php
 */

$config['ci_bootstrap'] = array(
    
    // Site name
    'site_name' => 'Origen Organico Web',
    
    // Default page title prefix
    'page_title_prefix' => '',
    
    // Default page title
    'page_title' => '',
    
    // Default meta data
    'meta_data' => array(
        'author' => '',
        'description' => '',
        'keywords' => ''
    ),
    
    // Default scripts to embed at page head or end
    'scripts' => array(
        'head' => array(
            'assets/dist/frontend/jquery-3.2.1.min.js',
            'assets/dist/frontend/bootstrap/bootstrap.js'
        ),
        'foot' => array(
            //'assets/dist/frontend/lib.min.js',
            //'assets/dist/frontend/app.min.js',
//             'assets/dist/frontend/popper/popper.min.js',
//             'assets/dist/frontend/touch-swipe/jquery.touch-swipe.min.js',
//             'assets/dist/frontend/custom.js',
//             'assets/dist/frontend/bootstrap-carousel-swipe/bootstrap-carousel-swipe.js',
//             'assets/dist/frontend/dropdown/js/script.min.js',
//             'assets/dist/frontend/imagesloaded/imagesloaded.pkgd.min.js',
//             'assets/dist/frontend/smooth-scroll/smooth-scroll.js',
//             'assets/dist/frontend/tether/tether.min.js',
//             'assets/dist/frontend/theme/js/script.js',
//             'assets/dist/frontend/mobirise-gallery/script.js',
//             'assets/dist/frontend/mobirise-gallery/player.min.js'
        )
    ),
    
    // Default stylesheets to embed at page head
    'stylesheets' => array(
        'screen' => array(
//             'assets/dist/frontend/lib.min.css',
//             'assets/dist/frontend/app.min.css',
             'assets/dist/frontend/bootstrap/css/bootstrap.min.css',
//             'assets/dist/frontend/bootstrap/css/bootstrap-grid.min.css',
//             'assets/dist/frontend/bootstrap/css/bootstrap-reboot.min.css',
//             'assets/dist/frontend/dropdown/css/style.css',
             'assets/dist/frontend/mobirise/css/mbr-additional.css',
//             'assets/dist/frontend/tether/tether.min.css',
             'assets/dist/frontend/theme/css/style.css',
//             'assets/dist/frontend/mobirise-gallery/style.css'
        )
    ),
    
    // Default CSS class for <body> tag
    'body_class' => '',
    
    // Multilingual settings
    'languages' => array(
        // 'default' => 'en',
        // 'autoload' => array('general'),
        // 'available' => array(
        // 'en' => array(
        // 'label' => 'English',
        // 'value' => 'english'
        // ),
        // 'es' => array(
        // 'label' => 'Español',
        // 'value' => 'spanish'
        // )
        // )
    ),
    
    // Google Analytics User ID
    'ga_id' => '',
    
    // Menu items
//     'menu' => array(
//         'home' => array(
//             'name' => 'Home',
//             'url' => ''
//         ),
//         'Shop' => array(
//             'name' => 'Shop',
//             'url' => 'MailController/'
//         )
//     ),
    
    // Login page
    'login_url' => '',
    
    // Restricted pages
    'page_auth' => array(),
    
    // Email config
    'email' => array(
        'from_email' => '',
        'from_name' => '',
        'subject_prefix' => '',
        
        // Mailgun HTTP API
        'mailgun_api' => array(
            'domain' => '',
            'private_api_key' => ''
        )
    ),
    
    // Debug tools
    'debug' => array(
        'view_data' => FALSE,
        'profiler' => FALSE
    )
);

/*
 * | -------------------------------------------------------------------------
 * | Override values from /application/config/config.php
 * | -------------------------------------------------------------------------
 */
$config['sess_cookie_name'] = 'ci_session_frontend';