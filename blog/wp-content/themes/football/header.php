<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>
<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title>
<?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'football' ), max( $paged, $page ) );

	?>
</title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="/catalog/view/theme/football/stylesheet/stylesheet.css"



<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
<?php $logged = false; ?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){
	
	$('.sidebar_menu ul.level_1 li a').click(function(e){
		
		if($(this).parent().children('ul.level_2').size() > 0){
			e.preventDefault();
			$(this).next('ul.level_2').slideToggle(500);
		}
		
	});
		
});
</script>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed">
<header id="branding" role="banner">
	<hgroup>
		<div id="header">
			<div class="div1"> <a href="/index.php"><img src="/catalog/view/theme/football/images/logo_header.png" alt="Purchase an artistic piece of College Football History" align="left" style="margin-top:15px;" /></a> 
				<!--<div class="div2"><a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $store; ?>" alt="<?php echo $store; ?>" /></a></div>-->
				<div class="div3">
					<?php //echo $search; ?>
					<ul id="menu_header">
						<li><a href="/index.php">Home</a></li>
						<li><a href="/index.php?route=information/information&information_id=4">About</a></li>
						<li><a href="/index.php?route=information/information&information_id=6">FAQ</a></li>
						<li><a href="/index.php?route=information/contact">Contact</a></li>
						<?php if($logged){ ?>
						<li><a href="/index.php?route=account/account">Account</a></li>
						<li><a href="/index.php?route=account/logout">Logout</a></li>
						<?php } else { ?>
						<li><a href="/<?php echo $account; ?>">Login</a></li>
						<?php } ?>
						<li><a href="/<?php echo $cart; ?>">Cart</a></li>
						<li><a href="/<?php echo $checkout; ?>">Checkout</a></li>
					</ul>
				</div>
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
			<div id="social_tw"> <a href="https://twitter.com/FCFootballArt" class="twitter-follow-button" data-text-color="#FFFFFF" data-link-color="#FFFFFF" data-show-count="false">Follow @FCFootballArt</a> 
				<script src="//platform.twitter.com/widgets.js" type="text/javascript"></script> 
			</div>
			<div class="fixFF"></div>
		</div>
	</hgroup>
</header>
<!-- #branding -->

