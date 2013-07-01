<?php require_header(); ?>
<div class="content">
	<h1><?php language_the_title(); ?></h1>
	<div class="subcontent outdoors">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php language_the_content() ?>
		<?php endwhile; ?>
		<?php endif; ?>
	</div>
</div>
<?php require_footer(); ?>