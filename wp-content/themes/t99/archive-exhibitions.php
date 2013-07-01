<?php require_header(); ?>
<?php body_metadata(); ?>
<div class="content exhibitions">
	<h1><?php post_type_archive_title(); ?></h1>
	<nav>
		<ul>
			<li><a>past</a></li>
			<li><a href="<?php get_post_type_archive_link( 'exhibitions' ); ?>">current</a></li>
			<li><a>future</a></li>
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