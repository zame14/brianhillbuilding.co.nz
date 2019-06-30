<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
require_once('modal/class.Base.php');
require_once('modal/class.Service.php');
require_once('modal/class.Project.php');
add_action( 'wp_enqueue_scripts', 'p_enqueue_styles');
function p_enqueue_styles() {
    wp_enqueue_style( 'bootstrap-css', get_stylesheet_directory_uri() . '/css/bootstrap.min.css?' . filemtime(get_stylesheet_directory() . '/css/bootstrap.min.css'));
    wp_enqueue_style( 'font-awesome', get_stylesheet_directory_uri() . '/css/font-awesome.min.css?' . filemtime(get_stylesheet_directory() . '/css/font-awesome.css'));
    wp_enqueue_style( 'google_font', 'https://fonts.googleapis.com/css?family=Quicksand:400,700|Raleway:400,700&display=swap');
    wp_enqueue_style( 'slick', get_stylesheet_directory_uri() . '/slick-carousel/slick/slick.css');
    wp_enqueue_style( 'understrap-theme', get_stylesheet_directory_uri() . '/style.css?' . filemtime(get_stylesheet_directory() . '/style.css'));
    wp_enqueue_script('bootstrap-js', get_stylesheet_directory_uri() . '/js/bootstrap.min.js?' . filemtime(get_stylesheet_directory() . '/js/bootstrap.min.js'), array('jquery'));
    wp_enqueue_script('understap-theme', get_stylesheet_directory_uri() . '/js/theme.js?' . filemtime(get_stylesheet_directory() . '/js/theme.js'), array('jquery'));
    wp_enqueue_script( 'slick', get_stylesheet_directory_uri() . '/slick-carousel/slick/slick.js');
}
function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );
add_image_size( 'feature', 600, 354, true);
add_image_size( 'gallery', 1200, 600, true);
function dg_remove_page_templates( $templates ) {
    unset( $templates['page-templates/blank.php'] );
    unset( $templates['page-templates/right-sidebarpage.php'] );
    unset( $templates['page-templates/both-sidebarspage.php'] );
    unset( $templates['page-templates/empty.php'] );
    unset( $templates['page-templates/fullwidthpage.php'] );
    unset( $templates['page-templates/left-sidebarpage.php'] );
    unset( $templates['page-templates/right-sidebarpage.php'] );

    return $templates;
}
add_filter( 'theme_page_templates', 'dg_remove_page_templates' );
add_action('admin_init', 'my_general_section');
function my_general_section() {
    add_settings_section(
        'my_settings_section', // Section ID
        'Custom Website Settings', // Section Title
        'my_section_options_callback', // Callback
        'general' // What Page?  This makes the section show up on the General Settings Page
    );
    add_settings_field( // Option 1
        'phone', // Option ID
        'Phone', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed (General Settings)
        'my_settings_section', // Name of our section
        array( // The $args
            'phone' // Should match Option ID
        )
    );
    add_settings_field( // Option 1
        'phone1', // Option ID
        'Jono Hill Phone Number', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed (General Settings)
        'my_settings_section', // Name of our section
        array( // The $args
            'phone1' // Should match Option ID
        )
    );
    add_settings_field( // Option 1
        'phone2', // Option ID
        'Brian Hill Phone Number', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed (General Settings)
        'my_settings_section', // Name of our section
        array( // The $args
            'phone2' // Should match Option ID
        )
    );
    add_settings_field( // Option 1
        'mobile', // Option ID
        'Mobile Number', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed (General Settings)
        'my_settings_section', // Name of our section
        array( // The $args
            'mobile' // Should match Option ID
        )
    );
    add_settings_field( // Option 2
        'email', // Option ID
        'Email', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'my_settings_section', // Name of our section (General Settings)
        array( // The $args
            'email' // Should match Option ID
        )
    );

    register_setting('general','phone', 'esc_attr');
    register_setting('general','phone1', 'esc_attr');
    register_setting('general','phone2', 'esc_attr');
    //register_setting('general','mobile', 'esc_attr');
    register_setting('general','email', 'esc_attr');
}

