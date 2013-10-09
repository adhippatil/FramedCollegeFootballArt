<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>

<div id="content">
	<?php
$query = $this->db->query("SELECT symbol_left, symbol_right FROM " . DB_PREFIX . "currency WHERE currency_id = '" . $this->currency->getId() . "'");
$currency_info = $query->row;
$symbol_left = $currency_info['symbol_left'];
$symbol_right = $currency_info['symbol_right'];
$decimal_point = $this->language->get('decimal_point');
?>

<script type="text/javascript">
	/*
	$(document).ready(function() {
		$('.products').each(function(){
			//updatePx(this);
		});
	
		// Update price of changed select box

		$('.products form div table tr td select').change(function(){
			updatePx($(this).parent().parent().parent().parent().parent().parent().parent());
		});
	});
	*/
	
	function updatePx(obj, price) {
		
		var symbol_left = '<?php echo $symbol_left; ?>';
		var symbol_right = '<?php echo $symbol_right; ?>';
		var decimal_point = '<?php echo $decimal_point; ?>';
		
		//price = $(obj).find(".price").text();
		if (price == "" || price == undefined) { return; }
		
		price = price.replace(/[,]/g,'.'); // use common decimal point for all languages
		price = price.replace(/[^0-9.]/g,''); // remove all non-price characters
		price = price * 1;
		
		$(obj).find('select :selected').each(function(i, selected){
		
			option_px = $(selected).text(); // get the contents of each selected option
			if (option_px.lastIndexOf('-'+symbol_left) > 0) { option_op = '-' } else { option_op = '+' }
			option_px = option_px.replace(/[\+-]/g,'#'); // create a common split reference
			//alert(option_px);
			tmp = option_px.split('#'); // split the price from the text
			if (tmp.length > 1) {
				option_px = tmp[tmp.length-1].replace(/[,]/g,'.'); // use common decimal point for all languages
				option_px = option_px.replace(/[^0-9.]/g,''); // remove all non-price characters from the LAST split (incase +,-,# are used in the name)
				option_px * 1;
				if (option_op == '-') {
					price -= (option_px * 1);
				} else {
					price += (option_px * 1);
				}
			}
		});
		
		// Update the main price with the new price.
		$(obj).find(".price").fadeOut('normal', function() {
			price = price.toFixed(2);			
			price = price.replace(/[.]/g, decimal_point); //restore language decimal point
			$(obj).find(".price").html(symbol_left+price+symbol_right); 
		});
		$(obj).find(".price").fadeIn('normal');
		
	}
</script>

	<div class="top">
		<h1><?php echo $heading_title; ?></h1>
	</div>
	<div class="middle">
	<div id="product_topper">
		<?php if (isset($thumb)) { ?>
		<img id="school_logo" src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" />
		<?php } ?>
	</div>
	<div class="sort">
		<div class="div1">
			<select name="sort" onchange="location=this.value">
				<?php foreach ($sorts as $sorts) { ?>
				<?php if (($sort . '-' . $order) == $sorts['value']) { ?>
				<option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
				<?php } else { ?>
				<option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
				<?php } ?>
				<?php } ?>
			</select>
		</div>
		<div class="div2"><?php echo $text_sort; ?></div>
	</div>
	<table class="list">
		<?php for ($i = 0; $i < sizeof($products); $i = $i + 3) { ?>
		<tr>
			<?php for ($j = $i; $j < ($i + 3); $j++) { ?>
			<td width="33%" class="products"><?php if (isset($products[$j])) { ?>
				<a href="<?php echo $products[$j]['href']; ?>"><img src="<?php echo $products[$j]['thumb']; ?>" title="<?php echo $products[$j]['name']; ?>" alt="<?php echo $products[$j]['name']; ?>" /></a><br />
				<a href="<?php echo $products[$j]['href']; ?>" class="prodName"><?php echo $products[$j]['name']; ?></a><br />
				<span style="color: #999; font-size: 11px;"><?php echo $products[$j]['model']; ?></span><br />
				<?php if ($display_price) { ?>
				<?php if (!$products[$j]['special']) { ?>
				<span style="color: #900; font-weight: bold;"><span class="price"><?php echo $products[$j]['price']; ?></span></span><br />
				<?php } else { ?>
				<span style="color: #900; font-weight: bold; text-decoration: line-through;"><?php echo $products[$j]['price']; ?></span> <span style="color: #F00;"><span class="price"><?php echo $products[$j]['special']; ?></span></span>
				<?php } ?>
				<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="product_<?php echo $j; ?>">
					
					 <!-- //Q: START Product Options --->				  
					  <?php if ($products[$j]['options']) { ?>
						<div style="padding: 10px; margin-top: 2px; margin-bottom: 15px;">
						  <table style="width: 100%;">
							<?php foreach ($products[$j]['options'] as $option) { ?>
							<tr>
							   <td><select style="max-width: 220px; font-size: 10px;" name="option[<?php echo $option['product_option_id']; ?>]" onchange="updatePx($(this).parent().parent().parent().parent().parent().parent().parent(), '<?php echo $products[$j]['price']; ?>');">
								<?php foreach ($option['option_value'] as $option_value) { ?>
								<option value="<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
								<?php if ($option_value['price'] > 0) { ?>
									<?php $oPrice = $this->currency->format($option_value['price']); ?>
									<?php echo $option_value['prefix']; ?><?php echo $oPrice; ?>
								<?php } ?>
								</option>
								<?php } ?>
							  </select></td>
							</tr>
							<?php } ?>
						  </table>					
					  <?php } ?>
					  <!-- //Q: END Product Options --->
					
					<?php } ?>
					<?php if ($products[$j]['rating']) { ?>
					<img src="catalog/view/theme/football/image/stars_<?php echo $products[$j]['rating'] . '.png'; ?>" alt="<?php echo $products[$j]['stars']; ?>" />
					<?php } ?>
					<input type="hidden" name="quantity" size="3" value="1" />
					<a onclick="$('#product_<?php echo $j; ?>').submit();" id="add_to_cart" class="button"><span>Add to Cart</span></a>
					</div>
					<input type="hidden" name="product_id" value="<?php echo $products[$j]['product_id']; ?>" />
				</form>
				<?php } ?></td>
			<?php } ?>
		</tr>
		<?php } ?>
	</table>
	<div class="pagination"><?php echo $pagination; ?></div>
</div>
<div class="bottom">&nbsp;</div>
</div>


<?php echo $footer; ?> 