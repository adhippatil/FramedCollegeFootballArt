<?php echo $header; ?>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<?php if ($success) { ?>
<div class="success"><?php echo $success; ?></div>
<?php } ?>

<div class="heading">
	<h1>Update Footer Links</h1>
</div>

	<table class="list">
		<thead>
			<tr>
				<td class="left wide">URL</td>
				<td class="left" width="150">Title</td>
				<td class="left" width="20">Sort Order</td>
				<td class="left" width="10" colspan="2">Action</td>
			</tr>
		</thead>
		<tbody>
			<tr class="odd">
				<form action="<?php echo $insert; ?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="from" value="insert" />
					<td class="left wide"><input type="text" name="url" size="55" /></td>
					<td class="left"><input type="text" name="title" size="30" /></td>
					<td class="left"><input type="text" name="sort" size="3" /></td>
					<td class="left" width="10" colspan="2"><input type="submit" name="insert" value="INSERT" /></td>	
				</form>				
			</tr>
			
			<?php if ($links) { ?>
			<?php $class = 'odd'; ?>
			<?php foreach ($links as $link) { ?>
			<?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
			<tr class="<?php echo $class; ?>">		
			
				<?php if(isset($action) && $uid==$link['id'] ){ ?>
					<form action="<?php echo $update; ?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="from" value="update" />
						<input type="hidden" name="id" value="<?php echo $link['id']; ?>" /> 
						<td class="left wide"><input type="text" name="url" size="55" value="<?php echo $link['url']; ?>" /></td>
						<td class="left"><input type="text" name="title" size="30" value="<?php echo $link['title']; ?>" /></td>
						<td class="left"><input type="text" name="sort" size="3" value="<?php echo $link['sort']; ?>" /></td>
						<td class="left" width="10" colspan="2"><input type="submit" name="update" value="UPDATE" /></td>
					</form>			
				<?php } else { ?>
					<form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="from" value="delete" />
						<input type="hidden" name="id" value="<?php echo $link['id']; ?>" /> 
						<td class="left wide"><?php echo $link['url']; ?></td>
						<td class="left"><?php echo $link['title']; ?></td>
						<td class="left"><?php echo $link['sort']; ?></td>
						<td class="left" width="10"><input type="submit" name="delete" value="Delete" /></td>
					</form>	
					
					<form action="<?php echo $edit; ?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="from" value="edit" />
						<input type="hidden" name="id" value="<?php echo $link['id']; ?>" /> 
						<input type="hidden" name="url" value="<?php echo $link['url']; ?>" /> 
						<input type="hidden" name="title" value="<?php echo $link['title']; ?>" /> 
						<input type="hidden" name="sort" value="<?php echo $link['sort']; ?>" /> 
						<td class="left" width="10"><input type="submit" name="update" value="edit" /></td>
					</form>		
				<?php } ?>
				
			</tr>
			<?php } ?>
			<?php } else { ?>
			<tr class="even">
				<td class="center" colspan="4"><?php echo $text_no_results; ?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>

<?php echo $footer; ?>