<div id="wrapper_content" class="clearfix">
<div id="main" class="clearfix">
<div id="column_left" style="text-align:left;">
	<div id="leftMods">
		<div class="box">
			<div id="category" class="sidebar_menu">
				<ul class="level_1">
					<li id="id_105"><a href="http://www.framedcollegefootballart.com/college-football-gifts">Best Sellers</a></li>
					<li id="id_116"><a href="http://www.framedcollegefootballart.com/north-carolina-state-university-wolfpack-prints-art-pictures">Diploma</a></li>
					<li id="id_111"><a href="http://www.framedcollegefootballart.com/new-arrivals">New Arrivals</a></li>
					<li id="id_106"><a href="http://www.framedcollegefootballart.com/Schools">Schools </a>
						<ul class="level_2">
							<li id="id_36"><a href="http://www.framedcollegefootballart.com/alabama-crimson-tide-football-prints">Alabama</a></li>
							<li id="id_49"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=49">Arizona</a></li>
							<li id="id_50"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=50">Arizona State</a></li>
							<li id="id_51"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=51">Arkansas</a></li>
							<li id="id_39"><a href="http://www.framedcollegefootballart.com/auburn-university-tigers-prints">Auburn</a></li>
							<li id="id_53"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=53">Baylor</a></li>
							<li id="id_54"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=54">BYU</a></li>
							<li id="id_55"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=55">Clemson</a></li>
							<li id="id_56"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=56">Duke</a></li>
							<li id="id_37"><a href="http://www.framedcollegefootballart.com/university-of-florida-gators-prints">Florida</a></li>
							<li id="id_57"><a href="http://www.framedcollegefootballart.com/florida-state-university-seminoles-prints">FSU</a></li>
							<li id="id_58"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=58">Georgia</a></li>
							<li id="id_59"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=59">Georgia Tech</a></li>
							<li id="id_60"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=60">Illinois</a></li>
							<li id="id_61"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=61">Indiana</a></li>
							<li id="id_62"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=62">Iowa</a></li>
							<li id="id_63"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=63">Iowa State</a></li>
							<li id="id_64"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=64">Kansas</a></li>
							<li id="id_65"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=65">Kansas State</a></li>
							<li id="id_66"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=66">Kentucky</a></li>
							<li id="id_67"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=67">Louisville</a></li>
							<li id="id_38"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=38">LSU</a></li>
							<li id="id_68"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=68">Miami</a></li>
							<li id="id_69"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=69">Michigan</a></li>
							<li id="id_70"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=70">Michigan State</a></li>
							<li id="id_71"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=71">Mississippi State</a></li>
							<li id="id_72"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=72">Mizzou</a></li>
							<li id="id_73"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=73">NC State</a></li>
							<li id="id_74"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=74">Nebraska</a></li>
							<li id="id_76"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=76">Notre Dame</a></li>
							<li id="id_77"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=77">Ohio State</a></li>
							<li id="id_78"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=78">Oklahoma</a></li>
							<li id="id_79"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=79">Oklahoma State</a></li>
							<li id="id_80"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=80">Ole Miss</a></li>
							<li id="id_81"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=81">Oregon</a></li>
							<li id="id_82"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=82">Penn State</a></li>
							<li id="id_83"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=83">Purdue</a></li>
							<li id="id_85"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=85">Tennessee</a></li>
							<li id="id_86"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=86">Texas</a></li>
							<li id="id_87"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=87">Texas A&amp;M</a></li>
							<li id="id_88"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=88">Texas Tech</a></li>
							<li id="id_89"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=89">UCLA</a></li>
							<li id="id_75"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=75">UNC Chapel Hill</a></li>
							<li id="id_90"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=90">USC</a></li>
							<li id="id_84"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=84">USC Prints</a></li>
							<li id="id_91"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=91">Vanderbilt</a></li>
							<li id="id_96"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=96">Virginia</a></li>
							<li id="id_92"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=92">Virginia Tech</a></li>
							<li id="id_93"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=93">West Virginia</a></li>
							<li id="id_94"><a href="http://www.framedcollegefootballart.com/index.php?route=product/category&amp;path=94">Wisconsin</a></li>
						</ul>
					</li>
					<li id="id_103"><a href="http://www.framedcollegefootballart.com/bowl-championship-series-national-championship-framed-prints-pictures-prints">Bowl Games</a>
						<ul class="level_2">
							<li id="id_109"><a href="http://www.framedcollegefootballart.com/2008">2008</a></li>
							<li id="id_108"><a href="http://www.framedcollegefootballart.com/2009">2009</a></li>
							<li id="id_110"><a href="http://www.framedcollegefootballart.com/2010">2010</a></li>
							<li id="id_107"><a href="http://www.framedcollegefootballart.com/2011">2011</a></li>
						</ul>
					</li>
					<li id="id_100"><img src="/catalog/view/theme/football/images/icon_tag.png" id="sale-tag"><a href="http://www.framedcollegefootballart.com/clearance">Clearance!</a></li>
				</ul>
			</div>
		</div>
		<div class="box">
			<div id="manufacturers" class="middle sidebar_menu">
				<ul class="level_1">
					<li><a href="#">Artists</a>
						<ul class="level_2">
							<li><a href="http://www.framedcollegefootballart.com/b-tinney-prints"> B. Tinney </a></li>
							<li><a href="http://www.framedcollegefootballart.com/blakeway-panoramics"> Blakeway Panoramics </a></li>
							<li><a href="http://www.framedcollegefootballart.com/bryant-bagley-prints"> Bryant Bagley </a></li>
							<li><a href="http://www.framedcollegefootballart.com/charles-alexander-prints"> Charles Alexander </a></li>
							<li><a href="http://www.framedcollegefootballart.com/daniel-moore-prints"> Daniel Moore </a></li>
							<li><a href="http://www.framedcollegefootballart.com/darren-harringdine-prints"> Darren Harringdine </a></li>
							<li><a href="http://www.framedcollegefootballart.com/derek-snow-prints"> Derek Snow </a></li>
							<li><a href="http://www.framedcollegefootballart.com/lfoyd-hosmer-prints"> Floyd Hosmer </a></li>
							<li><a href="http://www.framedcollegefootballart.com/gale-osborne-prints"> Gale Osborne </a></li>
							<li><a href="http://www.framedcollegefootballart.com/greg-gamble-prints"> Greg Gamble </a></li>
							<li><a href="http://www.framedcollegefootballart.com/larry-pitts-prints"> Larry Pitts </a></li>
							<li><a href="http://www.framedcollegefootballart.com/mark-broome-prints"> Mark Broome </a></li>
							<li><a href="http://www.framedcollegefootballart.com/michael-montgomery-prints"> Michael Montgomery </a></li>
							<li><a href="http://www.framedcollegefootballart.com/mike-dunnam-prints"> Mike Dunnam </a></li>
							<li><a href="http://www.framedcollegefootballart.com/monica-dooley-prints"> Monica Dooley </a></li>
							<li><a href="http://www.framedcollegefootballart.com/rick-rush-prints"> Rick Rush </a></li>
							<li><a href="http://www.framedcollegefootballart.com/rob-arra-prints"> Rob Arra </a></li>
							<li><a href="http://www.framedcollegefootballart.com/roberta-wesley-prints"> Roberta Wesley </a></li>
							<li><a href="http://www.framedcollegefootballart.com/russell-grace-prints"> Russell Grace </a></li>
							<li><a href="http://www.framedcollegefootballart.com/sports-illustrated"> Sports Illustrated </a></li>
							<li><a href="http://www.framedcollegefootballart.com/steve-ford-prints"> Steve Ford Prints </a></li>
							<li><a href="http://www.framedcollegefootballart.com/t-spinosi-prints"> T. Spinosi Prints </a></li>
							<li><a href="http://www.framedcollegefootballart.com/winning-streak"> Winning Streak </a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
		<div class="fixFF"></div>
	</div>
	<div id="facebookFeed"> <img src="/image/data/banner_ShippingFraming.jpg"> </div>
</div>
