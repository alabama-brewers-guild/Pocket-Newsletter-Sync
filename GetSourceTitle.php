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
	else if (strpos( $url, 'chicagobusiness.com' ) !== false)
		return "Crain's";
	else if (strpos( $url, 'ballerstatus.com' ) !== false)
		return "BallerStatus";
	else if (strpos( $url, 'yahoo.com' ) !== false)
		return "Yahoo";
	else if (strpos( $url, 'nbwa.org' ) !== false)
		return "NBWA";
	else if (strpos( $url, 'craftbrewingbusiness.com' ) !== false)
		return "Craft Brewing Biz";
	else if (strpos( $url, 'adage.com' ) !== false)
		return "Ad Age";
	else if (strpos( $url, 'thefullpint.com' ) !== false)
		return "The Full Pint";
	else if (strpos( $url, 'coloradoan' ) !== false)
		return "Coloradoan";
	else if (strpos( $url, 'telegraph.co.uk' ) !== false)
		return "The Telegraph";
	else if (strpos( $url, 'wsj.com' ) !== false)
		return "WSJ";
	else if (strpos( $url, 'bloomberg.com' ) !== false)
		return "Bloomberg";
	else if (strpos( $url, 'thrillist.com' ) !== false)
		return "Thrillist";
	else if (strpos( $url, 'nacsonline.com' ) !== false)
		return "NACS";
	else if (strpos( $url, 'austin360.com' ) !== false)
		return "Austin360";
	else if (strpos( $url, 'usatoday.com' ) !== false)
		return "USA Today";
	else if (strpos( $url, 'chicagotribune.com' ) !== false)
		return "Chicago Tribune";
	else if (strpos( $url, 'nytimes.com' ) !== false)
		return "NY Times";
	else
		return parse_url( $url, PHP_URL_HOST );
}