
<div id="sidebar">
	<div class="widgets">
<?php if(function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar')):else: ?>
		<div id="widget_recent_entries" class="widget">			
			<h4>Recent Posts</h4>
			<ul>
				<?php get_archives('postbypost', '10', 'html'); ?>
			</ul>
		</div>
<?php endif; ?>
	</div>
</div>
