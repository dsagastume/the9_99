<?php body_metadata(); ?>
<div class="content artist">
<h1><?php the_title(); ?></h1>
<nav>
<ul>
<li><a>cv</a></li>
<li><a>works</a></li>
<li><a>press</a></li>
</ul>
</nav>

<div class="subcontent works">
<nav>
<ul>
<?php getPostImages(); ?>
</ul>
</nav>
</div>
</div>