<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>

<div id="content">
	<?php include('catalog/view/javascript/updatepx/updatepx.inc.php'); ?>
	<div class="top">
		<h1><?php echo $heading_title; ?></h1>
	</div>
	<div class="middle">
		<div style="width: 100%; margin-bottom: 30px;">
			<table style="width: 100%; border-collapse: collapse;">
					<tr>
				
				<td style="text-align: center; width: 250px; vertical-align: top;"><a href="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>" class="thickbox"><img src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" id="image" style="margin-bottom: 3px;" /></a><br />
					<span style="font-size: 11px;"><?php echo $text_enlarge; ?></span></td>
					<td style="padding-left: 15px; width: 296px; vertical-align: top;">
				<table width="100%">
					<?php if ($display_price) { ?>
					<tr>
						<td><b><?php echo $text_price; ?></b></td>
						<td><?php if (!$special) { ?>
							<span id="price"><?php echo $price; ?></span>
							<?php } else { ?>
							<span style="text-decoration: line-through;"><?php echo $price; ?></span> <span style="color: #F00;"><span id="price"><?php echo $special; ?></span></span>
							<?php } ?></td>
					</tr>
					<?php } ?>
					<tr>
						<td><b><?php echo $text_availability; ?></b></td>
						<td><!-- <?php echo $stock; ?> --> In Stock</td>
					</tr>
					<tr>
						<td><b><?php echo $text_model; ?></b></td>
						<td><?php echo $model; ?></td>
					</tr>
					<?php if ($manufacturer) { ?>
					<tr>
						<td><b>Artist:</b></td>
						<td><a href="<?php echo $manufacturers; ?>"><?php echo $manufacturer; ?></a></td>
					</tr>
					<?php } ?>
					<tr>
						<td><b><?php echo $text_average; ?></b></td>
						<td><?php if ($average) { ?>
							<img src="catalog/view/theme/default/image/stars_<?php echo $average . '.png'; ?>" alt="<?php echo $text_stars; ?>" style="margin-top: 2px;" />
							<?php } else { ?>
							<?php echo $text_no_rating; ?>
							<?php } ?></td>
					</tr>
				</table>
				<br />
				
				<div id="share" class="share clearfix"><!-- AddThis Button BEGIN -->
					<!-- AddThis Button BEGIN -->
					<div class="addthis_toolbox addthis_default_style ">
					<a class="addthis_button_preferred_1"></a>
					<a class="addthis_button_preferred_2"></a>
					<a class="addthis_button_preferred_3"></a>
					<a class="addthis_button_preferred_4"></a>
					<a class="addthis_button_compact"></a>
					<a class="addthis_counter addthis_bubble_style"></a>
					</div>
					<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4fa199d7712b69bb"></script>
					<!-- AddThis Button END -->
				</div>
				
				<?php if ($display_price) { ?>
				<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="product">
					<?php if ($options) { ?>
					<b><?php echo $text_options; ?></b><br />
					<div style="background: #000; color: #FFF; padding: 10px; position: relative; margin: 2px 0px 15px 0px;"> <img src="/catalog/view/theme/football/images/frames.jpg" align="right" width="150" />
						<table style="width:200px;">
							<?php foreach ($options as $option) { ?>
							<tr>
								<td><!-- <?php echo $option['name']; ?>: --></td>
								<td><?php foreach ($option['option_value'] as $option_value) { ?>
							<tr>
								<td><input type="radio" name="option[<?php echo $option['option_id']; ?>]" value="<?php echo $option_value['option_value_id']; ?>">
									&nbsp;<?php echo $option_value['name']; ?>
									<?php if ($option_value['price']) { ?>
									<?php echo $option_value['prefix']; ?><?php echo $option_value['price']; ?>
									<?php } ?></td>
							</tr>
							<?php } ?>
								</td>
							
								</tr>
							
							<?php } ?>
						</table>
						<?php } ?>
						<div class="fixFF"></div>
					</div>
					<!-- END FRAMING OPTIONS -->
					<?php if ($display_price) { ?>
					<?php if ($discounts) { ?>
					<b><?php echo $text_discount; ?></b><br />
					<div style="background: #000; color: #FFF; padding: 10px; margin-top: 2px; margin-bottom: 15px;">
						<table style="width: 100%;">
							<tr>
								<td style="text-align: right;"><b><?php echo $text_order_quantity; ?></b></td>
								<td style="text-align: right;"><b><?php echo $text_price_per_item; ?></b></td>
							</tr>
							<?php foreach ($discounts as $discount) { ?>
							<tr>
								<td style="text-align: right;"><?php echo $discount['quantity']; ?></td>
								<td style="text-align: right;"><?php echo $discount['price']; ?></td>
							</tr>
							<?php } ?>
						</table>
					</div>
					<?php } ?>
					<?php } ?>
					<div style="background: #000; padding: 5px; color: #FFF; position: relative; margin-right: 0;"><?php echo $text_qty; ?>
						<input type="text" name="quantity" size="3" value="1" />
						<a onclick="$('#product').submit();" id="add_to_cart" class="button"><span><?php echo $button_add_to_cart; ?> &raquo;</span></a></div>
					<input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
				</form>
				<?php } ?>
					</td>
				
					</tr>
				
			</table>
		</div>
		<div class="tabs"><a tab="#tab_description"><?php echo $tab_description; ?></a><a tab="#tab_image"><?php echo $tab_image; ?></a><a tab="#tab_review"><?php echo $tab_review; ?></a><a tab="#tab_related"><?php echo $tab_related; ?></a><div class="fixFF"></div></div>
		<div id="tab_description" class="page" style="border: 1px solid #000;"><?php echo $description; ?></div>
		<div id="tab_review" class="page">
			<div id="review" ></div>
			<div style="color: #000; text-transform: none; font-size: 24px;"><?php echo $text_write; ?></div>
			<div style="background: #FFF;margin: 0px; padding: 10px;"><b><?php echo $entry_name; ?></b><br />
				<input type="text" name="name" value="" />
				<br />
				<br />
				<b><?php echo $entry_review; ?></b>
				<textarea name="text" style="width: 99%;" rows="8"></textarea>
				<span style="font-size: 11px;"><?php echo $text_note; ?></span><br />
				<br />
				<b><?php echo $entry_rating; ?></b> <span><?php echo $entry_bad; ?></span>&nbsp;
				<input type="radio" name="rating" value="1" style="margin: 0;" />
				&nbsp;
				<input type="radio" name="rating" value="2" style="margin: 0;" />
				&nbsp;
				<input type="radio" name="rating" value="3" style="margin: 0;" />
				&nbsp;
				<input type="radio" name="rating" value="4" style="margin: 0;" />
				&nbsp;
				<input type="radio" name="rating" value="5" style="margin: 0;" />
				&nbsp; <span><?php echo $entry_good; ?></span><br />
				<br />
				<b><?php echo $entry_captcha; ?></b><br />
				<input type="text" name="captcha" value="" />
				<br />
				<img src="index.php?route=product/product/captcha" id="captcha" /></div>
			<div class="buttons">
				<table>
					<tr>
						<td align="right"><a onclick="review();" class="button"><span><?php echo $button_continue; ?></span></a></td>
					</tr>
				</table>
			</div>
		</div>
		<div id="tab_image" class="page">
			<?php if ($images) { ?>
			<div style="display: inline-block;">
				<?php foreach ($images as $image) { ?>
				<div style="display: inline-block; float: left; text-align: center; margin-left: 5px; margin-right: 5px; margin-bottom: 10px;"><a href="<?php echo $image['popup']; ?>" title="<?php echo $heading_title; ?>" class="thickbox"><img src="<?php echo $image['thumb']; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" style="border: 1px solid #DDDDDD; margin-bottom: 3px;" /></a><br />
					<span style="font-size: 11px;"><?php echo $text_enlarge; ?></span></div>
				<?php } ?>
			</div>
			<?php } else { ?>
			<div style="background: #FFF; padding: 10px; margin-bottom: 10px;"><?php echo $text_no_images; ?></div>
			<?php } ?>
		</div>
		<div id="tab_related" class="page">
			<?php if ($products) { ?>
			<table class="list">
				<?php for ($i = 0; $i < sizeof($products); $i = $i + 4) { ?>
				<tr>
					<?php for ($j = $i; $j < ($i + 4); $j++) { ?>
					<td width="25%"><?php if (isset($products[$j])) { ?>
						<a href="<?php echo $products[$j]['href']; ?>"><img src="<?php echo $products[$j]['thumb']; ?>" title="<?php echo $products[$j]['name']; ?>" alt="<?php echo $products[$j]['name']; ?>" /></a><br />
						<a href="<?php echo $products[$j]['href']; ?>"><?php echo $products[$j]['name']; ?></a><br />
						<span style="color: #999; font-size: 11px;"><?php echo $products[$j]['model']; ?></span><br />
						<?php if ($display_price) { ?>
						<?php if (!$products[$j]['special']) { ?>
						<span style="color: #900; font-weight: bold;"><?php echo $products[$j]['price']; ?></span><br />
						<?php } else { ?>
						<span style="color: #900; font-weight: bold; text-decoration: line-through;"><?php echo $products[$j]['price']; ?></span> <span style="color: #F00;"><?php echo $products[$j]['special']; ?></span>
						<?php } ?>
						<?php } ?>
						<?php if ($products[$j]['rating']) { ?>
						<img src="catalog/view/theme/default/image/stars_<?php echo $products[$j]['rating'] . '.png'; ?>" alt="<?php echo $products[$j]['stars']; ?>" />
						<?php } ?>
						<?php } ?></td>
					<?php } ?>
				</tr>
				<?php } ?>
			</table>
			<?php } else { ?>
			<div style="background: #000;padding: 10px; margin-bottom: 10px;"><?php echo $text_no_related; ?></div>
			<?php } ?>
		</div>
	</div>
	<div class="bottom">&nbsp;</div>