function my_section_options_callback() { // Section Callback
    echo '';
}

function my_textbox_callback($args) {  // Textbox Callback
    $option = get_option($args[0]);
    echo '<input type="text" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" />';
}

function formatPhoneNumber($ph) {
    $ph = str_replace('(', '', $ph);
    $ph = str_replace(')', '', $ph);
    $ph = str_replace(' ', '', $ph);
    $ph = str_replace('+64', '0', $ph);

    return $ph;
}
function getImageID($image_url)
{
    global $wpdb;
    $sql = 'SELECT ID FROM ' . $wpdb->prefix . 'posts WHERE guid = "' . $image_url . '"';
    $result = $wpdb->get_results($sql);

    return $result[0]->ID;
}
function template_widgets_init()
{
    register_sidebar( array(
        'name'          => __( 'Footer Widget', 'understrap' ),
        'id'            => 'footerwidget',
        'description'   => 'Widget area in the footer',
        'before_widget'  => '<div class="footer-widget-wrapper">',
        'after_widget'   => '</div><!-- .footer-widget -->',
        'before_title'   => '<h3 class="widget-title">',
        'after_title'    => '</h3>',
    ) );
}
add_action( 'widgets_init', 'template_widgets_init' );
add_action('init', 'bhb_register_menus');
function bhb_register_menus() {
    register_nav_menus(
        Array(
            'footer-menu' => __('Footer Menu'),
        )
    );
}
function getService() {
    $services = Array();
    $posts_array = get_posts([
        'post_type' => 'service',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'menu_order',
        'order' => 'asc'
    ]);
    foreach ($posts_array as $post) {
        $service = new Service($post);
        $services[] = $service;
    }
    return $services;
}
function getProjects($limit) {
    $projects = Array();
    $posts_array = get_posts([
        'post_type' => 'project',
        'post_status' => 'publish',
        'numberposts' => $limit,
        'orderby' => 'menu_order'
    ]);
    foreach ($posts_array as $post) {
        $project = new Project($post);
        $projects[] = $project;
    }
    return $projects;
}
function services_shortcode()
{
    $class1 = '';
    $class2 = '';
    $i = 1;
    $html = '
    <div class="row">';
    foreach (getService() as $service)
    {
        if($i > 2) {
            $class1 = 'push';
            $class2 = 'pull';
        }
        $imageid = getImageID($service->getFeatureImage());
        $img = wp_get_attachment_image_src($imageid, 'feature');
        $html .= '
        <div class="col-12 col-sm-6 service-panel">
            <div class="inner-wrapper">
                <div class="image-wrapper ' . $class1 . '">
                    <img src="' . $img[0] . '" alt="' . $service->getTitle() . '" />
                </div>
                <div class="content-wrapper ' . $class2 . '">
                    <div class="content-inner-wrapper">
                        <div class="title">
                            ' . $service->getTitle() . '
                        </div>
                        <div class="snippet">
                            ' . $service->getSnippet() . '
                        </div>
                        <a href="' . $service->link() . '">Read more</a>
                    </div>
                </div>
            </div>
        </div>';
        $i++;
    }

    $html .= '
    </div>';
    return $html;
}
add_shortcode('services', 'services_shortcode');

function projects_shortcode($atts)
{
    $html = '
    <div class="col-12">
        <h2>Projects</h2>
    </div>';
    foreach (getProjects($atts['limit']) as $project)
    {
        $imageid = getImageID($project->getFeatureImage());
        $img = wp_get_attachment_image_src($imageid, 'feature');
        $html .= '
        <div class="col-12 col-sm-6 col-md-4 project-tile">
            <a href="' . $project->link() . '">
                <div class="image-wrapper">
                    <img src="' . $img[0] . '" alt="' . $project->getTitle() . '" />
                </div>
                <div class="content-wrapper">
                    <div class="title">
                        ' . $project->getTitle() . '
                    </div>
                    <div class="category">
                        ' . $project->getCategory() . '
                    </div>
                </div>
            </a>
        </div>';
    }
    $html .= '
    <div class="col-12">
        <a href="' . get_page_link(17) . '" class="view-more">View more projects</a>
    </div>';

    return $html;
}
add_shortcode('projects', 'projects_shortcode');

