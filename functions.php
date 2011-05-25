<?php
automatic_feed_links();

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
}

function wego_discos_widget () {
	$type = "Discos";
	include('include-discos-libros.php');
}

function wego_libros_widget ($a) {
	$type = "Discos";
	include('include-discos-libros.php');
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
}

/**
 * Widget para libro o discos
 */
/*// Cuando se inicializa el widget llamaremos al metodo register
add_action( "widgets_init", array( "widgetWegoDiscosLibros", "register" ) );

// Cuando se active el plugin se llamara al metodo activate de la clase Widget_ultimosPostPorAutor
// donde añadiremos los argumentos por defecto para que funcione el plugin
register_activation_hook( __FILE__, array( 'widgetWegoDiscosLibros', 'activate' ) );

// Cuando se desactive el plugin se llamara al metodo desactivate de la clase Widget_ultimosPostPorAutor
// donde se eliminaran los argumentos anteriormente guardados, para tener una DB limpia
register_deactivation_hook( __FILE__, array( 'widgetWegoDiscosLibros', 'deactivate' ) );

class widgetWegoDiscosLibros {
	function activate() {
        // Argumentos y sus valores por defecto
        $aData = array( 'NUM_POSTS' => 5,
                        'TYPE_POSTS' => 1 );

        // Comprobamos si existe opciones para este Widget, si no existe las creamos por el contrario actualizamos
        if( ! get_option( 'wegoWidget' ) )
            add_option( 'wegoWidget' , $aData );
        else
            update_option( 'wegoWidget' , $data);
    }

    function deactivate() {
        // Cuando se desactive el plugin se eliminaran todas las filas de la DB que le sirven a este plugin
        delete_option( 'wegoWidget' );
    }
    // Panel de control que se mostrara abajo de nuestro Widget en el panel de configuración de Widgets
    function control() {
    	$aData = get_option( 'wegoWidget' );

        // Mostraremos un formulario en HTML para modificar los valores del Widget
        ?>
            <p>
                <label>Número de entradas:</label>
                <input name="wegoWidget_NUM_POSTS" type="text" value="<?php echo $aData['NUM_POSTS']; ?>" />
            </p>
            <p>
                <label>Tipo de las entradas:</label>
                <select name="wegoWidget_TYPE_POSTS">
                	<option value="1" <?php echo ($aData['NUM_POSTS']==1? "selected=\"selected\"": '') ?>>Discos</option>
                	<option value="2" <?php echo ($aData['NUM_POSTS']==2? "selected=\"selected\"": '') ?>>Libros</option>
                </select>
            </p>
        <?php

        // Si se ha enviado uno de los valores del formulario por POST actualizaremos los datos
        if( isset( $_POST['wegoWidget_NUM_POSTS'] ) ) {
            $aData['NUM_POSTS'] = attribute_escape( $_POST['wegoWidget_NUM_POSTS'] );
            $aData['TYPE_POSTS'] = attribute_escape( $_POST['wegoWidget_TYPE_POSTS'] );

            update_option( 'wegoWidget', $aData );
        }
    }

    // Metodo que se llamara cuando se visualize el Widget en pantalla
    function widget($args) {
        echo $args["before_widget"];
        echo $args["before_title"] . "Editores de " . get_option( "blogname" ) . $args["after_title"];

        echo "Hola soy tu Widget";
        echo $args["after_widget"];
    }

    // Metodo que se llamara cuando se inicialice el Widget
    function register() {
        // Incluimos el widget en el panel control de Widgets
        register_sidebar_widget( "Discos / Libros", array( "widgetWegoDiscosLibros", "widget" ) );

        // Formulario para editar las propiedades de nuestro Widget
        register_widget_control( "Discos / Libros", array( "widgetWegoDiscosLibros", "control" ) );
    }
}*/
?>
