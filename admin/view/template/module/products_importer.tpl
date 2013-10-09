<?php echo $header; ?>
<div id="content">
<div class="breadcrumb">
  <?php foreach ($breadcrumbs as $breadcrumb) { ?>
  <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
  <?php } ?>
</div>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<div class="box">
  <div class="heading">
    <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
  </div>
  <div class="content">
  <fieldset>
	<legend><?php echo $text_import_or_sincronize_title; ?></legend>
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form_product_importer">
    <table border="0px" width="100%" id="module" class="list">
    	<tr>
    		<td colspan="2">
    		      <fieldset>
			      	<legend><?php echo $text_csv_example_title; ?></legend>
			      	    <table>
		            		<tr>
		            			<td><?php echo $text_csv_head_example; ?></td>
		            		</tr>
		            		<tr>
		            			<td><?php echo $text_csv_row_example; ?></td>
		            		</tr>
		            	</table>
			      </fieldset>
    		</td>
    	</tr>
    	<tr valign="top">
    		<td width="50%">
    		      <fieldset>
			      	<legend><?php echo $text_product_row_options ?></legend>
						<table border="0px">
						            <tr>
						            	<td><?php echo $default_product_title; ?></td>
						             	<td><select name="product_id">
						                  <?php foreach ($products as $product) { ?>
						                  <?php if ($product['product_id'] == $product_id) { ?>
						                  <option value="<?php echo $product['product_id']; ?>" selected="selected"><?php echo $product['model']; ?></option>
						                  <?php } else { ?>
						                  <option value="<?php echo $product['product_id']; ?>"><?php echo $product['model']; ?></option>
						                  <?php } ?>
						                  <?php } ?>
						                </select></td>
						            </tr>
						            <tr>
						            	<td><?php echo $default_tax_title; ?></td>
						             	<td><select name="tax_class_id">
						                  <?php foreach ($tax_classes as $tax_class) { ?>
						                  <?php if ($tax_class['tax_class_id'] == $tax_class_id) { ?>
						                  <option value="<?php echo $tax_class['tax_class_id']; ?>" selected="selected"><?php echo $tax_class['title']; ?></option>
						                  <?php } else { ?>
						                  <option value="<?php echo $tax_class['tax_class_id']; ?>"><?php echo $tax_class['title']; ?></option>
						                  <?php } ?>
						                  <?php } ?>
						                </select></td>
						            </tr>
						            <tr>
						            	<td><?php echo $default_category_title; ?></td>
						                <td><select name="category_id">
						                  <?php foreach ($categories as $categorie) { ?>
						                  <?php if ($categorie['category_id'] == $category_id) { ?>
						                  <option value="<?php echo $categorie['category_id']; ?>" selected="selected"><?php echo $categorie['name']; ?></option>
						                  <?php } else { ?>
						                  <option value="<?php echo $categorie['category_id']; ?>"><?php echo $categorie['name']; ?></option>
						                  <?php } ?>
						                  <?php } ?>
						                </select>
						               </td>
						            </tr>
						      </table>
			      </fieldset>
    		</td>
    		<td width="50%">
    		      <fieldset>
			      	<legend><?php echo $text_settings ?></legend>
					<table>
			            <tr>
			            	<td><?php echo $default_image_download_title; ?></td>
			                <td><select name="image_download">
			                  <option value="allow_url_fopen">allow_url_fopen</option>
			                  <option value="curl">curl</option>
			                </select>
			               </td>
			            </tr>
			            <tr>
			            	<td><?php echo $update_products_if_model_text_equal; ?></td>
			                <td>
			                 <input type="checkbox" id="update_products" name="update_products" checked="checked" value="yes"  />
			               </td>
			            </tr>
			            <tr>
			            	<td><?php echo $text_delimiter ?></td>
			            	<td><input type="input" id="delimiter" name="delimiter" value=","  /></td>
			            </tr>
			            <tr>
			            	<td><?php echo $text_enclosure ?></td>
			            	<td><input type="input" id="enclosure" name="enclosure" value="&quot;"  /></td>
			            </tr>
			            <tr>
			            	<td><?php echo $text_escape ?></td>
			            	<td><input type="input" id="escape" name="escape" value="\"  /></td>
			            </tr>
					</table>
			      </fieldset>
    		</td>
    	</tr>
    	<tr>
    		<td colspan="2">
    		      <fieldset>
			      	<legend><?php echo $text_execute ?></legend>
					<table>
						<tr>
							<td colspan="2">
								<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
								<?php echo $text_choose_file_upload; ?> <input name="uploadedfile" id="uploadedfile" type="file" /><br />
								<input type="submit" value="<?php echo $text_upload_file; ?>" />
							</td>
						</tr>
						<tr>
							<td colspan="2"><?php echo $observations; ?></td>
						</tr>
					</table>
			      </fieldset>
    		</td>
    	</tr>
    	<tfoot>
		    <tr>
		        <td style="vertical-align: middle;" colspan="2"><?php echo $entry_version_status ?></td>
		    </tr>
        </tfoot>
    </table>
    </form>
    </fieldset>
    <br>
    <fieldset>
		<legend><?php echo $text_export_title; ?></legend>
		<a href="<?php echo $export_csv; ?>" target="_blank"><?php echo $text_download_csv_title; ?></a> <span style="font-size: 10px"> <?php echo $text_download_csv_observations; ?></span>
	</fieldset>
  </div>
</div>
<?php echo $footer; ?>