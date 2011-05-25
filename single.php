<?php get_header(); ?>

<div id="main">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
	 <h2 class="storytitle"><?php the_title(); ?></h2>
	  <div class="meta"><div class="meta"><span class="date"><?php the_date('d.m.Y');?></span> | <?php the_category(', ') ?> | <?php the_author() ?> </div></div>

	<div class="storycontent">
		<?php the_content(__('(more...)')); ?>
	</div>

	<div class="feedback">
		<?php //wp_link_pages(); ?>
		<?php //comments_popup_link(__('Comments (0)'), __('Comments (1)'), __('Comments (%)')); ?>
	</div>
</div>

<?php comments_template(); // Get wp-comments.php template ?>

<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>

	<!-- navigation -->
	<div id="navigation">
		<?php posts_nav_link(' ','<div class="alignright">Más nuevos &raquo;</div>','<div class="alignleft" >&laquo; Más antiguo</div>') ?>
	</div><!-- end navigation -->
</div><!-- end main -->
<?php get_sidebar(); ?>

<?php get_footer(); ?>
