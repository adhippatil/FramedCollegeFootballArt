<?php if (isset($_SERVER['HTTP_USER_AGENT']) && !strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 6')) echo '<?xml version="1.0" encoding="UTF-8"?>'. "\n"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" xml:lang="<?php echo $lang; ?>">
<head>
<title><?php echo $title; ?></title>
<?php if ($keywords) { ?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php } ?>
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<base href="<?php echo $base; ?>" />
<?php if ($icon) { ?>
<link href="<?php echo $icon; ?>" rel="icon" />
<?php } ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo str_replace('&', '&amp;', $link['href']); ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/<?php echo $template; ?>/stylesheet/stylesheet.css" />
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/ie6.css" />
<script type="text/javascript" src="catalog/view/javascript/DD_belatedPNG_0.0.8a-min.js"></script>
<script>
DD_belatedPNG.fix('img, #header .div3 a, #content .left, #content .right, .box .top');
</script>
<![endif]-->
<?php foreach ($styles as $style) { ?>
<link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<script type="text/javascript" src="catalog/view/javascript/jquery/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/thickbox/thickbox-compressed.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/tab.js"></script>
<script type="text/javascript" src="catalog/view/javascript/common.js"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/thickbox/thickbox.css" />

<!-- NIVO SLIDER -->
<script type="text/javascript" src="catalog/view/javascript/jquery.nivo.slider.pack.js"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/nivo-slider.css" />


<?php foreach ($scripts as $script) { ?>
<script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php } ?>
<script type="text/javascript"><!--
function bookmark(url, title) {
	if (window.sidebar) { // firefox
    window.sidebar.addPanel(title, url, "");
	} else if(window.opera && window.print) { // opera
		var elem = document.createElement('a');
		elem.setAttribute('href',url);
		elem.setAttribute('title',title);
		elem.setAttribute('rel','sidebar');
		elem.click();
	} else if(document.all) {// ie
   		window.external.AddFavorite(url, title);
	}
}
//--></script>
</head>
<body>
<div id="container">
	<div id="header">
	
	
		<div class="div1">
			<a href="index.php"><img src="/catalog/view/theme/football/images/logo_header.png" alt="Purchase an artistic piece of College Football History" align="left" style="margin-top:15px;" /></a>
		  <!--<div class="div2"><a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $store; ?>" alt="<?php echo $store; ?>" /></a></div>-->
			<div class="div3">
				<?php //echo $search; ?>		
				<ul id="menu_header">
					<li><a href="index.php">Home</a></li>
					<li><a href="college-football-prints">About</a></li>
					<li><a href="faq">FAQ</a></li>
					<li><a href="blog">Blog</a></li>
					<li><a href="index.php?route=information/contact">Contact</a></li>
					<?php if($logged){ ?>
						<li><a href="index.php?route=account/account">Account</a></li>	
						<li><a href="index.php?route=account/logout">Logout</a></li>				
					<?php } else { ?>
						<li><a href="<?php echo $account; ?>">Login</a></li>
					<?php } ?>
					<li><a href="<?php echo $cart; ?>">Cart</a></li>
					<li><a href="<?php echo $checkout; ?>">Checkout</a></li>
				</ul>
			</div>
		</div>
	  
	  	<div id="breadcrumb">
			<?php foreach ($breadcrumbs as $breadcrumb) { ?>
			  <?php echo $breadcrumb['separator']; ?><a href="<?php echo str_replace('&', '&amp;', $breadcrumb['href']); ?>"><?php echo $breadcrumb['text']; ?></a>
			<?php } ?>
     	</div>
	  
	</div>
	
	

	<!-- SOCIAL MEDIA -->
	<div id="social">
		
		<div id="social_fb">
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) {return;}
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_US/all.js#appId=235878729797919&xfbml=1";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
			
			<div class="fb-like" data-href="https://www.facebook.com/pages/Framed-College-Football-Art/171476376198066" data-send="false" data-layout="button_count" data-width="150" data-show-faces="false"></div>
		</div>
		
		<div id="social_tw">
			<a href="https://twitter.com/FCFootballArt" class="twitter-follow-button" data-text-color="#FFFFFF" data-link-color="#FFFFFF" data-show-count="false">Follow @FCFootballArt</a>
			<script src="//platform.twitter.com/widgets.js" type="text/javascript"></script>
		</div>
	
		<div id="social_rss">
			<a href="/blog/rss/" target="_blank"><img src="/image/data/icon_rss.png" /></a>
		</div>
		
		<div class="fixFF"></div>
		
	</div>
	
	
	
	<div id="wrapper_content">	
	
	
	
<script type="text/javascript"><!-- 
function getURLVar(urlVarName) {
	var urlHalves = String(document.location).toLowerCase().split('?');
	var urlVarValue = '';
	
	if (urlHalves[1]) {
		var urlVars = urlHalves[1].split('&');

		for (var i = 0; i <= (urlVars.length); i++) {
			if (urlVars[i]) {
				var urlVarPair = urlVars[i].split('=');
				
				if (urlVarPair[0] && urlVarPair[0] == urlVarName.toLowerCase()) {
					urlVarValue = urlVarPair[1];
				}
			}
		}
	}
	
	return urlVarValue;
} 

$(document).ready(function() {
	route = getURLVar('route');
	
	if (!route) {
		$('#tab_home').addClass('selected');
	} else {
		part = route.split('/');
		
		if (route == 'common/home') {
			$('#tab_home').addClass('selected');
		} else if (route == 'account/login') {
			$('#tab_login').addClass('selected');	
		} else if (part[0] == 'account') {
			$('#tab_account').addClass('selected');
		} else if (route == 'checkout/cart') {
			$('#tab_cart').addClass('selected');
		} else if (part[0] == 'checkout') {
			$('#tab_checkout').addClass('selected');
		} else {
			$('#tab_home').addClass('selected');
		}
	}
});
//--></script>
<script type="text/javascript"><!--
$('#search input').keydown(function(e) {
	if (e.keyCode == 13) {
		moduleSearch();
	}
});

function moduleSearch() {	
	pathArray = location.pathname.split( '/' );
	
	url = location.protocol + "//" + location.host + "/" + pathArray[1] + '/';
		
	url += 'index.php?route=product/search';
		
	var filter_keyword = $('#filter_keyword').attr('value')
	
	if (filter_keyword) {
		url += '&keyword=' + encodeURIComponent(filter_keyword);
	}
	
	var filter_category_id = $('#filter_category_id').attr('value');
	
	if (filter_category_id) {
		url += '&category_id=' + filter_category_id;
	}
	
	location = url;
}
//--></script>
<script type="text/javascript"><!--
$('.switcher').bind('click', function() {
	$(this).find('.option').slideToggle('fast');
});
$('.switcher').bind('mouseleave', function() {
	$(this).find('.option').slideUp('fast');
}); 
//--></script>