function projectsModule_shortcode($atts)
{
    $html = '
    <div class="row category-nav-wrapper">
        <div class="col-12">
            <ul>
                <li><a href="javascript:;" onclick="filterCategory(0)">All</a></li>
                <li><a href="javascript:;" onclick="filterCategory(1)">Residential</a></li>
                <li><a href="javascript:;" onclick="filterCategory(2)">Rural</a></li>
                <li><a href="javascript:;" onclick="filterCategory(3)">Concrete</a></li>
                <li><a href="javascript:;" onclick="filterCategory(4)">Light Commercial</a></li>
            </ul>
        </div>
    </div>
    <div class="project-tiles-wrapper">
        <div class="row inner-wrapper justify-content-center">';
        foreach (getProjects($atts['limit']) as $project)
        {
            $imageid = getImageID($project->getFeatureImage());
            $img = wp_get_attachment_image_src($imageid, 'feature');
            $html .= '
            <div class="col-12 col-sm-6 col-md-4 project-tile">
                <a href="' . $project->link() . '">
                    <div class="image-wrapper">
                        <img src="' . $img[0] . '" alt="' . $project->getTitle() . '" />
                    </div>
                    <div class="content-wrapper">
                        <div class="title">
                            ' . $project->getTitle() . '
                        </div>
                        <div class="category">
                            ' . $project->getCategory() . '
                        </div>
                    </div>
                </a>
            </div>';
        }
        $html .= '
        </div>
    </div>';

    return $html;
}
add_shortcode('projectsModule', 'projectsModule_shortcode');

if(isset($_REQUEST['ajax']) && $_REQUEST['ajax'] == "filter_category") {
    $html = '';
    $filter_category = '';
    if($_REQUEST['categoryid'] > 0) {
        // filter results
        switch ($_REQUEST['categoryid']) {
            case 1:
                // Residential
                $filter_category = 'Residential';
                break;
            case 2:
                // Rural
                $filter_category = 'Rural';
                break;
            case 3:
                // Concrete
                $filter_category = 'Concrete';
                break;
            case 4:
                // Light Commercial
                $filter_category = 'Light Commercial';
                break;
        }
        $hasProjects = false;
        $html .= '<div class="row inner-wrapper justify-content-center">';
        foreach (getProjects(-1) as $project) {
            if($filter_category == $project->getCategory()) {
                $hasProjects = true;
                $imageid = getImageID($project->getFeatureImage());
                $img = wp_get_attachment_image_src($imageid, 'feature');
                $html .= '
                <div class="col-12 col-sm-6 col-md-4 project-tile">
                    <a href="' . $project->link() . '">
                        <div class="image-wrapper">
                            <img src="' . $img[0] . '" alt="' . $project->getTitle() . '" />
                        </div>
                        <div class="content-wrapper">
                            <div class="title">
                                ' . $project->getTitle() . '
                            </div>
                            <div class="category">
                                ' . $project->getCategory() . '
                            </div>
                        </div>
                    </a>
                </div>';
            }
        }
        if(!$hasProjects)
        {
            $html .= '
            <div class="col-12 no-project">
                <p>Sorry, no projects in this category.  Check back again soon.</p>
            </div>';
        }
        $html .= '</div>';
    } else {
        $html .= '<div class="row inner-wrapper justify-content-center">';
        foreach (getProjects(-1) as $project) {
        $imageid = getImageID($project->getFeatureImage());
        $img = wp_get_attachment_image_src($imageid, 'feature');
        $html .= '
            <div class="col-12 col-sm-6 col-md-4 project-tile">
                <a href="' . $project->link() . '">
                    <div class="image-wrapper">
                        <img src="' . $img[0] . '" alt="' . $project->getTitle() . '" />
                    </div>
                    <div class="content-wrapper">
                        <div class="title">
                            ' . $project->getTitle() . '
                        </div>
                        <div class="category">
                            ' . $project->getCategory() . '
                        </div>
                    </div>
                </a>
            </div>';
        }
        $html .= '</div>';
    }
    echo $html;
    exit;
}