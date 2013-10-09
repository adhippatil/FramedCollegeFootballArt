<?php echo $header; ?>

<?php echo $column_left; ?>
<?php echo $column_right; ?>

<div id="content">
	<div class="top">
		<div class="left"></div>
		<div class="right"></div>
		<div class="center">
			<h1><?php echo $heading_title; ?></h1>
		</div>
	</div>
	
	<div class="middle">
	
		<?php if ($error_warning) { ?>
			<div class="warning"><?php echo $error_warning; ?></div>
		<?php } ?>
				
		<form action="<?php echo str_replace('&', '&amp;', $action); ?>" method="post" enctype="multipart/form-data" id="shipping">
			
			<div class="clearfix">
			
				<div class="left">
					<h2><?php echo $text_shipping_address; ?></h2>
					<div class="content">
					
						<?php echo $address; ?>
						<div>
							<a onclick="location = '<?php echo str_replace('&', '&amp;', $change_address); ?>'" class="button"><span>Change Shipping Address</span></a>
						</div>
						
					</div>
				</div>
				
				<div class="right">
					
					<?php if ($shipping_methods) { ?>
						<h2><?php echo $text_shipping_method; ?></h2>
						<div class="content details_box">
							<p><?php echo $text_shipping_methods; ?></p>
							<table width="100%" cellpadding="3">
								<?php foreach ($shipping_methods as $shipping_method) { ?>
									<?php if (!$shipping_method['error']) { ?>
										<?php foreach ($shipping_method['quote'] as $quote) { ?>
											<tr>
												<td width="1"><label for="<?php echo $quote['id']; ?>">
														<?php if ($quote['id'] == $shipping || !$shipping) { ?>
														<?php $shipping = $quote['id']; ?>
														<input type="radio" name="shipping_method" value="<?php echo $quote['id']; ?>" id="<?php echo $quote['id']; ?>" checked="checked" style="margin: 0px;" />
														<?php } else { ?>
														<input type="radio" name="shipping_method" value="<?php echo $quote['id']; ?>" id="<?php echo $quote['id']; ?>" style="margin: 0px;" />
														<?php } ?>
													</label></td>
												<td width="534"><label for="<?php echo $quote['id']; ?>" style="cursor: pointer;"><?php echo $quote['title']; ?></label></td>
												<td width="1" align="right"><label for="<?php echo $quote['id']; ?>" style="cursor: pointer;"><?php echo $quote['text']; ?></label></td>
											</tr>
										<?php } ?>
										<?php } else { ?>
											<tr>
												<td colspan="3"><div class="error"><?php echo $shipping_method['error']; ?></div></td>
											</tr>
									<?php } ?>
								<?php } ?>
							</table>
						</div>
					<?php } ?>
					
					<b style="margin-bottom: 2px; display: block; font-size:14px;"><?php echo $text_comments; ?></b>
					<div class="content">
						<textarea name="comment" rows="8" style="width: 99%;"><?php echo $comment; ?></textarea>
					</div>
				</div>
			
			</div>
			
			<div class="buttons">
				<table>
					<tr>
						<td align="left"><a onclick="location = '<?php echo str_replace('&', '&amp;', $back); ?>'" class="button"><span><?php echo $button_back; ?></span></a></td>
						<td align="right"><a onclick="$('#shipping').submit();" class="button"><span><?php echo $button_continue; ?></span></a></td>
					</tr>
				</table>
			</div>
			
		</form>
		
	</div>
	
	<div class="bottom">
		<div class="left"></div>
		<div class="right"></div>
		<div class="center"></div>
	</div>
	
</div>
<?php echo $footer; ?> 