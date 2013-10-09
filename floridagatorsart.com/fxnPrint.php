<?php
function printProducts($id, $prodURL, $imgURL) {
	
	//create query
	$products = qry("SELECT *, pd.name AS name, p.image AS image FROM product p, product_description pd, product_to_category p2c WHERE p2c.product_id=p.product_id AND p.product_id=pd.product_id AND p2c.category_id='".$id."'");
	
	//print results
	foreach($products as $product){
		print "<li><div class='prodImg'><a href='". $prodURL . $product['product_id'] . "' target='_blank'>";
		print "<img src='" . $imgURL . $product['image'] . "' alt='".$product['name']."' /></a></div>";
		print "<div class='prodDesc'>";
		print "<a href='". $prodURL . $product['product_id'] . "' target='_blank'>";
		print $product['name'];
		print "</a>";
		print html_entity_decode($product['description'], ENT_QUOTES, 'UTF-8');
		print "</div>";
		print "<div class='clearfloat'></div>";
		print "</li>";
	}
}

function printFeatured($id, $prodURL, $imgURL){
	
	//create query
	$products = qry("SELECT *, pd.name AS name, p.image AS image FROM product p, product_description pd, product_to_category p2c WHERE p2c.product_id=p.product_id AND p.product_id=pd.product_id AND p2c.category_id='".$id."' ORDER BY RAND() LIMIT 2;");
	
	//print results
	foreach($products as $product){
		print "<a href='". $prodURL . $product['product_id'] . "' target='_blank'>";
		print "<img src='" . $imgURL . $product['image'] . "' alt='".$product['name']."' /></a>";	
	}
	
}

function qry($qry){
	
	$data = array();
	$result = mysql_query($qry);
	while($info = mysql_fetch_array($result)){
		$data[] = $info;
	}
	
	return $data;
}

?>