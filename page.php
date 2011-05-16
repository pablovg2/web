<?php
get_header(); ?>
	
<div id="main">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
	 <h2 class="storytitle"><?php the_title(); ?></h2>
	 
	<div class="storycontent">
		<?php the_content(__('(more...)')); ?>
	</div>
</div>

<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>

<?php posts_nav_link(' &#8212; ', __('&laquo; Newer Posts'), __('Older Posts &raquo;')); ?>
</div><!-- end main -->
<?php get_sidebar(); ?>
	

<?php get_footer(); ?>
