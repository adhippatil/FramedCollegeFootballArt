<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="top">
    <div class="center">
      <h1><?php echo $heading_title; ?></h1>
    </div>
  </div>
  <div class="middle"><?php echo $description; ?>
    <div class="buttons">
      <table>
        <tr>
          <td align="right"><a onclick="location = '<?php echo str_replace('&', '&amp;', $continue); ?>'" class="button"><span><?php echo $button_continue; ?></span></a></td>
        </tr>
      </table>
    </div>
  </div>
</div>
<?php echo $footer; ?> 