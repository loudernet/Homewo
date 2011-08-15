
	</div>
</div>

<?php if(function_exists('dynamic_sidebar')): ?>
<div id="widgets_bottom">
	<div class="widgets">
		<div class="left">
<?php if(dynamic_sidebar('Bottom Left')) :else: ?>
			<div class="widget"><!-- widget_left --></div>
<? endif; ?>
		</div>
		<div class="center">
<?php if(dynamic_sidebar('Bottom Center')) :else: ?>
			<div class="widget"><!-- widget_center --></div>
<? endif; ?>
		</div>
		<div class="right">
<?php if(dynamic_sidebar('Bottom Right')) :else: ?>
			<div class="widget"><!-- widget_right --></div>
<? endif; ?>
		</div>
	</div>
</div>
<?php endif; ?>

<div id="footer">
	<div class="info">
		<!-- While a link back is not required, it is appreciated -->
		<ul>
			<li>Powered by <a href="http://wordpress.org/">WordPress</a>.</li>
			<li>Theme developed by <a href="http://greg-j.com">Greg Johnson</a> via BustATheme.com</li>
		</ul>
		<p>Copyright &copy; <?=date("Y", time())?> - Greg Johnson</p>
	</div>
<?php wp_footer(); ?>
</div>

		
</body>
</html>
