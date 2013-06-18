<?php require_header(); ?>
	<?php body_metadata(); ?>
	<div class="content works_list_wrapper">
		<div class="work-top">	
			<nav>
				<ul style="float:left;">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<li><a href="<?php echo get_permalink($post->post_parent).'works/'; ?>"><span aria-hidden="true" data-icon="&#xe000;"></span> to works</a></li>
				</ul>

				<ul style="float:right;">
					<li><?php previous_image_link(false, '<span aria-hidden="true" data-icon="&#xe001;"><span>'); ?> </li>
					<li><?php next_image_link(false, '<span aria-hidden="true" data-icon="&#xe002;"><span>'); ?></li>
				</ul>
				<div syle="clear:both;"></div>
			</nav>
		</div>

		<div class="work-center">
		<img src="<?php echo wp_get_attachment_url($post->id); ?>">
		</div>



		<div class="work-bottom">
		<p><span><?php the_title(); ?></span>, <?php echo get_the_content() ?></p>
		</div>	
<?php endwhile; ?>

<?php endif; ?>


	</div>
<?php require_footer(); ?>
