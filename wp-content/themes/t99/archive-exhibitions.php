<?php require_header(); ?>
<?php body_metadata(); ?>
<div class="content exhibitions">
	<h1><?php _e ( 'exhibitions' , 't99' ) ; ?></h1>
	<nav>
		<ul>
			<li><a><?php _e ( 'past' , 't99' ) ; ?></a></li>
			<li><a href="<?php get_post_type_archive_link( 'exhibitions' ); ?>"><?php _e ( 'current' , 't99' ) ; ?></a></li>
			<li><a><?php _e ( 'future' , 't99' ) ; ?></a></li>
		</ul>
	</nav>

	<div class="subcontent exhibitions-list">
		<nav>
			<ul>
			<?php getExhibitionItems(); ?>
			</ul>
		</nav>
	</div>
</div>
<?php require_footer(); ?>