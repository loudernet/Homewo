<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php wp_title(); ?> - <?php bloginfo('name'); ?></title>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php wp_head(); ?>

<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery-1.2.6.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.mousewheel.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jScrollPane.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/widgets.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/jScrollPane.css" />
<script type="text/javascript">
$(function()
{
	$('.day').jScrollPane({scrollbarWidth:5, scrollbarMargin:0});
});
</script>

</head>
<body>

<div id="header">
	<p class="heading1"><?php bloginfo('name'); ?></p>
	<p class="heading2"><?php bloginfo('description'); ?></p>
	<ul>
		<li><a href="<?php echo get_settings('home'); ?>"><?php _e('Home') ?></a></li>
		<?php wp_list_pages('title_li=&depth=1') ?>
		<li class="rss"><a href="<?php bloginfo('rss2_url'); ?>"  title="<?php bloginfo('name'); ?> RSS Feed"><?php _e("Subscribe") ?></a></li>
	</ul>
</div>

<div id="frame">

<?php if(function_exists('dynamic_sidebar')): ?>
<div id="widgets_top">
	<div class="widgets">
		<div class="left">
<?php if(dynamic_sidebar('Top Left')) :else: ?>
			<div class="widget">
				<select name=\"archive-dropdown\" onChange='document.location.href=this.options[this.selectedIndex].value;'> 
  					<option value=\"\"><?php echo attribute_escape(__('Select Month')); ?></option> 
  					<?php wp_get_archives('type=monthly&format=option&show_post_count=1'); ?>
  				</select>			
			</div>
<? endif; ?>
		</div>
		<div class="center">
<?php if(dynamic_sidebar('Top Center')) :else: ?>
			<div class="widget"><!-- widget_center --></div>
<? endif; ?>
		</div>
		<div class="right">
<?php if( dynamic_sidebar('Top Right')) :else: ?>
			<div class="widget"><!-- widget_right --></div>
<? endif; ?>
		</div>
	</div>
</div>
<?php endif; ?>


<div id="page">
