<?php
	/*
	Plugin Name: wp-calendar
	Plugin URI: http://bustatheme.com/wordpress/wp-calendar
	Description: Companion plugin for the wp-calendar theme. Enables calendar functionality.
	Author: Greg Johnson
	Version: 1.0
	Author URI: http://greg-j.com
	*/

/* Main function for wp-calendar */
function wp_calendar($active_month)
{
	// Prepare our variables
	global $wpdb;
	$counter1 = 0;
	$counter2 = 0;

	$wp_calendar['active_month'] = $active_month;	// Month & Year to use for this calendar. format = "Febuary 2009"
	$wp_calendar['today'] = time();
	$wp_calendar['days_in_month'] = date("t", strtotime($wp_calendar['active_month']));
	$wp_calendar['start_weekday'] = date("w", strtotime($wp_calendar['active_month']));
	$wp_calendar['month_begin_unix'] = strtotime($wp_calendar['active_month']);
	$wp_calendar['month_begin_human'] = date("Y-m-d G:i:s", $wp_calendar['month_begin_unix']);
	$wp_calendar['month_end_unix'] = $wp_calendar['month_begin_unix'] + ($wp_calendar['days_in_month'] * 86400) - 1;
	$wp_calendar['month_end_human'] = date("Y-m-d G:i:s", $wp_calendar['month_end_unix']);
	$wp_calendar['curr_month_num'] = date("m", $wp_calendar['month_begin_unix']);
	$wp_calendar['curr_year_num'] = date("Y", $wp_calendar['month_begin_unix']);
	$wp_calendar['prev_month_unix'] = strtotime($wp_calendar['active_month']." -1 month");
	$wp_calendar['prev_month_num'] = date("m", $wp_calendar['prev_month_unix']);
	$wp_calendar['prev_year_num'] = date("Y", $wp_calendar['prev_month_unix']);
	$wp_calendar['next_month_unix'] = strtotime($wp_calendar['active_month']." +1 month");
	$wp_calendar['next_month_num'] = date("m", $wp_calendar['next_month_unix']);
	$wp_calendar['next_year_num'] = date("Y", $wp_calendar['next_month_unix']);
	
	// $query = $wpdb->get_results("SELECT id,post_title,LEFT(post_content, 20) AS post_content,post_date FROM " . $wpdb->prefix . "posts WHERE post_type = 'post' AND post_date BETWEEN '".$wp_calendar['month_begin_human']."' AND '".$wp_calendar['month_end_human']."' ORDER BY post_date ASC ");
	$query = $wpdb->get_results("SELECT id,post_title,post_date FROM " . $wpdb->prefix . "posts WHERE post_type = 'post' AND post_date BETWEEN '".$wp_calendar['month_begin_human']."' AND '".$wp_calendar['month_end_human']."' ORDER BY post_date ASC ");
	
	// What day of the week does this month start on?
	for($i = 0; $i < $wp_calendar['start_weekday']; $i++)
	{
		$wp_calendar['calendar'][$counter1]['is_day'] = "no";
		$counter1++;
	}
	
	// Calendar logic.
	for($i = 1; $i <= $wp_calendar['days_in_month']; $i++)
	{
		$day_start = $wp_calendar['month_begin_unix'] + ($i - 1) * 86400;
		$day_end = $wp_calendar['month_begin_unix'] + ($i * 86400) - 1;
	
		if($wp_calendar['today'] >= $day_start && $wp_calendar['today'] <= $day_end)
		{
			$wp_calendar['calendar'][$counter1]['is_today'] = "yes";
		}
		$wp_calendar['calendar'][$counter1]['is_day'] = "yes";
		$wp_calendar['calendar'][$counter1]['day'] = $i;
	
		foreach($query as $item)
		{
			if(strtotime($item->post_date) >= $day_start && strtotime($item->post_date) <= $day_end)
			{
				$this_post[$counter2]['id'] = $item->id;
				$this_post[$counter2]['post_date'] = $item->post_date;
				$this_post[$counter2]['post_title'] = $item->post_title;
				
				$wp_calendar['calendar'][$counter1]['posts'][] = $this_post[$counter2];
			}
			
			$counter2++;
		}
		
		$counter1++;
	}

	return $wp_calendar;
}

/* Nice little function to truncate longer text */
if(!function_exists("truncate"))
{
	function truncate($str, $length=22, $append='...')
	{
		$length -= mb_strlen($append);
		
		if (mb_strlen($str) > $length)
		{
		   return mb_substr($str,0,$length).$append;
		}
		else
		{
		   return $str;
		}
	}
}

