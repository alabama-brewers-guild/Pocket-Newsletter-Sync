<?php
function GetSourceTitle( $url ) {
	if (strpos( $url, 'brewbound.com') !== false )
		return "Brewbound";
	else if (strpos( $url, 'brewersassociation.org') !== false )
		return "BA";
	else if (strpos( $url, 'cnn.com') !== false )
		return "CNN";
	else if (strpos( $url, 'newsweek.com') !== false )
		return "NewsWeek";
	else if (strpos( $url, 'reuters.com') !== false )
		return "Reuters";
	else if (strpos( $url, 'pressdemocrat.com') !== false  )
		return "Press Democrat";
	else if (strpos( $url, 'just-drinks.com') !== false )
		return "Just Drinks";
	else if (strpos( $url, 'ttb.gov') !== false )
		return "TTB";
	else if (strpos( $url, 'stltoday.com') !== false )
		return "STL Today";
	else if (strpos( $url, 'marketwatch.com') !== false)
		return "MarketWatch";
	else if (strpos( $url, 'kutv.com/') !== false)
		return "KUTV";
	else if (strpos( $url, 'al.com') !== false)
		return "al.com";
	else
		return parse_url( $url, PHP_URL_HOST );
}