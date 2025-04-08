<?php
$themePrefix = 'themeName';
//Theme Support
add_action('after_setup_theme' , 'coderitem_basic');
function coderitem_basic(){
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	load_theme_textdomain('coderlang', get_template_directory().'/lang');

	register_nav_menus(array(
            'main-menu' => __('Main Menu' , 'coderitem'),
	        'footer-menu' => __('Footer Menu' , 'coderitem'),
		));

	add_theme_support( 'woocommerce' );
}
function remove_admin_login_header() {
    remove_action('wp_head', '_admin_bar_bump_cb');
}
add_action('get_header', 'remove_admin_login_header');
//svg support
function cc_mime_types($mimes) {
 $mimes['svg'] = 'image/svg+xml';
 return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

// Enable shortcodes in text widgets
add_filter('widget_text','do_shortcode');

//stylsheet
add_action('wp_enqueue_scripts','css_script');
function css_script(){
    wp_enqueue_style('bootstrap-css',get_template_directory_uri().'/assets/css/bootstrap.min.css');
    wp_enqueue_style('owl-carousel',get_template_directory_uri().'/assets/css/owl.carousel.min.css');
    wp_enqueue_style('owl-theme',get_template_directory_uri().'/assets/css/owl.theme.default.min.css');
    wp_enqueue_style('font-awesome-cdn','https://use.fontawesome.com/releases/v5.6.3/css/all.css');
    wp_enqueue_style('normalize',get_template_directory_uri().'/assets/css/normalize.css');
    wp_enqueue_style('gfonts','https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap');
    //
    wp_enqueue_style('main-stylecss',get_template_directory_uri().'/assets/css/style.css');
    wp_enqueue_style('style',get_stylesheet_uri());
    wp_enqueue_style('responsive',get_template_directory_uri().'/assets/css/responsive.css');
}

//////////JavaScripts/////////
function coder_js() {
    //popper
    wp_register_script('popper', get_template_directory_uri() . '/assets/js/popper.js', array('jquery'),'1.1', true);
    wp_enqueue_script('popper');
    //bootstrap
    wp_register_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'),'1.1', true);
    wp_enqueue_script('bootstrap');
    //modernizr
    wp_register_script('modernizr', get_template_directory_uri() . '/assets/js/vendor/modernizr-3.5.0.min.js', array('jquery'),'1.1', true);
    wp_enqueue_script('modernizr');
    //owl-carousel
    wp_register_script('owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array('jquery'),'1.1', true);
    wp_enqueue_script('owl-carousel');
    //scripts
    wp_register_script('scripts', get_template_directory_uri() . '/assets/js/main.js', array('jquery'),'1.1', true);
    wp_enqueue_script('scripts');

}
 
add_action( 'wp_enqueue_scripts', 'coder_js' );  

/*Juery at footer -- if needed
function JQuery_footer() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, NULL, true );
    wp_enqueue_script( 'jquery' );
}
add_action( 'wp_enqueue_scripts', 'JQuery_footer' );
*/

// Post Type Examples
/*register_post_type( 'specialties',array(
    'labels' => array(
        'name' => 'Our Specialties',
        'add_new' => 'Add New Specialty'
    ),
    'public' => true,
    'supports' => array('title','editor','thumbnail',),
    'menu_icon' =>  'dashicons-buddicons-groups'
));
*/

//Requerd Files
require_once('inc/includes.php');
function coder_main_menu() {
    ?>  
    <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Blog</a></li>
        <li><a href="#"> Contact Us</a></li>
    </ul>
    <?php
}

add_shortcode('myfile','myfile');
function myfile(){
    return get_template_directory_uri().'/';
}
function theme_path(){
    return get_template_directory_uri();
}

