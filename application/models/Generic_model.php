<?php
require 'php_parse/autoload.php';
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseACL;
use Parse\ParsePush;
use Parse\ParseUser;
use Parse\ParseInstallation;
use Parse\ParseException;
use Parse\ParseAnalytics;
use Parse\ParseFile;
use Parse\ParseCloud;
use Parse\ParseClient;
class Generic_Model extends CI_Model {
	private $table = 'category';
	function __construct() {
		parent::__construct ();
		// ParseClient::initialize( $app_id, $rest_key, $master_key );
		ParseClient::initialize ( PARSE_API_ID, "", PARSE_MASTER_KEY );
		// Users of Parse Server will need to point ParseClient at their remote URL and Mount Point:
		ParseClient::setServerURL ( PARSE_SERVER_URL, 'parse' );
		date_default_timezone_set ( 'Africa/Lagos' ); // or change to whatever timezone you want
	}
	public function getCategories() {
		$query = new ParseQuery ( "Category" );
		$results = $query->find ();
		return (($results));
	}
}