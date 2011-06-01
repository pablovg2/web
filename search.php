<?php get_header(); ?>

<div id="main">

	<?php if (have_posts()) : ?>

		<h2 class="seccion">Resultados de la búsqueda</h2>

		<ul id="searchResult">
		<?php while (have_posts()) : the_post(); ?>
		
		<li <?php echo (has_post_thumbnail()? "class=\"with-photo\"":'');?>> 
			<div class="post">
				<?php if(has_post_thumbnail()): ?><a href="<?= get_permalink($post->ID); ?>"><?php the_post_thumbnail('lista', $args); ?></a><?php endif;?>
				<div class="meta"><div class="meta"><span class="date"><?php the_date('d.m.Y');?></span> | <?php the_category(', ') ?> | <?php the_author() ?> </div></div>
				<h3><a href="<?= get_permalink($post->ID); ?>"><?php the_title(); ?></a></h3>
			</div>
		</li>
			
		<?php endwhile; ?>
		</ul>
		
		<!-- navigation -->
		<div id="navigation">
			<?php posts_nav_link(' ','<div class="alignright">Más nuevos &raquo;</div>','<div class="alignleft" >&laquo; Más antiguo</div>') ?>
		</div><!-- end navigation -->

	<?php else : ?>

		<h2 class="center">No se han encontrado artículos. Pruebe con una búsqueda diferente.</h2>
		<?php get_search_form(); ?>

	<?php endif; ?>

	
</div><!-- end main -->
<?php get_sidebar(); ?>

<?php get_footer(); ?>
