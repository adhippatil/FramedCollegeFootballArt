<?php
/*
 * Google Analytics PRO OpenCart Module
 * Author:		www.opencartstore.com
 * Version:		1.4.9.3
 * Support:		www.opencartstore.com/support
 * Email:		info@opencartstore.com
 * About:		Adds ecommerce tracking to your Google Analytics tracking.
 */
?>
<?php echo $header; ?>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<div class="box">
  <div class="left"></div>
  <div class="right"></div>
  
  <div class="heading">
    <h1 style="background-image: url('view/image/module.png');"><?php echo $heading_title; ?></h1>
    <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location='<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
  </div>
  
  <div class="content">
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
  <table class="form">
      <tr>
       <td><?php echo $entry_account_id; ?></td>
       <td><input name="googleanalytics_account_id" value="<?php echo $googleanalytics_account_id; ?>"> ie. UA-XXXXX-X</td>
      </tr>
      <tr>
        <td width="30%"><?php echo $entry_status ?></td>
        <td>
          <select name="googleanalytics_status">
            <?php if ($googleanalytics_status) { ?>
            <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
            <option value="0"><?php echo $text_disabled; ?></option>
            <?php } else { ?>
            <option value="1"><?php echo $text_enabled; ?></option>
            <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
            <?php } ?>
          </select>
        </td>
      </tr>
      <tr>
        <td style="vertical-align: middle;"><?php echo $entry_version_status ?></td>
	    <td style="vertical-align: middle;">1.4.9.3</td>
      </tr>
      <tr>
        <td valign="top"><?php echo $entry_author; ?></td>
        <td>
        Email: <a href="mailto:info@opencartstore.com">info@opencartstore.com</a><br />
	    Web: <a href="http://www.opencartstore.com/">http://www.opencartstore.com</a><br />
	    </td>
      </tr>
      <tr>
        <td>What is my Account ID?</td>
        <td><a href="http://code.google.com/apis/analytics/docs/concepts/gaConceptsAccounts.html#accountID">Visit Google documentation</a></td>
      </tr>
    </table>
    <input type="hidden" name="googleanalytics_position" value="left">
</form>
</div>
</div>
<?php echo $footer; ?>
