<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

	<style type="text/css" media="screen">
		@import url( <?php bloginfo('stylesheet_url'); ?> );
	</style>

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" />
	<?php wp_get_archives('type=monthly&format=link'); ?>
	<?php //comments_popup_script(); // off by default ?>
	<!-- more conditional script -->
	<?php 
	wp_deregister_script('jquery');
    wp_enqueue_script('jquery', get_bloginfo('template_directory').'/js/jquery-1.5.2.min.js', false, '1.5.2');
    wp_enqueue_script('wego', get_bloginfo('template_directory').'/js/scripts.js', array('jquery'), '1.0');
	if(is_front_page() || is_archive()) {
		wp_register_script('easing', get_bloginfo('template_directory').'/js/lofslidernews/js/jquery.easing.js', array('jquery'),'1.3' );
		wp_register_script('lofslidernews', get_bloginfo('template_directory').'/js/lofslidernews/js/script.js', array('jquery', 'easing'),'1.0' );
		
		wp_enqueue_script('lofslidernews');
		wp_enqueue_style('slider', get_bloginfo('template_directory').'/css/slider.css');
	}
	?>
	<!--[if IE]> 
	<style type="text/css" media="screen">
		input, #container, textarea, .eme-event-item, 
		#footer, #header, #navbar { behavior: url(<?php bloginfo('template_directory');?>/css/ie-css3.htc);}
	</style>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="wrapper">	


<!-- zona publicidad externa der -->
	<div id="subWrapper">
		<!-- zona publicidad externa izq -->
		<!-- <div id="earleft"> 
			<a id="vodafone-brand-izquierda" class="enlaceExterno" target="_blank" href="http://ad.uk.doubleclick.net/clk;239775971;62607377;b">
				<img alt="" src="http://ficheros.publico-estaticos.es/resources/branddays/oreja-derecha-nokia-vodafone.jpg">
			</a> 
		</div>  --> <!-- end zona publicidad externa izq -->
		<!-- zona publicidad externa der -->
	 	<!-- <div id="earright">
			<a id="vodafone-brand-derecha" class="enlaceExterno" target="_blank" href="http://ad.uk.doubleclick.net/clk;239775971;62607377;b">
				<img alt="" src="http://ficheros.publico-estaticos.es/resources/branddays/oreja-derecha-nokia-vodafone.jpg">
			</a>
		</div> --> <!-- zona publicidad externa der -->
	
		<!-- container -->
		<div id="container">
			<!-- header -->
			<div id="header">
				<!-- logo -->
				<div class="logo"><h1><a href="<?php bloginfo('url'); ?>/"><span><?php bloginfo('name'); ?></span></a></h1></div>
				<div class="bar">
					<div class="publizone">
						<!-- <a href="http://www.fiberfib.com"><img src="http://localhost/~rafa/wp-wego/wp-content/themes/wego/images/banner-prueba.gif" /></a>-->
					</div>
					<!-- social icons -->
					<div id="searchbar" class="bar">
            			<?php get_search_form(); ?>
						<ul class="socialicons">
							<li><a class="icon rss" href="<?php bloginfo('rss2_url'); ?>" title="RSS"><span>RSS</span></a></li>
            				<li><a class="icon flickr" href="http://www.flickr.com/photos/revistawego/" title="Flickr"><span>Flickr</span></a></li>
            				<li><a class="icon twitter" href="http://twitter.com/revistawego" title="Twitter"><span>Twitter</span></a></li>
            				<li><a class="icon tuenti" href="http://www.tuenti.com/#m=Page&amp;func=index&amp;page_key=1_1678_60565376" title="Tuenti"><span>Tuenti</span></a></li>
            				<li><a class="icon facebook" href="http://www.facebook.com/pages/Revista-WEGO/175276217486" title="Facebook"><span>Facebook</span></a></li>
            			</ul>
					</div>
				</div>
				<!-- navigation -->
				<div id="navbar">
					<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?> 
				</div><!-- end navigation -->
			</div><!-- end header -->
			
			<!-- content -->
			<div id="content">