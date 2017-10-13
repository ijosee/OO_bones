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
        'site_name' => 'Admin Panel',
        
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
                        'assets/dist/admin/jquery.js',
                        'assets/dist/admin/adminlte.min.js',
                        'assets/dist/admin/lib.min.js',
                        'assets/dist/admin/app.min.js',
                        'assets/dist/admin/jquery-ui/jquery-ui.js',
                        'assets/dist/admin/bootstrap/bootstrap.js',
                        // uncomment for PLUGINS USER FRIENDLY
                        'assets/dist/admin/fastclick.js',
                        'assets/dist/admin/jquery.slimscroll.js',
                        // needed
                        'assets/dist/admin/moment/moment.js',
                        'assets/dist/admin/bootstrap-datepicker/dist/js/daterangepicker.js',
                        'assets/dist/admin/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
                        'assets/dist/admin/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js'
                
                ),
                'foot' => array(
                        // // Uncoment this get charts
                        //'assets/dist/admin/jvectormap/jquery-jvectormap-1.2.2.min.js',
                        //'assets/dist/admin/jvectormap/jquery-jvectormap-world-mill-en.js',
                        //'assets/dist/admin/jquery-sparkline/dist/jquery.sparkline.min.js',
                        //'assets/dist/admin/morris/raphael.js',
                        //'assets/dist/admin/morris/morris.js',
                        //'assets/dist/admin/chart/Chart.js'
                    // demo propuses
                    // 'assets/dist/admin/demo.js',
                    // 'assets/dist/admin/dashboard.js'
                
                )
        ),
        
        // Default stylesheets to embed at page head
        'stylesheets' => array(
                'screen' => array(
                        'assets/dist/admin/adminlte.min.css',
                        'assets/dist/admin/lib.min.css',
                        'assets/dist/admin/app.min.css',
                        'assets/dist/admin/bootstrap/bootstrap.min.css',
                        'assets/dist/admin/_all-skins.min.css',
                        // fonts
                        'assets/dist/admin/font-awesome.css',
                        'assets/dist/admin/ionicons/css/ionicons.css',
                        // datepicker
                        'assets/dist/admin/bootstrap-datepicker/dist/css/bootstrap-datepicker.css',
                        'assets/dist/admin/bootstrap-datepicker/dist/css/daterangepicker.css',
                        // calendar
                        'assets/dist/admin/fullcalendar/fullcalendar.min.css',
                        // 'assets/dist/admin/fullcalendar/fullcalendar.print.min.css',
                        // crea conflicto con full calendar.min.css
                        
                        // select_2
                        'assets/dist/admin/select_2/css/select2.css',
                        'assets/dist/admin/pos/admin_pos.css'
                    
                    // 'assets/dist/admin/jvectormap/jquery-jvectormap-1.2.2.css',
                    // 'assets/dist/admin/morris/morris.css',
                    // 'assets/dist/admin/lib.min.css',
                    // 'assets/dist/admin/app.min.css',
                
                )
        ),
        
        // Default CSS class for <body> tag
        'body_class' => '',
        
        // Multilingual settings
        'languages' => array(),
        
        // Menu items
        'menu' => array(
                'home' => array(
                        'name' => 'Home',
                        'url' => 'homecontroller',
                        'icon' => 'fa fa-home'
                ),
                'customer' => array(
                        'name' => 'Clientes',
                        'url' => 'customercontroller',
                        'icon' => 'fa fa-user',
                        'children' => array(
                                'Listar' => 'customercontroller'
                            // ,'Crear' => 'customer/create'
                        )
                ),
                'employee' => array(
                        'name' => 'Empleado',
                        'url' => 'employeecontroller',
                        'icon' => 'fa fa-user-circle',
                        'children' => array(
                                'Listar' => 'employeecontroller'
                            // ,'Crear' => 'customer/create'
                        )
                ),
                'user' => array(
                        'name' => 'Usuarios',
                        'url' => 'usercontroller',
                        'icon' => 'fa fa-users',
                        'children' => array(
                                'Listar' => 'usercontroller',
                                'Crear' => 'user/create',
                                'Grupos de usuarios' => 'user/group'
                        )
                ),
                'products' => array(
                        'name' => 'Productos',
                        'url' => 'productscontroller',
                        'icon' => 'fa fa-truck',
                        'children' => array(
                                'Listar' => 'productcontroller',
                                'Categorias producto' => 'product_category'
                        )
                ),
                // 'customer_color' => array(
                // 'name' => 'CC',
                // 'url' => 'customer_color',
                // 'icon' => 'fa fa-user',
                // 'children' => array(
                // 'Listar' => 'customer_color',
                // 'Crear' => 'customer_color/create'
                // )
                // ),
                'panel' => array(
                        'name' => 'Usuarios Admin',
                        'url' => 'panelcontroller',
                        'icon' => 'fa fa-cog',
                        'children' => array(
                                'Listar' => 'panelcontroller/admin_user',
                                'Crear ' => 'panelcontroller/admin_user_create',
                                'Grupos Usuarios Admin' => 'panelcontroller/admin_user_group'
                        )
                ),
                'util' => array(
                        'name' => 'Utilidades',
                        'url' => 'utilcontroller',
                        'icon' => 'fa fa-cogs',
                        'children' => array(
                                'Versión de la base de datos' => 'utilcontroller/list_db'
                        )
                ),
                'logout' => array(
                        'name' => 'Salir',
                        'url' => 'panelcontroller/logout',
                        'icon' => 'fa fa-sign-out'
                )
        ),
        
        // Login page
        'login_url' => 'admin/login',
        
        // Restricted pages
        'page_auth' => array(
                'user/create' => array(
                        'webmaster',
                        'admin',
                        'manager'
                ),
                'user/group' => array(
                        'webmaster',
                        'admin',
                        'manager'
                ),
                'panel' => array(
                        'webmaster'
                ),
                'panel/admin_user' => array(
                        'webmaster'
                ),
                'panel/admin_user_create' => array(
                        'webmaster'
                ),
                'panel/admin_user_group' => array(
                        'webmaster'
                ),
                'util' => array(
                        'webmaster'
                ),
                'util/list_db' => array(
                        'webmaster'
                ),
                'util/backup_db' => array(
                        'webmaster'
                ),
                'util/restore_db' => array(
                        'webmaster'
                ),
                'util/remove_db' => array(
                        'webmaster'
                )
        ),
        
        // AdminLTE settings
        'adminlte' => array(
                'body_class' => array(
                        'webmaster' => 'skin-red',
                        'admin' => 'skin-purple',
                        'manager' => 'skin-black',
                        'staff' => 'skin-blue'
                )
        ),
        
        // Useful links to display at bottom of sidemenu
        'useful_links' => array(
                array(
                        'auth' => array(
                                'webmaster',
                                'admin',
                                'manager',
                                'staff'
                        ),
                        'name' => 'Frontend Website',
                        'url' => '',
                        'target' => '_blank',
                        'color' => 'text-aqua'
                ),
                array(
                        'auth' => array(
                                'webmaster',
                                'admin'
                        ),
                        'name' => 'API Site',
                        'url' => 'api',
                        'target' => '_blank',
                        'color' => 'text-orange'
                )
        ),
        
        // Marketing
        'menu_marketing' => array(
                'Facebook' => array(
                        'name' => 'Facebook',
                        'url' => 'facebook',
                        'icon' => 'fa fa-facebook',
                        'children' => array(
                                'Publicar' => 'facebook/post',
                                'Crear evento' => 'facebook/create_event'
                        )
                ),
                'Google' => array(
                        'name' => 'Google',
                        'url' => 'google',
                        'icon' => 'fa fa-google',
                        'children' => array(
                                'Publicar' => 'googlePlus/post',
                                'Crear evento' => 'googlePlus/create_event'
                        )
                )
        ),
        
        // Mailing
        'mail_customer' => array(
                'Usar MailChimp' => array(
                        'name' => 'Usar MailChimp',
                        'url' => 'mailcontroller',
                        'icon' => 'fa fa-plane'
                ),
                'Crear una cita' => array(
                        'name' => 'Crear una cita',
                        'url' => 'calendarcontroller',
                        'icon' => 'fa fa-calendar'
                ),
                'POS' => array(
                        'name' => 'POS',
                        'url' => 'poscontroller',
                        'icon' => 'fa fa-money'
                )
        ),
        
        // Debug tools
        'debug' => array(
                'view_data' => FALSE,
                'profiler' => TRUE
        )
);

/*
 * | -------------------------------------------------------------------------
 * | Override values from /application/config/config.php
 * | -------------------------------------------------------------------------
 */
$config['sess_cookie_name'] = 'ci_session_admin';