<div id="column_left">

	<div id="leftMods">
	  <?php foreach ($modules as $module) { ?>
	  <?php echo ${$module['code']}; ?>
	  <?php } ?>  
	</div>
	
	<?php if($pageTitle == "/" || $pageTitle == "/index.php" || $pageTitle == "/index.php?route=common/home"){ ?>
		<div id="facebookFeed">
			<img src="/image/data/banner_ShippingFraming.jpg" /></a>
		</div>
	<?php } ?>
</div>

