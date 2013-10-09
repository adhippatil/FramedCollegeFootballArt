<?php

//connects to the server
$dbc = mysql_connect('localhost', 'framed', 'stoprich');
if(!$dbc){
	die('Not Connected: ' . mysql_error());
}

//connect to the database
$db = mysql_select_db('framed_artcart', $dbc);
if(!$db){
	die("Cannot Connect: " . mysql_error());
}
/*
$codes = file_get_contents("codes.txt");
$codes = str_replace(' ', '', $codes);
$c = explode(',', $codes);

foreach($c as $code){
	$sql = "INSERT INTO gift_voucher SET order_id = '', code = '" . $code . "', balance = '50.00', shipping = '0', tax = '0', date_start = '2011-08-09', date_end = '0000-00-00', status = '1', date_added = NOW()";
	mysql_query($sql);
}
*/
/*
$i = 0;
$qry = "SELECT * FROM gift_voucher ORDER BY gift_voucher_id";
$result = mysql_query($qry);
while($info = mysql_fetch_array($result)){
		
	if($i >= 1){
		$id = $info['gift_voucher_id'];
		//echo $id . "<br />";
		$s = "UPDATE gift_voucher SET code='".$c[$i]."' WHERE id='".$id."';";
		mysql_query($s);
	
		echo $c[$i];	
	}
	$i++;
}
*/

?>