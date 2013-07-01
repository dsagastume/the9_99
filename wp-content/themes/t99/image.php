<?php require_header(); ?>
	<?php body_metadata(); ?>
	<div class="content works_list_wrapper">
		<div class="work-top">	
			<nav>
				<ul style="float:left;">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<li><a href="<?php echo get_permalink($post->post_parent) ?>"><span aria-hidden="true" data-icon="&#xe000;"></span></a></li>
				</ul>

				<ul style="float:right;">
					<li><?php get_prev_image(false, '<span aria-hidden="true" data-icon="&#xe001;"><span>'); ?> </li>
					<li><?php get_next_image(false, '<span aria-hidden="true" data-icon="&#xe002;"><span>'); ?></li>
				</ul>
				<div syle="clear:both;"></div>
			</nav>
		</div>

		<div class="work-center">
		<img src="<?php echo wp_get_attachment_url($post->id); ?>">
		</div>



		<div class="work-bottom">
		<p><span><?php language_the_title(); ?></span>, <?php echo language_get_the_excerpt() ?></p>
		</div>	
<?php endwhile; ?>

<?php endif; ?>


	</div>
<?php require_footer(); ?>
