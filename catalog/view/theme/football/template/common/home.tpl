<?php echo $header; ?>

<?php echo $column_left; ?>
<?php //echo $column_right; ?>

<div id="content">
	
	<div id="slider">
		<img src="/image/data/photoslideshow_1.jpg" />
		<img src="/image/data/photoslideshow_2.jpg" />
		<img src="/image/data/photoslideshow_3.jpg" />
		<img src="/image/data/photoslideshow_4.jpg" />
	</div>		
	
	<?php foreach ($modules as $module) { ?>
		<?php echo ${$module['code']}; ?>
	<?php } ?>
	
	<div id="categories_home_wrapper" class="clearfix">
		<div class="category_list">
			<img src="/image/category_schools.png" />
			<h3>SCHOOLS</h3>
			<ul>
				<li><a href="/alabama-crimson-tide">University of Alabama</a></li>
				<li><a href="/index.php?route=product/category&path=37">University of Florida</a></li>
				<li><a href="/index.php?route=product/category&path=57">Florida State University</a></li>
				<li><a href="/index.php?route=product/category&path=39">Auburn University</a></li>
				<li>&nbsp;</li>
				<li><a href="/Schools">View All &raquo;</a></li>
			</ul>
		</div>
		
		<div class="category_list">
			<img src="/image/category_artists.png" />
			<h3>ARTISTS</h3>
			<ul>
				<li><a href="/daniel-moore-prints">Daniel Moore</a></li>
				<li><a href="/greg-gamble-prints">Greg Gamble</a></li>
				<li><a href="/larry-pitts-prints">Larry Pitts</a></li>
				<li><a href="/mark-broome-prints">Mark Broome</a></li>
			</ul>
		</div>
		
		<div class="category_list">
			<img src="/image/category_BSC.png" />
			<h3>BSC</h3>
			<ul>
				<li><a href="/bowl-championship-series-national-championship-framed-prints-pictures-artwork">2012 Championship</a></li>
				<li><a href="/bowl-championship-series-national-championship-framed-prints-pictures-artwork">2011 Championship</a></li>
				<li><a href="/bowl-championship-series-national-championship-framed-prints-pictures-artwork">2010 Championship </a></li>
			</ul>
		</div>
		
		<div class="category_list">
			<img src="/image/category_bestSellers.png" />
			<h3>BEST SELLERS</h3>
			<ul>
				<li><a href="/never-again-larry-pitts">Never Again</a></li>
				<li><a href="/the-man-of-steel-greg-gamble">The Man Of Steel</a></li>
				<li><a href="/crimson-redemption-larry-pitts">Crimson Redemption</a></li>
				<li><a href="/2011-bcs-championship-scoreboard">2011 BCS Championship Scoreboard</a></li>
			</ul>
		</div>
		
		<div class="category_list">
			<img src="/image/category_latest.png" />
			<h3>NEW ARRIVALS</h3>
			<ul>
				<li><a href="/crimson-redemption-larry-pitts">Crimson Redemption</a></li>
				<li><a href="/2011-bcs-championship-scoreboard">2011 BCS Championship Scoreboard</a></li>
				<li><a href="/a-j-mccarron-mvp">A.J. McCarron MVP</a></li>
				<li><a href="/the-takeaway-greg-gamble">The Takeaway</a></li>
			</ul>
		</div>
		
		<div class="category_list">
			<img src="/image/category_clearance.png" />
			<h3>CLEARANCE</h3>
			<ul>
				<li><a href="/clearance-a-crimson-tradition-daniel-moore">A Crimson Tradition</a></li>
				<li><a href="/clearance-armed-and-dangerous-larry-pits">Armed and Dangerous</a></li>
				<li><a href="/clearance-gamebreaker-larry-pitts"> Gamebreaker</a></li>
				<li><a href="/clearance-2008-iron-bowl-scoreboard"> Iron Bowl Scoreboard</a></li>
				<li>&nbsp;</li>
				<li><a href="/clearance">View All &raquo;</a></li>
			</ul>
		</div>
		
		
	</div>
	
	<div id="welcome" class="clearfix">
		<div id="heading"><a href="/blog"><img src="/image/heading_welcome.gif" /></a></div>
		<div id="welcome_message">
			<?=$welcome?>
		</div>
	</div>
	
	<div id="blog_container" class="clearfix">
		<div id="heading"><a href="/blog"><img src="/image/heading_blog.gif" /></a></div>
		<div id="blog_entries">
			<?=$blog;?>
		</div>
	</div>
    		  
</div>

<script type="text/javascript">
$(window).load(function() {
    $('#slider').nivoSlider({ directionNav: false, pauseTime: 6000});
});
</script>

<?php echo $footer; ?> 