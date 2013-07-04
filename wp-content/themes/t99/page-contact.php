<?php require_header(); ?>
<?php
	getContactScript();
?>
		<?php body_metadata(); ?>	
<div class="content contact">
	<h1><?php language_the_title() ?></h1>
	<br>
		
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php language_the_content() ?>
		<?php endwhile; ?>
		<?php endif; ?>

	<div id="map">
	</div>	
</div>
<?php require_footer(); ?>