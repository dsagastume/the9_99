<<<<<<< HEAD
<?php require_header(); ?>
<div class="content exhibition">
	<h1><?php the_title(); ?></h1>
	<nav class="exhibition_nav">
		<ul>
			<li><a href="<?php echo the_permalink().'press/'; ?>">press release</a></li>
			<li><a href="<?php echo the_permalink().'works/'?>">works</a></li>
			<li><a href="<?php echo the_permalink().'views/'?>">views</a></li>
		</ul>
	</nav>
<?php 
		$current_fp = get_query_var('fpage');
		if (!$current_fp) {
			get_template_part( 'single', 'exhibitions-index' );
		} else if ($current_fp == 'press') {
			get_template_part( 'single', 'exhibitions-press' );
		} else if ($current_fp == 'works') {
			get_template_part( 'single', 'exhibitions-works' );
		} else if ($current_fp == 'views') {
			get_template_part( 'single', 'exhibitions-views' );
		};
?>
</div>
<?php require_footer(); ?>
=======
<?php require_header();
		$current_fp = get_query_var('fpage');
		if (!$current_fp) {
			get_template_part( 'single', 'artists-index' );
		} else if ($current_fp == 'cv') {
			get_template_part( 'single', 'artists-cv' );
		} else if ($current_fp == 'works') {
			get_template_part( 'single', 'artists-works' );
		} else if ($current_fp == 'press') {
			get_template_part( 'single', 'artists-press' );
		};
require_footer(); ?>
>>>>>>> e2e9ae48d7284b03dbd35c4040ef9b5c272d8bef
