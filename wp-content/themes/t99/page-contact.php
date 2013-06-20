<?php require_header(); ?>
<div class="content contact">
	<h1><?php the_title() ?></h1>
	<br>
		
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php the_content() ?>
		<?php endwhile; ?>
		<?php endif; ?>

	<div id="map">
	</div>	
</div>
<?php require_footer(); ?>