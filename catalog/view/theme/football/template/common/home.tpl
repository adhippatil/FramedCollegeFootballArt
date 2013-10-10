<?php echo $header; ?>

<?php echo $column_left; ?>
<?php //echo $column_right; ?>

<div id="content">
	
	<div id="slider">
    	<a href="/2012-season-bowl-game-prints"><img src="/image/data/photoslideshow_9.jpg"></a>
    	<img src="/image/data/photoslideshow_7.jpg" />
        <a href="/new-arrivals"><img src="/image/data/photoslideshow_1.jpg"></a>
		<a href="/winning-streak"><img src="/image/data/photoslideshow_2.jpg"></a>
        <a href="/clearance"><img src="/image/data/photoslideshow_6.jpg"></a>
		<img src="/image/data/photoslideshow_4.jpg" />
	</div>		
	
	<?php foreach ($modules as $module) { ?>
		<?php echo ${$module['code']}; ?>
	<?php } ?>
	
	<div id="categories_home_wrapper" class="clearfix">
		<div class="category_list">
			<img src="/image/category_schools1.png" />
			<h3>SCHOOLS</h3>
			<ul>
				<li><a href="/alabama-crimson-tide-football-prints-pictures-art">University of Alabama</a></li>
				<li><a href="/university-of-florida-gators-prints">University of Florida</a></li>
				<li><a href="/florida-state-university-seminoles-prints">Florida State University</a></li>
				<li><a href="/louisiana-state-university-pictures-prints-artwork">Louisiana State University</a></li>
                <li>&nbsp;</li>
				<li><a href="/college-football-art-by-school-college-univeristy">View All &raquo;</a></li>
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
			<h3>BOWL GAMES</h3>
			<ul>
				<li><a href="/2012-season-bowl-game-prints">2012</a></li>
                <li><a href="/2011-season-bowl-game-prints">2011</a></li>
				<li><a href="/2010-season-bowl-game-prints">2010</a></li>
				<li><a href="/2009-season-bowl-game-prints">2009</a></li>
                <li><a href="/2008-season-bowl-game-prints">2008</a></li>
			</ul>
		</div>
		
		<div class="category_list">
			<img src="/image/category_bestSellers.png" />
			<h3>BEST SELLERS</h3>
			<ul>
            	<li><a href="/restoring-the-order-regular-edition-daniel-moore">Restoring The Order</a></li>
				<li><a href="/war-paint-greg-gamble">War Paint</a></li>
				<li><a href="/the-man-of-steel-greg-gamble">The Man Of Steel</a></li>
				<li><a href="/crimson-redemption-larry-pitts">Crimson Redemption</a></li>
                <li>&nbsp;</li>
				<li><a href="/college-football-gifts">View All &raquo;</a></li>
               
			</ul>
		</div>
		
		<div class="category_list">
			<img src="/image/category_latest.png" />
			<h3>NEW ARRIVALS</h3>
			<ul>
            	<li><a href="/the-dynasty-greg-gamble">The Dynasty</a></li>
				<li><a href="/crimson-crush-larry-pitts">Crimson Crush</a></li>
				<li><a href="/2013-bcs-national-champsionship-panoramic-50-blakeway">2013 BCS Panoramic</a></li>
                <li><a href="/15-Years">15 Years</a></li>
                <li><a href="/Back-2-Back-USA-Sports">Back 2 Back</a></li>
                <li>&nbsp;</li>
				<li><a href="/new-arrivals">View All &raquo;</a></li>
			</ul>
		</div>
		
		<div class="category_list">
			<img src="/image/category_clearance.png"/>
			<h3>CLEARANCE</h3>
			<ul>
				<li><a href="/bear-bryant-greg-gamble-clearance">Bear Bryant</a></li>
				<li><a href="/supercam-rick-rush-clearance">SuperCam</a></li>
				<li><a href="/the-coach-and-315-daniel-moore-clearance">The Coach & 315</a></li>
                <li><a href="/wesscott-gate-russell-grace-clearance">Westcott Gate</a></li>
				<li><a href="/armed-and-dangerous-larry-pitts-clearance">Armed and Dangerous</a></li>
                <li>&nbsp;</li>
				<li><a href="/clearance">View All &raquo;</a></li>
			</ul>
		</div>
		
		
	</div>
	
	<div id="welcome">
	
		<div id="welcome_message" class="welcome">
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