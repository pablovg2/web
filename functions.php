<?php

automatic_feed_links();

/**
 * Custom menus
 * This theme uses wp_nav_menu() in one location.
 */

function wego_menus() {
  register_nav_menus(
    array( 'primary' => __( 'Menú principal' ), 
    	'footer' => __( 'Enlaces del pié de página' ))
  );
}

add_action( 'init', 'wego_menus' );

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<div class="widget-title">',
		'after_title' => '</div>',
	));
    
	register_sidebar(array(
       	'name'=>'SidebarRight',
		'description' => 'Barra lateral derecha portada.',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<div class="widget-title">',
		'after_title' => '</div>'
  ));
}

/*if(function_exists('register_sidebar_widget')) {
	register_sidebar_widget('Discos', 'wego_discos_widget');
}*/

if(function_exists('wp_register_sidebar_widget')) {
	wp_register_sidebar_widget('discos-widget', 'Discos', 'wego_discos_widget', array('description' => "Últimos discos"));
	wp_register_sidebar_widget('libros-widget', 'Libros', 'wego_libros_widget', array('description' => "Últimos libros"));
	wp_register_sidebar_widget('vineta-widget', 'Viñetas', 'wego_vineta_widget', array('description' => "Viñeta"));
}

function wego_discos_widget () {
	$type = "Discos";
	include('include-discos-libros.php');
}

function wego_libros_widget ($a) {
	$type = "Discos";
	include('include-discos-libros.php');
}

function wego_vineta_widget ($a) {
	include('include-vineta.php');
}

/* new default avatar */
add_filter( 'avatar_defaults', 'wegoavatar' );

function wegoavatar ($avatar_defaults) {
	$myavatar = get_bloginfo('template_directory') . '/images/avatar.gif';
	$avatar_defaults[$myavatar] = "Wego";
    return $avatar_defaults;
}

/*function wego_scripts() {
	if(!is_admin()) {
		if(is_front_page()) {
			wp_register_script('easing', get_bloginfo('template_directory').'/js/galleryview/js/jquery.easing.1.3.js', array('jquery'),'1.3' );
			wp_register_script('timers', get_bloginfo('template_directory').'/js/galleryview/js/jquery.timers-1.2.js', array('jquery'),'1.2' );
			wp_register_script('galleryview', get_bloginfo('template_directory').'/js/galleryview/js/jquery.galleryview-3.0.min.js', array('jquery', 'easing', 'timers'),'3.0' );
			wp_enqueue_script('galleryview');
			wp_enqueue_style('galleryview', get_bloginfo('template_directory').'/js/galleryview/css/jquery.galleryview-3.0.css');
		}
	}
}

add_action('init', 'wego_scripts');*/

// Funciones de agenda
/*
 * Detectar si un artículo tiene asignado un evento
 */                                                                                                                                                                                                       
// comprobar que el plugin events management extended está activado                                                                                                                                       
if(function_exists('eme_if_shortcode')) {                                                                                                                                                                 
       function wego_post_event($content) {                                                                                                                                                               
          global $wpdb;                                                                                                                                                                                   
          $post_url=$_SERVER['REQUEST_URI'];                                                                                                                                                              
          if(substr($post_url, -1)=='/')                                                                                                                                                                  
                       $post_url = substr($post_url, 0, -1);                                                                                                                                              
                                                                                                                                                                                                          
          $events_table = $wpdb->prefix.EVENTS_TBNAME;                                                                                                                                                    
          $sql = "SELECT event_id from $events_table WHERE event_url LIKE '%".$post_url."' OR event_url LIKE '%".$post_url."/'                                                                            
                          ORDER BY event_start_date ASC";                                                                                                                                                 
                                                                                                                                                                                                          
          $events = $wpdb->get_results($sql);                                                                                                                                                             
          if($events) {                                                                                                                                                                                   
               foreach($events as $e)                                                                                                                                                                     
                       $content .=" [display_single_event id=".$e->event_id."] ";
          }
          
          return $content;
       }
       
       add_filter('the_content', 'wego_post_event', 1);
}

/**
 * TODO Shortcode para lugar 
 */

/**
 * Thumbnails e imagen destacada
 */ 
if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
	add_theme_support( 'post-thumbnails' );
	//set_post_thumbnail_size( 150, 150, true ); // Normal post thumbnails
	add_image_size( 'slider', 500, 300, true ); // Permalink thumbnail size
	add_image_size( 'lista', 45, 45, true );
	add_image_size( 'disco-libro', 150, 200, false );
	add_image_size( 'vineta', 295, 200, false );
}

?>
