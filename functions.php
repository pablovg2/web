<?php
automatic_feed_links();

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<div class="widget-title">',
		'after_title' => '</div>',
));

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

// Thumbnails e imagen destacada
if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
	add_theme_support( 'post-thumbnails' );
	//set_post_thumbnail_size( 150, 150, true ); // Normal post thumbnails
	add_image_size( 'slider', 500, 300, true ); // Permalink thumbnail size
	add_image_size( 'lista', 45, 45, true );
}
?>
