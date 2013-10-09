<div class="box" id="box_search">
	<div class="top" align="center"><img src="/catalog/view/theme/football/images/heading_search.gif" alt="" /></div>
	<div class="middle">
		<table border="0">
			<tr>
				<td colspan="2"><?php if ($keyword) { ?>
						<input type="text" value="<?php echo $keyword; ?>" id="keyword" name="keywords" />
					<?php } else { ?>
						<input type="text" value="keywords" id="keyword" name="keywords" />
					<?php } ?></td>
			</tr>
			<tr>
				<td>
					<table id="advenced_fields_details">				
						<tr>
							<td colspan="2"><select id="category_id">
									<option value=""><?php echo $text_category; ?></option>
									<?php foreach ($categories as $category) { ?>
									<?php if ($category['category_id'] == $category_id) { ?>
									<option value="<?php echo $category['category_id']; ?>" selected="selected"><?php echo $category['name']; ?></option>
									<?php } else { ?>
									<option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
									<?php } ?>
									<?php } ?>
								</select></td>
						</tr>
						<tr>
							<td colspan="2"><select id="manufacturer_id">
										<option value=""><?php echo $text_manufacturer; ?></option>
									<?php foreach ($manufacturers as $manufacturer) { ?>
									<?php if ($manufacturer['manufacturer_id'] == $manufacturer_id) { ?>
										<option value="<?php echo $manufacturer['manufacturer_id']; ?>" selected="selected"><?php echo $manufacturer['name']; ?></option>
									<?php } else { ?>
										<option value="<?php echo $manufacturer['manufacturer_id']; ?>"><?php echo $manufacturer['name']; ?></option>
									<?php } ?>
									<?php } ?>
								</select></td>
						</tr>
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
							<td align="right" colspan="2"><a onclick="contentAndvancedSearch();" class="button"><span><?php echo $button_search; ?> &rang;</span></a></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</div>
</div>
<div class="fixFF"></div>
<script type="text/javascript"><!--
$('#box_search input').keydown(function(e) {
	if (e.keyCode == 13) {
		contentAndvancedSearch();
	}
});
$('input#keyword').focus(function() {
	if($(this).val() == "keywords")
		$(this).val("");
});
$('input#keyword').blur(function() {
	if($(this).val() == ""){		
		$(this).val($(this).attr("name"));
		$("#advenced_fields_details").slideToggle('fast');
	}
});
$('input#keyword').focus(function() {
	if($(this).val() == "")	
		$("#advenced_fields_details").slideToggle('fast');
});

function contentAndvancedSearch() {
	url = 'index.php?route=product/advancedsearch';

	var keyword = $('#box_search #keyword').attr('value');

	if (keyword) {
		url += '&keyword=' + encodeURIComponent(keyword);
	}

	var category_id = $('#box_search #category_id').attr('value');

	if (category_id) {
		url += '&category_id=' + encodeURIComponent(category_id);
	}

	if ($('#box_search #description').attr('checked')) {
		url += '&description=1';
	}

	if ($('#box_search #model').attr('checked')) {
		url += '&model=1';
	}

       var manufacturer_id = $('#box_search #manufacturer_id').attr('value');

	if (manufacturer_id) {
		url += '&manufacturer_id=' + encodeURIComponent(manufacturer_id);
	}

      var pricemin = $('#box_search #pricemin').attr('value');

	if (pricemin && pricemin != "min price" && pricemin != "") {
		url += '&pricemin=' + encodeURIComponent(pricemin);
	}

       var pricemax = $('#box_search #pricemax').attr('value');

	if (pricemax && pricemax != "max price" && pricemax != "") {
		url += '&pricemax=' + encodeURIComponent(pricemax);
	}
	location = url;
}
//--></script>