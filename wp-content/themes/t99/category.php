<?php require_header(); ?>
<div id="body-metadata" class="archive category category-past category-3 logged-in admin-bar no-customize-support" data-title="The 9.99 gallery"></div>
<div class="content exhibitions">
	<h1><?php _e ( 'exhibitions' , 't99' ) ; ?></h1>
<!-- 	<nav>
		<ul>
			<?php
				$args = array(
				    'post_type' => 'exhibitions',
				    'posts_per_page'=>-1,
				    'orderby'=>'menu_order',
				    'order'=>'asc',
				    'category_name'=>'past'
				);
				$attachments = get_posts( $args );
				if (count( $attachments)>0) {
			?>
			<li><a href="<?php echo home_url('exhibitions/category/past/') ?>"><?php _e ( 'past' , 't99' ) ; ?></a></li>
			<?php
				}
			?>
			<?php
				$args = array(
				    'post_type' => 'exhibitions',
				    'posts_per_page'=>-1,
				    'orderby'=>'menu_order',
				    'order'=>'asc',
				    'category_name'=>'current'
				);
				$attachments = get_posts( $args );
				if (count( $attachments)>0) {
			?>
			<li><a href="<?php echo home_url('exhibitions/category/current/') ?>"><?php _e ( 'current' , 't99' ) ; ?></a></li>
			<?php
				}
			?>
			<?php
				$args = array(
				    'post_type' => 'exhibitions',
				    'posts_per_page'=>-1,
				    'orderby'=>'menu_order',
				    'order'=>'asc',
				    'category_name'=>'future'
				);
				$attachments = get_posts( $args );
				if (count( $attachments)>0) {
			?>
			<li><a href="<?php echo home_url('exhibitions/category/future/') ?>"><?php _e ( 'future' , 't99' ) ; ?></a></li>
			<?php
				}
			?>
		</ul>
	</nav> -->

	<div class="subcontent exhibitions-list">
		<nav>
			<ul>
		<?php
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				$exhibitionUrl=get_permalink();
        		$title= language_get_the_title(get_the_ID());
       			 $date = data_get_the_content ( get_the_ID());
        $imageSrc = get_the_post_thumbnail( get_the_ID(), 'archive248by181');
				echo '<li><a href='.get_permalink().'>';
		        echo '<div>';
		        echo '<p>'.$title.'</p>';
		        echo '<p><span>'.$date.'</span></p>';
		        echo '</div>';
		        echo $imageSrc;
		        echo '</a></li>';
			} // end while
		} // end if
		// if (!$current_fp) {
		// 	getExhibitionItems();
		// } else if ($current_fp == 'past') {
		// 	getExhibitionItems('past');
		// } else if ($current_fp == 'current') {
		// 	getExhibitionItems('current');
		// } else if ($current_fp == 'future') {
		// 	getExhibitionItems('future');
		// };
		?>
			</ul>
		</nav>
	</div>
</div>
<?php require_footer(); ?>