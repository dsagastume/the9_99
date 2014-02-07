<?php require_header(); ?>	
<?php body_metadata(); ?>	
<div class="content publications">
<h1><?php _e ( 'publications' , 't99' ) ; ?></h1>
<div class="subcontent publications">	
	<?php query_posts($query_string . '&order=asc'); ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<div class="publication">
			<div class="publication-image">
				<?php the_post_thumbnail( $size = 'publications120by155', $attr = '' ); ?>
			</div>
			<div class="publication-text">
				<p><a href="<?php publication_the_link(get_the_ID()); ?>"><?php the_title(); ?><span aria-hidden="true" data-icon="&#xe003;"></span></a></p>
				<?php language_the_content(); ?>
			</div>
		</div>
	<?php endwhile; ?>
</div>
</div>
<?php require_footer(); ?>