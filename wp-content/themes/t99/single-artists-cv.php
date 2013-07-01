<?php body_metadata(); ?>
<div class="subcontent cv">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<?php echo language_the_content( ); ?>
	<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>
</div>