<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>The 9.99 Gallery</title>

<link href='http://fonts.googleapis.com/css?family=Source+Code+Pro:300,400,600' rel='stylesheet' type='text/css'>
<link href="style.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="jquery.backstretch.min.js"></script>
<script type="text/javascript" src="modernizr.js"></script>
<script type="text/javascript" src="global.js"></script>
<!--[if lte IE 7]><script src="lte-ie7.js"></script><![endif]-->

<script>
$(document).ready(function() {
	$.backstretch([
		"resources/1.jpg",
		"resources/2.jpg",
		"resources/3.jpg",
		"resources/4.jpg"
	], {
		fade: 1000,
		duration: 4000
	});
});


</script>

<?php include "header.php" ?>

</body>
</html>
