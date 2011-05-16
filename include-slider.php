<?php
$sticky = get_option('sticky_posts');
$args = array('post__in' => $sticky, 'caller_get_posts' => 1 );
$query_act = new WP_Query($args); // &paged
if ($query_act->have_posts()):  ?>
	<div class="slider-content" style="width: 500px; height: 300px;">
		<div class="preload"><div></div></div>
		<div class="slider-main-outer" style="width: 500px; height: 300px;">
		<div onclick="return false" href="" class="slider-previous">Anterior</div>
			<ul class="slider-main-wapper">
<?
    //while (have_posts()) : the_post();
    $s=0;
    while ($query_act->have_posts()): $query_act->the_post();		
		if(has_post_thumbnail()): $s++;?>
			<?php $args = array('title'=> get_the_title(), 'class'=>'conten-img'); ?>				
			<li><?php the_post_thumbnail('slider', $args); ?>
            	<div class="slider-main-item-desc">
            			<div class="meta"><?php the_category(' · ') ?></div>
            			<div><a href="<?php the_permalink() ?>"><h3><?php echo (get_post_meta(get_the_ID(), "slider-titulo", true)!=''? get_post_meta(get_the_ID(), "slider-titulo", true) : get_the_title()); ?></h3></a></div>
            			<p class="storycontent"><a href="<?php the_permalink() ?>"><?php echo get_post_meta(get_the_ID(), "slider-texto", true); ?></a></p> 
				</div>
			</li>
		<?php endif; ?>
	<?php endwhile; ?>
			</ul>
			<div onclick="return false" href="" class="slider-next">Siguiente</div>
		</div> <!-- end slider-main-outer -->
	</div><!--end slider-content -->
<?php endif; ?>