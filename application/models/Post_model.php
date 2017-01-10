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
class Post_Model extends CI_Model {
	private $table = 'category';
	function __construct() {
		session_start ();
		parent::__construct ();
		// ParseClient::initialize( $app_id, $rest_key, $master_key );
		ParseClient::initialize ( PARSE_API_ID, "", PARSE_MASTER_KEY );
		// Users of Parse Server will need to point ParseClient at their remote URL and Mount Point:
		ParseClient::setServerURL ( PARSE_SERVER_URL, 'parse' );
		date_default_timezone_set ( 'Africa/Lagos' ); // or change to whatever timezone you want
	}
	public function createPost() {
		$target_dir = "images/";
		$imageName = $this->imageUpload ( $target_dir );
		
		$categoryQuery = new ParseQuery ( "Category" );
		try {
			$categoryObj = $categoryQuery->get ( $_POST ['feedCategory'] );
		} catch ( ParseException $ex ) {
			$categoryObj = $categoryQuery->get ( DEFAULT_CATEGORY );
		}
		$newPost = new ParseObject ( "Feeds" );
		
		$newPost->set ( "feedTitle", $_POST ['feedTitle'] );
		$newPost->set ( "feedContent", $_POST ['feedContent'] );
		$newPost->set ( "feedCategory", $categoryObj );
		$newPost->set ( "feedAuthor", $_SESSION ['currentUser'] );
		$newPost->set ( "status", "draft" );
		
		if ($imageName != null)
			$newPost->set ( "feedImage", SITE_PATH . $target_dir . $imageName );
		
		try {
			$newPost->save ();
			echo 'New object created with objectId: ' . $newPost->getObjectId ();
		} catch ( ParseException $ex ) {
			echo 'Failed to create new object, with error message: ' . $ex->getMessage ();
		}
	}
	/**
	 *
	 * @param
	 *        	target_dir
	 */
	private function imageUpload($target_dir) {
		$target_file = $target_dir . basename ( $_FILES ["feedImage"] ["name"] );
		$uploadOk = 1;
		$imageFileType = pathinfo ( $target_file, PATHINFO_EXTENSION );
		$check = getimagesize ( $_FILES ["feedImage"] ["tmp_name"] );
		if ($check !== false) {
			echo "File is an image - " . $check ["mime"] . ".";
			$uploadOk = 1;
			if (move_uploaded_file ( $_FILES ["feedImage"] ["tmp_name"], $target_file )) {
				echo "The file " . basename ( $_FILES ["feedImage"] ["name"] ) . " has been uploaded.";
				return basename ( $_FILES ["feedImage"] ["name"] );
			}
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
		return null;
	}
	public function test() {
		$gameScore = new ParseObject ( "Muthu" );
		$gameScore->set ( "score", 376252 );
		$gameScore->set ( "playerName", "MUTHU PANDIAN" );
		$gameScore->set ( "cheatMode", false );
		
		try {
			$gameScore->save ();
			echo 'New object created with objectId: ' . $gameScore->getObjectId ();
			$query = new ParseQuery ( "Muthu" );
			$gameScoreRes = $query->get ( $gameScore->getObjectId () );
			echo '<hr>';
			print_r ( $gameScoreRes );
		} catch ( ParseException $ex ) {
			// Execute any logic that should take place if the save fails.
			// error is a ParseException object with an error code and message.
			echo 'Failed to create new object, with error message: ' . $ex->getMessage ();
		}
	}
	public function getPosts($api = false, $categoryId = false, $sourceId = false, $from = false, $limit = false, $authorId = false, $isImageRequired = false) {
		$query = new ParseQuery ( "Feeds" );
		if ($limit != false)
			$query->limit ( $limit );
		if ($from != false)
			$query->skip ( $from - 1 );
		if ($categoryId != false && $categoryId != "all") {
			$categoryObject = $this->getObject ( "Category", $categoryId );
			$query->equalTo ( "feedCategory", $categoryObject [0] );
			
		}
		if ($authorId != false && $authorId != "all") {
			$authorObject = $this->getObject ( "User", $authorId );
			$query->equalTo ( "feedAuthor", $authorObject [0] );
		}
		$query->includeKey ( "feedCategory" );
		$query->includeKey ( "feedAuthor" );
		$query->descending ( "updatedAt" );
		$results = $query->find ();
		return (($results));
	}
	public function getSinglePost($postKey) {
		$query = new ParseQuery ( "Feeds" );
		$query->get ( $postKey );
		$query->includeKey ( "feedCategory" );
		$query->includeKey ( "feedAuthor" );
		$query->descending ( "updatedAt" );
		$results = $query->find ();
		return ($results);
	}
	public function getObject($repository, $id) {
		if ($repository != "User") {
			$query = new ParseQuery ( $repository );
		} else {
			$query = ParseUser::query ();
		}
		$query->get ( $id );
		$results = $query->find ();
		return (($results));
	}
}