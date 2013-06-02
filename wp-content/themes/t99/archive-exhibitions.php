<?php require_header(); ?>	
<?php body_metadata(); ?>	
<div class="content exhibitions">
<h1>current exhibitions</h1>
<nav>
<ul>
<li><a>current</a></li>
<li><a>future</a></li>
<li><a>past</a></li>
</ul>
</nav>
<div class="subcontent exhibitions-list">

<nav>

<ul>
<?php while ( have_posts() ) : the_post(); ?>
		<li>
			<a href="<?php the_permalink(); ?>">
				<div>
					<p><?php the_title(); ?></a></li></p>
					<p><span><?php the_date('F j, Y') ?></span></p>
				</div>
				 <?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
				 <img src="<?php $url ?>">
			</a>
		</li>
	<?php endwhile; ?>
</ul>

</nav>

</div>
</div>
<?php require_footer(); ?>