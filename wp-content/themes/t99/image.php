	<?php require_header(); ?>
	<?php body_metadata(); ?>
	<?php /*
	session_start();
	if (isset($_GET['category'])) {    
		$_SESSION['category']=$_GET['category'];
		unset($_SESSION['parent']);
	} else	if (isset($_GET['parent'])) {    
		$_SESSION['parent']=$_GET['parent'];
		unset($_SESSION['category']);
	}	*/
	?>

		 
	
	<script>
	function getVar(name, optionalUrl){
		var SearchString = optionalUrl || window.location.search;
		if(name=(new RegExp('[?&]'+encodeURIComponent(name)+'=([^&]*)')).exec(SearchString))
			return decodeURIComponent(name[1]);
	  };

	var languageAnchors = $$('.language-link');
	languageAnchors.each(function(item, index){
		var link = item.get ( 'href' );
		if (typeof(getVar('category'))!="undefined") {
         if (typeof(getVar('category',link))==="undefined") {
         	link += '&category='+getVar('category');
         }
       } else if (typeof(getVar('parent'))!="undefined") {
       	if (typeof(getVar('parent',link))==="undefined") {
       		link += '&parent='+getVar('parent');
       	}
       }
    	item.set('href', link);
	})	
	</script>
	<div class="content works_list_wrapper">
		<div class="work-top">	
			<nav>
				<ul style="float:left;">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<li>
						<a href="<?php echo get_image_category_link($post->post_parent); ?>"><span aria-hidden="true" data-icon="&#xe000;"></span>
						</a></li>
				</ul>

				<ul style="float:right;">
					<li><a href="<?php echo get_prev_image() ?>"> <span aria-hidden="true" data-icon="&#xe001;"><span></a> </li>
					<li><a href="<?php echo get_next_image() ?>"> <span aria-hidden="true" data-icon="&#xe002;"><span></a></li>
				</ul>
				<div syle="clear:both;"></div>
			</nav>
		</div>

		<div class="work-center">
		<?php
			$attachment = get_post( get_the_ID() );
			$my_excerpt = $attachment->post_excerpt;
			if ( $my_excerpt != '' ) {
				echo $my_excerpt;
			}
			else {
			 $imageSrc = wp_get_attachment_image_src ( $post -> ID , 'large' , False ) ; $imageSrc = $imageSrc[ 0 ] ;
			 $imageSrcMedium = wp_get_attachment_image_src ( $post -> ID , 'medium' , False ) ; $imageSrcMedium = $imageSrcMedium[ 0 ] ;

		?>
		<a class="unprocessable-link" data-milkbox="single"  href="<?php echo $imageSrc ?>"><img src="<?php echo $imageSrcMedium ?>"></a>

		<?php 
			}
		?>
		</div>

	<script>
		if (window.Modernizr.mq('only screen and (max-width: 720px)'))  {
			var link = $('.unprocessable-link');			
			var cnt = link.contents();
			link.replaceWith(cnt);
		}
	</script>

		<div class="work-bottom">
		<?php
		if (isset($_GET['category'])) {
			if ( $_GET['category']!='views' ) {
		?>
		<p><span><?php echo image_get_the_title(get_the_ID ()); ?></span>, <?php echo image_get_the_content(get_the_ID ()) ?></p>
		<?php
			}
		} else {
		?>
		<p><span><?php echo image_get_the_title(get_the_ID ()); ?></span>, <?php echo image_get_the_content(get_the_ID ()) ?></p>
		<?php
		}
		?>
		</div>

<?php endwhile; ?>

<?php endif; ?>


	</div>
<?php require_footer(); ?>
