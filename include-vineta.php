<ul><li class="widget"><div class="widget-title">Viñeta</div>
<ul class="vineta">
		<?php $que = new WP_Query('category_name="vineta-literatura"&posts_per_page=1&orderby="date"'); // &paged
		?>
		<?php //query_posts(array('category__not_in' => array(get_cat_ID('Breve')), 'posts_per_page' => 10, 'orderby'=> 'date'));
		  $d=0; 
		  while ($que->have_posts()): $que->the_post();
		  	$d++; 
		?>
		<li <?php echo ($d==1? "class=\"first\"": '');?>><a href="<?= get_permalink($post->ID); ?>"><p><?= get_the_post_thumbnail($post->ID, 'vineta'); ?></a>
			<!-- <strong><a href="<?= get_permalink($post->ID); ?>"><?php echo get_post_meta(get_the_ID(), "disco-libro-titulo", true); ?></a></strong><br/>
			<small><?php echo get_post_meta(get_the_ID(), "disco-libro-autor", true);?></small></p> -->		
		</li>
		<?php endwhile;?>
		</ul>
</li></ul>