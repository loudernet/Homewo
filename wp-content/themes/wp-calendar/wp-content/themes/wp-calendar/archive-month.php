<?php $wp_calendar = wp_calendar(get_the_time('F Y')); ?>

<?php get_header(); ?>

<div id="wp_calendar">
	<h3><?=$wp_calendar['active_month']?></h3>	
	<ul class="weekdays">
		<li><?php _e('Sunday') ?></li>
		<li><?php _e('Monday') ?></li>
		<li><?php _e('Tuesday') ?></li>
		<li><?php _e('Wednesday') ?></li>
		<li><?php _e('Thursday') ?></li>
		<li><?php _e('Friday') ?></li>
		<li><?php _e('Saturday') ?></li>
	</ul>
	<ol class="month">
<?php foreach($wp_calendar['calendar'] as $item): ?>
<?php if($item['is_day'] == "no"): ?>
		<li class="noday"></li>
<?php else: ?>
		<li class="<?=(isset($item['is_today']) ? ' today' : '')?><?=(isset($item['posts']) ? '' : ' empty')?>">
			<div class="head"><?=$item['day']?><?=(isset($item['is_today']) ? ' *' : '')?></div>
			<div class="day">
<?php if(isset($item['posts'])): ?>
				<ul>
<?php foreach($item['posts'] as $post): ?>
					<li><a title="<?=$post['post_title']?>" href="<?=get_permalink($post['id'])?>"><?=truncate($post['post_title'], 150)?></a></li>
<?php endforeach; ?>
				</ul>
<?php endif; ?>
			</div>
		</li>
<?php endif; ?>
<?php endforeach; ?>
	</ol>
</div>

<div id="author_info">
	<h5>about the author</h5>
	<p>The founder of popular WordPress theme site BustATheme.com, <a href="http://greg-j.com/">Greg Johnson</a> is a UI Designer and Software Developer that focuses on developing web applications used by other web masters to monetize their online presense. While Greg enjoys his career in web development, his career passion is in game design. Greg and his partners &mdash; who together form <a href="http://forgestudios.com">Forge Studios</a> &mdash; are currently developing their first commercial title for release on the iPhone. If you would like to get in touch with Greg or just see what he's up to, you can do so by visiting his website Greg-J.com.</p>
</div>

<?php get_footer(); ?>
