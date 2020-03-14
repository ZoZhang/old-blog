<?php
/**
 * @package WordPress
 * @subpackage Newspaper theme
 */
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes('html'); ?>>
<head>
<title><?php if ( is_home() ) {
		bloginfo('name'); echo " - "; bloginfo('description');
	} elseif ( is_category() ) {
		single_cat_title(); echo " - "; bloginfo('name');
	} elseif (is_single() || is_page() ) {
		single_post_title();echo " - "; bloginfo('name');
	} elseif (is_search() ) {
		echo "搜索结果"; echo " - "; bloginfo('name');
	} elseif (is_404() ) {
		echo '页面未找到!';
	} else {
		wp_title('',true);
	} ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=7">
<meta name="google-site-verification" content="E6qdOsfvx41t7-v1LxVhVLMcnE6mx4Ymg1SFOfLmh5A" />
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<?php wp_head();?>
<link rel="shortcut icon" href="<?php bloginfo('template_url');?>/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/highslide.css" type="text/css"/>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<script src="<?php bloginfo('template_url'); ?>/js/jquery.min.js" type="text/javascript"></script>
<?php if ( is_singular() ){ ?>
<script src="<?php bloginfo('template_url'); ?>/js/comments-ajax.js" type="text/javascript" ></script>
<?php } ?>
<script src="<?php bloginfo('template_url'); ?>/js/jquery.textshadow.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_url'); ?>/js/highslide-with-gallery.packed.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_url'); ?>/js/fainz.js" type="text/javascript"></script>
</head>
<body>
<div class="page">
  <?php if ( 1||is_home() ) {?>
    <div id="global-tipds" class="global-tips">您看到的是2010年的旧博客，新版敬请期待~ ^ ^</div>
  <?php }?>
  <div class="header">
		<div class="logo"><a href="<?php bloginfo('url')?>/"><img src="/wp-content/themes/fainz/images/logo.png"  /></a></div>
		<div class="nav">
			<ul id="menu" class="menu">
				<li <?php if(is_home()):?>class="home"<?php endif;?>><a href="<?php echo get_option('home'); ?>/">Home</a></li>
			  <?php fainz_page_menu('post_titl='); ?>
			</ul>
		</div>
		<div class="search"><?php get_search_form();?></div>
  </div>
