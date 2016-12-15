<?php
/*
 * A script to retrieve the Pocket data for a user
 *
 * @package    NewsLinks
 * @author      Dan Roberts
 * @license     None
*/
// Show all errors/warnings
error_reporting(E_ALL);
ini_set('display_errors', '1');
const NEWLINE = '<br /><br />';
require('Pocket.php');
require('config.php');
require('GetSourceTitle.php');

global $pocketConsumerKey;
$params = array(
	'consumerKey' => $pocketConsumerKey
);
if (empty($params['consumerKey'])) {
	die('Please fill in your Pocket App Consumer Key');
}
$pocket = new Pocket($params);
if (isset($_GET['authorized'])) {
	// Convert the requestToken into an accessToken
	// Note that a requestToken can only be covnerted once
	// Thus refreshing this page will generate an auth error
	$user = $pocket->convertToken($_GET['authorized']);
	/*
		$user['access_token']	the user's access token for calls to Pocket
		$user['username']	the user's pocket username
	*/
	echo "Access Token: " . $user['access_token'] . '<br />';
	echo "User: " . $user['username'];
	echo NEWLINE;
	
	// Set the user's access token to be used for all subsequent calls to the Pocket API
	$pocket->setAccessToken($user['access_token']);
	// Retrieve the user's list of unread items (limit 5)
	// http://getpocket.com/developer/docs/v3/retrieve for a list of params
	$params = array(
		'sort' => 'oldest',
		'detailType' => 'simple'
	);
	$items = $pocket->retrieve($params, $user['access_token']);
	if( isset($_GET['delete']) ) {
		$actions = array();
		foreach($items['list'] as $id => $item) {
			$action = array("action" => "archive", "item_id" => $id);
			$actions[] = $action;
		}
		if(count($actions) > 0)
			$pocket->send( $actions, $user['access_token'] );
	}
	foreach($items['list'] as $item)
	{
		$source_title = GetSourceTitle( $item['resolved_url'] );
		echo "<p><a href=\"{$item['resolved_url']}\">{$source_title}</a>: {$item['resolved_title']}</p>";
	}
	echo NEWLINE;
	$delete_prefix = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']) ? 'https' : 'http') . '://'  . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
	echo "<a href=\"{$delete_prefix}?delete=1\">Clear Pocket Queue</a>";
}
else {
	// Attempt to detect the url of the current page to redirect back to
	// Normally you wouldn't do this
	$redirect = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']) ? 'https' : 'http') . '://'  . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?authorized=';
	if(isset($_GET['delete'])) {
		$redirect .= "&delete=1";
	}
	// Request a token from Pocket
	$result = $pocket->requestToken($redirect);
	/*
		$result['redirect_uri']		this is the URL to send the user to getpocket.com to authorize your app
		$result['request_token']	this is the request_token which you will need to use to
						obtain the user's access token after they have authorized your app
	*/
	/*
	This is a hack to redirect back to us with the requestToken
	Normally you should save the 'request_token' in a session so it can be
	retrieved when the user is redirected back to you
	*/
	$result['redirect_uri'] = str_replace(
		urlencode('?authorized='),
		urlencode('?authorized=' . $result['request_token']),
		$result['redirect_uri']
	);
	// END HACK
	header('Location: ' . $result['redirect_uri']);
}