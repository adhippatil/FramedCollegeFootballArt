<div class="box">
  <div class="top"><img src="catalog/view/theme/default/image/discount.png" alt="" /><?php echo $heading_title; ?></div>
  <div class="middle" style="text-align: left;">
  	<?php echo $text_check_balance; ?><br />
  	<form method="post" enctype="multipart/form-data" id="gift_voucher_check">
  	<input type="text" size="15" name="gift_voucher_code" value="<?php echo $gift_voucher_code; ?>" /> <a onclick="$('#gift_voucher_check').submit();" class="button"><span><?php echo $button_go; ?></span></a>
    <?php if ($show_captcha) { ?>
    <br /><?php echo $text_captcha; ?><br />
    <input type="text" name="captcha" value="" autocomplete="off" />
    <br />
    <img src="index.php?route=module/gift_voucher_module/captcha" id="captcha" />
    <?php } ?>
    </form>
    <?php echo $results; ?>
  </div>
  <div class="bottom">&nbsp;</div>
</div>
