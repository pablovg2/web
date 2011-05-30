<ul><li class="widget"><div class="widget-title"><?php echo $type; ?></div>
<ul class="<?php echo strtolower($type); ?>">
		<?php $query_discos = new WP_Query('category_name="'.$type.'"&posts_per_page=4&orderby="date"'); // &paged?>
		<?php //query_posts(array('category__not_in' => array(get_cat_ID('Breve')), 'posts_per_page' => 10, 'orderby'=> 'date'));
		  $d=0; 
		  while ($query_discos->have_posts()): $query_discos->the_post();
		  	$d++; 
		?>
		<li <?php echo ($d==1? "class=\"first\"": '');?>><a href="<?= get_permalink($post->ID); ?>"><?= get_the_post_thumbnail($post->ID, 'disco-libro'); ?></a>
			<strong><a href="<?= get_permalink($post->ID); ?>"><?php echo get_post_meta(get_the_ID(), "disco-libro-titulo", true); ?></a></strong><br/>
			<?php echo get_post_meta(get_the_ID(), "disco-libro-autor", true);?>
		
		</li>
		<?php endwhile;?>
		</ul>
</li></ul>