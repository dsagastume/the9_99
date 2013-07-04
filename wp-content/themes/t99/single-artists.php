<?php require_header(); ?>
<div class="content artist">
	<h1><?php language_the_title(); ?></h1>
	<nav class="artist_nav">
		<ul>
			<li><a href="<?php echo the_permalink().'cv/'; ?>"><?php _e ( 'cv' , 't99' ) ; ?></a></li>
			<li><a href="<?php echo the_permalink().'works/'?>"><?php _e ( 'works' , 't99' ) ; ?></a></li>
			<li><a href="<?php echo the_permalink().'press/'?>"><?php _e ( 'press' , 't99' ) ; ?></a></li>
		</ul>
	</nav>
<?php 
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
?>
</div>
<?php require_footer(); ?>