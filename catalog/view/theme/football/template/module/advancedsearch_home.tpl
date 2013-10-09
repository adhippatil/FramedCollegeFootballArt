<div class="top"> 
    <div class="heading"><?php echo $heading_title; ?></div>
</div>
  <div class="middle">
     <table border="0">
         <tr>
          <td colspan="2"><?php echo $entry_search; ?></td>
          <td colspan="2"><?php if ($keyword) { ?>
           		<input type="text" value="<?php echo $keyword; ?>" id="keyword" />
            <?php } else { ?>
            	<input type="text" value="keyword" id="keyword" />
            <?php } ?></td>
        </tr>
  </table>

      <table border="0">
          <tr>
          <td colspan="2"><?php echo $entry_category; ?></td>
          <td colspan="2">
            <select id="category_id">
              <option value=""><?php echo $text_category; ?></option>
              <?php foreach ($categories as $category) { ?>
              <?php if ($category['category_id'] == $category_id) { ?>
              <option value="<?php echo $category['category_id']; ?>" selected="selected"><?php echo $category['name']; ?></option>
              <?php } else { ?>
              <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
              <?php } ?>
              <?php } ?>
            </select></td>
          <td colspan="2"><?php echo $entry_manufacture; ?></td>
          <td colspan="2">
          <select id="manufacturer_id">
              <option value=""><?php echo $text_manufacturer; ?></option>
          <?php foreach ($manufacturers as $manufacturer) { ?>
              <?php if ($manufacturer['manufacturer_id'] == $manufacturer_id) { ?>
              <option value="<?php echo $manufacturer['manufacturer_id']; ?>" selected="selected"><?php echo $manufacturer['name']; ?></option>
              <?php } else { ?>
              <option value="<?php echo $manufacturer['manufacturer_id']; ?>"><?php echo $manufacturer['name']; ?></option>

          <?php } ?>
          <?php } ?>
           </select>
          </td>
        </tr>
        </table>
     <table border="0">
        <tr>
          <td colspan="2"><?php echo $text_price; ?></td>
          <td align="right"><?php echo $text_pricemin; ?>&nbsp;</td>
          <td><input type="text" value="<?php echo $pricemin; ?>" id="pricemin" /></td>
          <td align="right"><?php echo $text_pricemax; ?>&nbsp;</td>
          <td><input type="text" value="<?php echo $pricemax; ?>" id="pricemax" /></td>
        </tr>
</table>
   <table border="0">
        <tr>
          <td colspan="2"><?php if ($description) { ?>
            <input type="checkbox" name="description" id="description" checked="checked" />
            <?php } else { ?>
            <input type="checkbox" name="description" id="description" />
            <?php } ?>
            <?php echo $entry_description; ?></td>
        </tr>
	<tr>
          <td colspan="2"><?php if ($model) { ?>
            <input type="checkbox" name="model" id="model" checked="checked" />
            <?php } else { ?>
            <input type="checkbox" name="model" id="model" />
            <?php } ?>
            <?php echo $entry_model; ?></td>
        </tr>

        <tr>
            <td align="right" colspan="2">

              <a onclick="contentAndvancedSearch();" class="button"><span><?php echo $button_search; ?></span></a>

              </td>
        </tr>

      </table>
    </div>

<script type="text/javascript"><!--
$('#box_search input').keydown(function(e) {
	if (e.keyCode == 13) {
		contentAndvancedSearch();
	}
});

function contentAndvancedSearch() {
	url = 'index.php?route=product/advancedsearch';

	var keyword = $('#keyword').attr('value');

	if (keyword) {
		url += '&keyword=' + encodeURIComponent(keyword);
	}

	var category_id = $('#category_id').attr('value');

	if (category_id) {
		url += '&category_id=' + encodeURIComponent(category_id);
	}

	if ($('#description').attr('checked')) {
		url += '&description=1';
	}

	if ($('#model').attr('checked')) {
		url += '&model=1';
	}

       var manufacturer_id = $('#manufacturer_id').attr('value');

	if (manufacturer_id) {
		url += '&manufacturer_id=' + encodeURIComponent(manufacturer_id);
	}

      var pricemin = $('#pricemin').attr('value');

	if (pricemin) {
		url += '&pricemin=' + encodeURIComponent(pricemin);
	}

       var pricemax = $('#pricemax').attr('value');

	if (pricemax) {
		url += '&pricemax=' + encodeURIComponent(pricemax);
	}
	location = url;
}
//--></script>