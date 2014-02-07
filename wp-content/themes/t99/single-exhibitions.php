<?php require_header(); ?>
<div class="content exhibition">
	<h1><?php language_the_title(); ?></h1>
	<nav class="exhibition_nav">
		<ul>
			<li><a href="<?php echo the_permalink().'press/'; ?>"><?php _e ( 'press' , 't99' ) ; ?></a></li>
			<?php
				$args = array(
				    'post_parent' => get_the_ID(),
				    'post_type' => 'attachment',
				    'post_mime_type' => 'image',
				    'posts_per_page'=>-1,
				    'attachment_category' => 'works',
				    'orderby'=>'menu_order',
				    'order'=>'asc'
				);
				$attachments = get_posts( $args );
				if (count( $attachments)>0) {
			?>
			<li><a href="<?php echo the_permalink().'works/'?>"><?php _e ( 'works' , 't99' ) ; ?></a></li>
			<?php
				}
			?>
			<?php
				$args = array(
				    'post_parent' => get_the_ID(),
				    'post_type' => 'attachment',
				    'post_mime_type' => 'image',
				    'posts_per_page'=>-1,
				    'attachment_category' => 'views',
				    'orderby'=>'menu_order',
				    'order'=>'asc'
				);
				$attachments = get_posts( $args );
				if (count( $attachments)>0) {
			?>
			<li><a href="<?php echo the_permalink().'views/'?>"><?php _e ( 'views' , 't99' ) ; ?></a></li>
			<?php
				}
			?>

		</ul>
	</nav>
<?php
		$current_fp = get_query_var('fpage');
		if (!$current_fp) {
			get_template_part( 'single', 'exhibitions-press' );
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