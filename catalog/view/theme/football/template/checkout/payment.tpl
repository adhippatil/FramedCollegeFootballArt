<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>

<div id="content">
	<div class="top">
		<div class="left"></div>
		<div class="right"></div>
		<div class="center">
			<h1><?php echo $heading_title; ?></h1>
		</div>
	</div>
	
	<div class="middle">
		<?php if ($success) { ?>
			<div class="success"><?php echo $success; ?></div>
		<?php } ?>
		
		<?php if ($error_warning) { ?>
			<div class="warning"><?php echo $error_warning; ?></div>
		<?php } ?>
					
		<div class="clearfix">
		
			<div class="left">
				<h2><?php echo $text_payment_address; ?></h2>
				<div class="content">
					<?php echo $address; ?>
					<div><a onclick="location = '<?php echo str_replace('&', '&amp;', $change_address); ?>'" class="button"><span><?php echo $button_change_address; ?></span></a></div>
				</div>		
				
								
				<form action="<?php echo str_replace('&', '&amp;', $action); ?>" method="post" enctype="multipart/form-data" id="payment">
					<?php if ($payment_methods) { ?>
					<h2><?php echo $text_payment_method; ?></h2>
					<div class="content details_box">
						<p><?php echo $text_payment_methods; ?></p>
						<table width="100%" cellpadding="3">
							<?php foreach ($payment_methods as $payment_method) { ?>
							<tr>
								<td width="1"><?php if ($payment_method['id'] == $payment || !$payment) { ?>
									<?php $payment = $payment_method['id']; ?>
									<input type="radio" name="payment_method" value="<?php echo $payment_method['id']; ?>" id="<?php echo $payment_method['id']; ?>" checked="checked" style="margin: 0px;" />
									<?php } else { ?>
									<input type="radio" name="payment_method" value="<?php echo $payment_method['id']; ?>" id="<?php echo $payment_method['id']; ?>" style="margin: 0px;" />
									<?php } ?></td>
								<td><label for="<?php echo $payment_method['id']; ?>" style="cursor: pointer;"><?php echo $payment_method['title']; ?></label></td>
							</tr>
							<?php } ?>
						</table>
						<img src="/catalog/view/theme/football/images/icon_payment.jpg" alt="payment options">
					</div>
					<?php } ?>
					
					<div class="content" style="display: none;">
						<textarea name="comment" rows="8" style="width: 99%;"><?php echo $comment; ?></textarea>
					</div>			
				</form>
			</div>
			
			<div class="right">
				<h2>Discount Options</h2>
				<?php if ($gift_voucher_status) { ?>
					<div class="content">
						<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="gift_voucher">
							<!--<p style="text-align:right;"><?php echo $text_gift_voucher; ?></p>-->
							<div style="text-align:right; float:right;"><?php echo $entry_gift_voucher; ?>&nbsp;
								<input type="text" name="gift_voucher" value="<?php echo $gift_voucher; ?>" />
								&nbsp;<a onclick="$('#gift_voucher').submit();" class="button"><span><?php echo $button_gift_voucher; ?></span></a></div>
						</form>
						<div id="groupon-help"><a href="/image/data/img_groupon_help.gif" class="thickbox">CLICK HERE if you need help finding your GROUPON code</a></div>
						<div class="fixFF"></div>
					</div>
				<?php } ?>
				<?php if ($coupon_status) { ?>
					<div class="content" style="margin:30px 0px;">
						<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="coupon">
							<!--<p style="text-align: right;"><?php echo $text_coupon; ?></p>-->
							<div style="text-align: right;"><?php echo $entry_coupon; ?>&nbsp;
								<input type="text" name="coupon" value="<?php echo $coupon; ?>" />
								&nbsp;<a onclick="$('#coupon').submit();" class="button"><span><?php echo $button_coupon; ?></span></a></div>
						</form>
					</div>
				<?php } ?>		
			
			</div>
		</div>	
		
		<?php if ($text_agree) { ?>
			<div class="buttons">
				<table>
					<tr>
						<td align="left"><a onclick="location = '<?php echo str_replace('&', '&amp;', $back); ?>'" class="button"><span><?php echo $button_back; ?></span></a></td>
						<td align="right" style="padding-right: 5px;"><?php echo $text_agree; ?></td>
						<td width="5" style="padding-right: 10px;"><?php if ($agree) { ?>
							<input type="checkbox" name="agree" value="1" checked="checked" />
							<?php } else { ?>
							<input type="checkbox" name="agree" value="1" />
							<?php } ?></td>
						<td align="right" width="5"><a onclick="$('#payment').submit();" class="button"><span><?php echo $button_continue; ?></span></a></td>
					</tr>
				</table>
			</div>
		<?php } else { ?>
			<div class="buttons">
				<table>
					<tr>
						<td align="left"><a onclick="location = '<?php echo str_replace('&', '&amp;', $back); ?>'" class="button"><span><?php echo $button_back; ?></span></a></td>
						<td align="right"><a onclick="$('#payment').submit();" class="button"><span><?php echo $button_continue; ?></span></a></td>
					</tr>
				</table>
			</div>
		<?php } ?>
		
	</div>
	
	
	
	<div class="bottom">
		<div class="left"></div>
		<div class="right"></div>
		<div class="center"></div>
	</div>
	
</div>

<?php echo $footer; ?> 