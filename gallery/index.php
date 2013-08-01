<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>The 9.99 Gallery | About</title>

<link href='http://fonts.googleapis.com/css?family=Source+Code+Pro:300,400,600' rel='stylesheet' type='text/css'>
<link href="../style.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="../jquery.backstretch.min.js"></script>
<script type="text/javascript" src="../modernizr.js"></script>
<script type="text/javascript" src="../global.js"></script>

<script>

$(document).ready(function(e) {

	$(".gallery-images").backstretch([
		"1.jpg",
		"2.jpg",
		"3.jpg",
		"4.jpg"
	], {
		fade: 1000,
		duration: 4000
	});

});
</script>

<?php include "../header.php" ?>

<div class="content">
<h1>the gallery</h1>

<div class="subcontent">

<div class="gallery-text" style="">
<p>
THE 9.99 inaugurated a space at the historical center in Guatemala City on July 2008. Based at an office building for lawyers of modernist style, the construction was designed in 1950 by architect Carlos Asensio Wunderlich(1919-2013). The new gallery operates from an industrial loft style space from the beginning of the 40s located at the Historical Center as well at Edificio Passarelli(5 avenida 11-16 zona 1). 
</p><br>

<p>
THE 9.99 is a contemporary art gallery whose primary objective is to promote and disseminate the art produced in Guatemala in the last ten years. This initiative emerged in response to the growing interest on Guatemalan contemporary art within the international art scene. The project works with a group of artists that emerged at the beginning of the 90s such as Andrea Aragón, Darío Escobar, Aníbal López, and Diana de Solares, and also showcases the work of emerging artists that began to show internationally in the mid-2000 such as Benvenuto Chavajay, Edar Calel, Tepeu Choc y Angel Poyón.
</p><br>

<p>  
THE 9.99 will present nine annual exhibitions with individual shows by the artists in the gallery as well as a new program of residencies for international curators. The purpose of this project is to promote the research and scholarly publications on the artistic practice in Guatemala today.
</p>
</p>
</div>


<div class="gallery-images-wrapper">
<div style="width:100%; height:100%; position:absolute; left:0;" class="gallery-images"></div>
</div>


</div>
</div>

</body>
</html>