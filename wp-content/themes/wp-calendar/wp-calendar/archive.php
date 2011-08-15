<?php

/*
	Normally this file would have template code in it, but
	due to the use of the wp-calendar plugin the archive
	templates have been split up to make theming them slightly
	more intuitive.
*/

if(!function_exists('wp_calendar'))		// If the wp_calendar plugin does not exist...
{
	die(include('_wp.php'));			// ... notify them.
}

if(is_month())							// If the user is requesting a monthly archive...					
{
	include("archive-month.php");		// ... show them the calendar for that month.
}

if(is_category() || is_tag())			// If the user is requesting an archive by category or tag...
{
	include("archive-category.php"); 	// ... show them the list of articles.
}

?>
