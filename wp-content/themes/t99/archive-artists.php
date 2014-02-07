<?php require_header(); ?>	
<?php body_metadata(); ?>	
<div class="content artists">
<h1><?php _e ( 'artists' , 't99' ) ; ?></h1>
<nav>
	<ul>
	<?php query_posts($query_string . '&orderby=title&order=asc'); ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
	<?php endwhile; ?>
	</ul>
</nav>
</div>
<?php require_footer(); ?>