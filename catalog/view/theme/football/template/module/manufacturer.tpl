<div class="box">
	<div id="manufacturers" class="middle sidebar_menu">
		<ul class="level_1">
			<li><a href="#">Artists</a>
				<ul class="level_2">
					<?php foreach($manufacturers as $manufacturer): ?>
					<li><a href="<?=$manufacturer['href']?>">
						<?=$manufacturer['name']?>
						</a></li>
					<?php endforeach; ?>
				</ul>
			</li>
		</ul>
	</div>
</div>
<div class="fixFF"></div>
