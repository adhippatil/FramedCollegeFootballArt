<?php echo $header; ?>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<?php if ($success) { ?>
<div class="success"><?php echo $success; ?></div>
<?php } ?>
<div class="box">
  <div class="left"></div>
  <div class="right"></div>
  <div class="heading">
    <h1 style="background-image: url('view/image/product.png');"><?php echo $heading_title; ?></h1>
    </div>
    <div class="content">
      <form action="<?php echo $bulk_action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="form">
          <tr>
            <td colspan="2"><?php echo $entry_bulkattent; ?></td>
          </tr>
          <tr>
            <td width="5%"><?php echo $entry_file; ?></td>
            <td><input type="file" name="upload" /></td>
          </tr>
          <tr>
            <td width="5%"><?php echo $entry_bulktype; ?></td>
            <td><label><input type="radio" name="bulktype" value="1" checked="checked" />Insert</label>&nbsp;&nbsp;&nbsp;&nbsp;
            <label><input type="radio" name="bulktype" value="0" />Update</label></td>
          </tr>
           <tr>
            <td width="5%">&nbsp;</td>
            <td><a onclick="$('#form').submit();" class="button"><span><?php echo $bulk_upload; ?></span></a></td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>
<?php echo $footer; ?>