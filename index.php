<?php get_header(); ?>
<?php 
	$pagi = (get_query_var('paged')) ? get_query_var('paged') : 1;
?>
<div id="main">
	<!-- slideshow -->
	<?php if($pagi==1) get_template_part('include', 'slider'); ?>
	<!-- end slideshow -->
	
	<?php $args = array(
			"post__not_in" =>get_option("sticky_posts"), 
			'caller_get_posts' => 1, 
			'paged' => $pagi
			//'category__not_in' => array(get_cat_ID('Breve'), get_cat_ID('New Strip on the Blog'), get_cat_ID('Discos'), get_cat_ID('El rincón'))
		);
		query_posts($args); 
	?>
<?php $c = 0; 
	if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php if($c<2 && $pagi==1): ?><!-- primera zona -->
		<div class="zone1">
	 		<h3 class="storytitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
			<div class="meta"><span class="date"><?php the_time('d.m.Y');?></span> | <?php the_category(', ') ?> | <?php the_author() ?> | <?php comments_popup_link(__('0'), __('1'), __('%'), 'comments'); ?></div>

			<div class="storycontent">
				<?php the_excerpt(); ?>
			</div>
			<?php //comments_template(); // Get wp-comments.php template ?>
		</div><!-- end primera zona -->
		<?php else: // segunda zona?> 
			<?php if($c%2==0):?>
				<!-- segunda zona -->
				<div class="zone2">
			<?php endif;?>
				<div class="zone2-<?php echo ($c%2==0? 'left': 'right');?>">
	 				<h3 class="storytitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
					<div class="meta"><span class="date"><?php
                    the_time('d.m.Y', '', '') ?></span> | <?php the_category(', ') ?> | <?php comments_popup_link(__('0'), __('1'), __('%'), 'comments'); ?></div>
					
					<?php $args = array('title'=> get_the_title(), 'class'=>'content-img'); ?>
					<div class="storycontent">
						<?php if ( has_post_thumbnail()) : ?>
   							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
   							<?php the_post_thumbnail('thumbnail', $args); ?>
   							</a>
 						<?php endif; ?>
						<?php echo (get_post_meta(get_the_ID(), "portada-texto-corto", true)!=''? get_post_meta(get_the_ID(), "portada-texto-corto", true) : get_the_excerpt()); ?>
					</div>
				</div><!-- end zone2-<?php echo ($c%2==0? 'left': 'right')?> -->
			<?php if($c%2!=0): ?>
				</div> <!-- fin segunda zona -->
			<?php endif;?>
		<?php endif; //fin segunda zona?> 

<?php $c++; endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>

	<!-- navigation -->
	<div id="navigation">
		<?php posts_nav_link(' ','<div class="alignright">Más nuevos &raquo;</div>','<div class="alignleft" >&laquo; Más antiguo</div>') ?>
	</div><!-- end navigation -->
</div><!-- end main -->
<?php get_sidebar('right'); ?>
<?php get_sidebar(); ?>

<?php get_footer(); ?>
