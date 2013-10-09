<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>

<div id="content">
	<div class="top">
		<div class="left"></div>
		<div class="right"></div>
		<div class="center">
			<h1><?php echo $heading_title; ?></h1>
		</div>
	</div>
	<div class="middle clearfix">
		<?php if ($success) { ?>
			<div class="success"><?php echo $success; ?></div>
		<?php } ?>
		<?php if ($error_warning) { ?>
			<div class="warning"><?php echo $error_warning; ?></div>
		<?php } ?>
		
		<div class="content clearfix">
		
			<div class="left">
				<h2>Shipping Details</h2>
				<div>
					<?php if ($shipping_address) { ?>
						<b><?php echo $text_shipping_address; ?></b><br />
						<?php echo $shipping_address; ?><br />
						( <a href="<?php echo str_replace('&', '&amp;', $checkout_shipping_address); ?>"><em><?php echo $text_change; ?></em></a> )
					<?php } ?>
					<br /><br />
					<?php if ($shipping_method) { ?>
						<b><?php echo $text_shipping_method; ?></b><br />
						<?php echo $shipping_method; ?><br />
						( <a href="<?php echo str_replace('&', '&amp;', $checkout_shipping); ?>"><em><?php echo $text_change; ?></em></a> )<br />
						<br />
					<?php } ?>
				</div>
			</div>
			
			<div class="right">
				<h2>Payment Details</h2>
				<div>
					<b><?php echo $text_payment_address; ?></b><br />
					<?php echo $payment_address; ?><br />
					( <a href="<?php echo str_replace('&', '&amp;', $checkout_payment_address); ?>"><em><?php echo $text_change; ?></em></a> )
					<br /><br />					
					<b><?php echo $text_payment_method; ?></b><br />
					<?php echo $payment_method; ?><br />
					( <a href="<?php echo str_replace('&', '&amp;', $checkout_payment); ?>"><em><?php echo $text_change; ?></em></a> )					
				</div>
			</div>
			
		</div>
		
		<div id="checkout-contact">
			Questions about ordering? Let us know <img src="/image/icon_phone_whiteBG.gif" /> 1-888-577-9696 or <img src="/image/icon_email.gif" id="img_email" /> <a href="mailto:info@framedcollegefootballart.com">send us an email</a>.
		</div>
		
		<div class="content" style="border: 1px solid #000;padding: 5px;">
			<h3>Shopping Cart</h3>
			<table width="100%">
				<tr>
					<th align="left"><?php echo $column_product; ?></th>
					<th align="left"><?php echo $column_model; ?></th>
					<th align="right"><?php echo $column_quantity; ?></th>
					<th align="right"><?php echo $column_price; ?></th>
					<th align="right"><?php echo $column_total; ?></th>
				</tr>
				<?php foreach ($products as $product) { ?>
				<tr>
					<td align="left" valign="top"><a href="<?php echo str_replace('&', '&amp;', $product['href']); ?>"><?php echo $product['name']; ?></a>
						<?php foreach ($product['option'] as $option) { ?>
						<br />
						&nbsp;<small> - <?php echo $option['value']; ?></small>
						<?php } ?></td>
					<td align="left" valign="top"><?php echo $product['model']; ?></td>
					<td align="right" valign="top"><?php echo $product['quantity']; ?></td>
					<td align="right" valign="top"><?php echo $product['price']; ?></td>
					<td align="right" valign="top"><?php echo $product['total']; ?></td>
				</tr>
				<?php } ?>
			</table>
			<br />			
			<div style="width: 100%; display: inline-block;">
				<table style="float: right; display: inline-block;">
					<?php foreach ($totals as $total) { ?>
					<tr>
						<td align="right"><?php echo $total['title']; ?></td>
						<td align="right"><?php echo $total['text']; ?></td>
					</tr>
					<?php } ?>
				</table>
				<br />
			</div>
		</div>
		
		<?php if ($gift_voucher_status) { ?>
		<div class="content" style="margin-top: 20px;">
			<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="gift_voucher">
				<div style="text-align: right; width: 500px; float:right;"><?php echo $entry_gift_voucher; ?>&nbsp;
					<input type="text" name="gift_voucher" value="<?php echo $gift_voucher; ?>" />
					&nbsp;<a onclick="$('#gift_voucher').submit();" class="button"><span><?php echo $button_gift_voucher; ?></span></a></div>
			</form>
			<div class="fixFF"></div>
		</div>
		<?php } ?>
		<?php if ($coupon_status) { ?>
		<div class="content" style="margin-top: 20px;">
			<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="coupon">
				<div style="text-align: right;"><?php echo $entry_coupon; ?>&nbsp;
					<input type="text" name="coupon" value="<?php echo $coupon; ?>" />
					&nbsp;<a onclick="$('#coupon').submit();" class="button"><span><?php echo $button_coupon; ?></span></a></div>
			</form>
		</div>
		<?php } ?>
		<?php if ($comment) { ?>
		<b style="margin-bottom: 2px; display: block;"><?php echo $text_comment; ?></b>
		<div class="content"><?php echo $comment; ?></div>
		<?php } ?>
		<div id="payment"><?php echo $payment; ?></div>
	</div>
	<div class="bottom">
		<div class="left"></div>
		<div class="right"></div>
		<div class="center"></div>
	</div>
</div>
<?php echo $footer; ?>