</div>
<script type="text/javascript"><!--
$('#review .pagination a').live('click', function() {
	$('#review').slideUp('slow');
		
	$('#review').load(this.href);
	
	$('#review').slideDown('slow');
	
	return false;
});			

$('#review').load('index.php?route=product/product/review&product_id=<?php echo $product_id; ?>');

function review() {
	$.ajax({
		type: 'POST',
		url: 'index.php?route=product/product/write&product_id=<?php echo $product_id; ?>',
		dataType: 'json',
		data: 'name=' + encodeURIComponent($('input[name=\'name\']').val()) + '&text=' + encodeURIComponent($('textarea[name=\'text\']').val()) + '&rating=' + encodeURIComponent($('input[name=\'rating\']:checked').val() ? $('input[name=\'rating\']:checked').val() : '') + '&captcha=' + encodeURIComponent($('input[name=\'captcha\']').val()),
		beforeSend: function() {
			$('.success, .warning').remove();
			$('#review_button').attr('disabled', 'disabled');
			$('#review_title').after('<div class="wait"><img src="catalog/view/theme/default/image/loading_1.gif" alt="" /> <?php echo $text_wait; ?></div>');
		},
		complete: function() {
			$('#review_button').attr('disabled', '');
			$('.wait').remove();
		},
		success: function(data) {
			if (data.error) {
				$('#review_title').after('<div class="warning">' + data.error + '</div>');
			}
			
			if (data.success) {
				$('#review_title').after('<div class="success">' + data.success + '</div>');
								
				$('input[name=\'name\']').val('');
				$('textarea[name=\'text\']').val('');
				$('input[name=\'rating\']:checked').attr('checked', '');
				$('input[name=\'captcha\']').val('');
			}
		}
	});
}
//--></script> 
<script type="text/javascript"><!--
$.tabs('.tabs a'); 
//--></script> 
<?php echo $footer; ?> 