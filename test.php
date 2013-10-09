<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>

<?php
// Include WordPress 
define('WP_USE_THEMES', false);
require('blog/wp-load.php');
query_posts('showposts=3');
?>

<?php while (have_posts()): the_post(); ?>
<h2><?php the_title(); ?></h2>
<?php the_excerpt(); ?>
<p><a href="<?php the_permalink(); ?>">Read more...</a></p>
<?php endwhile; ?>

<?php
function getBlogEntries(){

	$rss_url = "feed://www.framedcollegefootballart.com/blog/feed/";
	
	// GET RSS FEED
	$RSS_XML = getRSS($rss_url);
	// CONVERT XML FEED TO ARRAY
	$items = RSStoARRAY($RSS_XML);
	
	echo $RSS_XML;
	
	return $items;	
}

function getRSS($posturl){
		
		echo $posturl;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $posturl);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_POST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	$response = curl_exec($ch);
	
	
	return $response;
}

function RSStoARRAY($RSS_XML){

	// CONVERT XML FEED INTO ARRAY
	$xml = simplexml_load_string($RSS_XML);
	$json = json_encode($xml);
	$items = json_decode($json,TRUE);
	$items = $items["channel"]["item"];
	
	return $items;
}
?>
</body>
</html>