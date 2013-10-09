<?php
include("fxnMySQL.php"); 
include("fxnPrint.php");

//Variables for the print fxn
$teamID = '36';
$linkURL = "http://www.framedcollegefootballart.com/index.php?route=product/manufacturer&manufacturer_id=";
$prodURL = "http://www.framedcollegefootballart.com/product/product&product_id=";
$imgURL = "http://www.framedcollegefootballart.com/image/";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" language="javascript" src="js/jquery-1.6.1.min.js"></script>
<title>Crimson Tide Art - Framed Alabama Football Art</title>
<link href="crimson_styles.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-19105503-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>

<body>
<div class="container">
	<div id="logo"></div>
	<div id="pageHead">
		<h1>Crimson Tide Art</h1>
		<h2>Alabama Football Art</h2>
	</div>
	<div id="footballArt"><img src="images/alabamaFootballArt.png" width="523" height="641" alt="Alabama Football Artwork" /></div>
	<div class="clearfloat"></div>
	<div id="steps">
		<div id="step1"><a href="<?php echo $linkURL.$teamID; ?>">Click Here to view our huge selection of Prints</a></div>
		<div id="step2"></div>
		<div id="frames"><img src="images/frames.png" width="477" height="138" alt="Frames" /></div>
		<div class="clearfloat"></div>
	</div>
	<div class="content">
		<div id="leftBar"> <?php printFeatured($teamID, $prodURL, $imgURL); ?> </div>
		<div id="rightBar">
			<div id="boxTop"></div>
			<div id="boxContent">
				<div id="info">
					<ul>
						<?php printProducts($teamID, $prodURL, $imgURL); ?>
					</ul>
				</div>
			</div>
			<div id="boxBottom"></div>
		</div>
		<!-- end .content --></div>
	<!-- end .container --> 
</div>
<script type="text/javascript">
$(function(){
	$("p span").removeAttr("style");
});
</script>
</body>
</html>