/* Include the_exceprt_reloaded if the user does not already have the plugin installed */
if(!function_exists("the_excerpt_reloaded"))
{
	function wp_the_excerpt_reloaded($args='') {
	parse_str($args);
	if(!isset($excerpt_length)) $excerpt_length = 120; // length of excerpt in words. -1 to display all excerpt/content
	if(!isset($allowedtags)) $allowedtags = '<a>'; // HTML tags allowed in excerpt, 'all' to allow all tags.
	if(!isset($filter_type)) $filter_type = 'none'; // format filter used => 'content', 'excerpt', 'content_rss', 'excerpt_rss', 'none'
	if(!isset($use_more_link)) $use_more_link = 1; // display
	if(!isset($more_link_text)) $more_link_text = "(more...)";
	if(!isset($force_more)) $force_more = 1;
	if(!isset($fakeit)) $fakeit = 1;
	if(!isset($fix_tags)) $fix_tags = 1;
	if(!isset($no_more)) $no_more = 0;
	if(!isset($more_tag)) $more_tag = 'div';
	if(!isset($more_link_title)) $more_link_title = 'Continue reading this entry';
	if(!isset($showdots)) $showdots = 1;

	return the_excerpt_reloaded($excerpt_length, $allowedtags, $filter_type, $use_more_link, $more_link_text, $force_more, $fakeit, $fix_tags, $no_more, $more_tag, $more_link_title, $showdots);
}

function the_excerpt_reloaded($excerpt_length=120, $allowedtags='<a>', $filter_type='none', $use_more_link=true, $more_link_text="(more...)", $force_more=true, $fakeit=1, $fix_tags=true, $no_more=false, $more_tag='div', $more_link_title='Continue reading this entry', $showdots=true) {
	if(preg_match('%^content($|_rss)|^excerpt($|_rss)%', $filter_type)) {
		$filter_type = 'the_' . $filter_type;
	}
	echo get_the_excerpt_reloaded($excerpt_length, $allowedtags, $filter_type, $use_more_link, $more_link_text, $force_more, $fakeit, $fix_tags, $no_more, $more_tag, $more_link_title, $showdots);
}

function get_the_excerpt_reloaded($excerpt_length, $allowedtags, $filter_type, $use_more_link, $more_link_text, $force_more, $fakeit, $fix_tags, $no_more, $more_tag, $more_link_title, $showdots) {
	global $post;

	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_'.COOKIEHASH] != $post->post_password) { // and it doesn't match cookie
			if(is_feed()) { // if this runs in a feed
				$output = __('There is no excerpt because this is a protected post.');
			} else {
	            $output = get_the_password_form();
			}
		}
		return $output;
	}

	if($fakeit == 2) { // force content as excerpt
		$text = $post->post_content;
	} elseif($fakeit == 1) { // content as excerpt, if no excerpt
		$text = (empty($post->post_excerpt)) ? $post->post_content : $post->post_excerpt;
	} else { // excerpt no matter what
		$text = $post->post_excerpt;
	}

	if($excerpt_length < 0) {
		$output = $text;
	} else {
		if(!$no_more && strpos($text, '<!--more-->')) {
		    $text = explode('<!--more-->', $text, 2);
			$l = count($text[0]);
			$more_link = 1;
		} else {
			$text = explode(' ', $text);
			if(count($text) > $excerpt_length) {
				$l = $excerpt_length;
				$ellipsis = 1;
			} else {
				$l = count($text);
				$more_link_text = '';
				$ellipsis = 0;
			}
		}
		for ($i=0; $i<$l; $i++)
				$output .= $text[$i] . ' ';
	}

	if('all' != $allowedtags) {
		$output = strip_tags($output, $allowedtags);
	}

//	$output = str_replace(array("\r\n", "\r", "\n", "  "), " ", $output);

	$output = rtrim($output, "\s\n\t\r\0\x0B");
    $output = ($fix_tags) ? balanceTags($output, true) : $output;
	$output .= ($showdots && $ellipsis) ? '...' : '';
	$output = apply_filters($filter_type, $output);

	switch($more_tag) {
		case('div') :
			$tag = 'div';
		break;
		case('span') :
			$tag = 'span';
		break;
		case('p') :
			$tag = 'p';
		break;
		default :
			$tag = 'span';
	}

	if ($use_more_link && $more_link_text) {
		if($force_more) {
			$output .= ' <' . $tag . ' class="more-link"><a href="'. get_permalink($post->ID) . '#more-' . $post->ID .'" title="' . $more_link_title . '">' . $more_link_text . '</a></' . $tag . '>' . "\n";
		} else {
			$output .= ' <' . $tag . ' class="more-link"><a href="'. get_permalink($post->ID) . '" title="' . $more_link_title . '">' . $more_link_text . '</a></' . $tag . '>' . "\n";
		}
	}

	return $output;
}
}

?>