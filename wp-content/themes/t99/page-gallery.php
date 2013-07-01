<?php require_header(); ?>
<div class="content">
	<h1><?php language_the_title() ?></h1>

	<div class="subcontent">
		<div class="gallery-text" style="">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php language_the_content() ?>
		<?php endwhile; ?>
		<?php endif; ?>
		</div>
		<div class="gallery-images-wrapper">
			<div style="width: 100%; height: 100%; position: absolute; left: 0px; z-index: 0; background-image: none; background-position: initial initial; background-repeat: initial initial;" class="gallery-images">
			</div>
		</div>
	</div>
</div>
<?php require_footer(); ?>