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
class User_Model extends CI_Model {
	private $table = 'category';
	function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		session_start ();
		// ParseClient::initialize( $app_id, $rest_key, $master_key );
		ParseClient::initialize ( PARSE_API_ID, "", PARSE_MASTER_KEY );
		// Users of Parse Server will need to point ParseClient at their remote URL and Mount Point:
		ParseClient::setServerURL ( PARSE_SERVER_URL, 'parse' );
		date_default_timezone_set ( 'Africa/Lagos' ); // or change to whatever timezone you want
	}
	public function getUserInfoByUserName($userName) {
		$query = ParseUser::query ();
		$query->equalTo ( "username", $userName );
		$results = $query->find ();
		return ($results);
	}
	public function getCurrentUser() {
		// $this->login ();
		$currentUser = $_SESSION ['currentUser'];
		if ($currentUser) {
			echo '====cc====';
			print_r ( $currentUser );
			// do stuff with the user
		} else {
			// show the signup or login page
		}
	}
	public function login($userName, $password, $byEmail = false, $displayName = false) {
		try {
			echo $userName;
			// Example URL: http://localhost/padaippaligal/api/user/login/NMwPHQHq0M/13
			$query = ParseUser::query ();
			if (isset ( $byEmail )) {
				echo "By Email";
				$query->equalTo ( "email", $userName );
			} elseif ($byEmail = "oauth") {
				$password = $userName;
				$query->equalTo ( "username", $userName );
			} else {
				$query->get ( $userName ); // HERE USERNAME is USERID
				echo "HI";
			}
			$results = $query->find ();
			if (sizeof ( $results ) > 0)
				$userName = $results [0]->username;
			else {
				$this->oauthNewUser ( $userName, $password, $displayName );
			}
			$user = ParseUser::logIn ( $userName, $password );
			$currentUser = ParseUser::getCurrentUser ();
			echo '========';
			$_SESSION ['currentUser'] = $currentUser;
			print_r ( $currentUser );
			echo '=======<br>';
			redirect ( SITE_PATH . 'feeds', 'location', 301 );
		} catch ( ParseException $error ) {
			// The login failed. Check error to see why.
		}
	}
	public function oauthNewUser($userId, $password = false, $displayName = false) {
		if (! isset ( $displayName ))
			$displayName = "Anonymous";
		$user = new ParseUser ();
		$user->set ( "username", $userId );
		$user->set ( "password", $password );
		$user->set ( "userType", "member" );
		
		// other fields can be set just like with ParseObject
		$user->set ( "displayName", urldecode ( $displayName ) );
		try {
			$user->signUp ();
			$newUserId = $user->getObjectId ();
			// $this->login ( $userId, $userId, "oauth" );
		} catch ( ParseException $ex ) {
			// Show the error message somewhere and let the user try again.
			echo "Error: " . $ex->getCode () . " " . $ex->getMessage ();
		}
		echo 'Reached';
	}
	public function createNewUser() {
		$password = md5 ( time () );
		echo $password . '<hr>';
		echo $_POST ['userFirstName'];
		$user = new ParseUser ();
		$user->set ( "username", $_POST ['userUniqueId'] );
		$user->set ( "password", $password );
		$user->set ( "email", $_POST ['userEmail'] );
		$user->set ( "userType", "member" );
		
		// other fields can be set just like with ParseObject
		$user->set ( "displayName", $_POST ['userFirstName'] );
		$this->load->library ( 'email' );
		try {
			$user->signUp ();
			$userId = $user->getObjectId ();
			$config = Array (
					'protocol' => 'smtp',
					'smtp_host' => 'ssl://smtp.yandex.com',
					'smtp_port' => 465,
					'smtp_user' => 'muthu@ozbakers.in',
					'smtp_pass' => 'Citrisys123',
					'mailtype' => 'html',
					'charset' => 'iso-8859-1' 
			);
			
			$config ['charset'] = 'utf-8';
			$config ['newline'] = "\r\n";
			$config ['wordwrap'] = TRUE;
			$config ['validation'] = TRUE;
			
			$this->email->initialize ( $config );
			$this->email->set_newline ( "\r\n" );
			
			$this->email->from ( 'muthu@ozbakers.in', '#Muthupandian' );
			$this->email->to ( $_POST ['userEmail'] );
			
			$this->email->subject ( 'Welcome ' . $_POST ['userUniqueId'] . ' <br> To PadaippaligalUlagam.com<br>' );
			$filename = ('https://pbs.twimg.com/profile_images/630202566014472193/dCtaCBG_.png');
			$this->email->attach ( $filename );
			$cid = $this->email->attachment_cid ( $filename );
			
			$this->email->message ( 'Welcome ' . $_POST ['userUniqueId'] . ' to Padaippaligal Ulagam,<br>
					<a href="' . API_PATH . 'user/login/' . $userId . '/' . $password . '">Login here</a><img src="cid:' . $cid . '"/>' );
			
			$result = $this->email->send ();
			echo $this->email->print_debugger ();
			
			echo '<br>Email sent<hr>';
			// Hooray! Let them use the app now.
		} catch ( ParseException $ex ) {
			// Show the error message somewhere and let the user try again.
			echo "Error: " . $ex->getCode () . " " . $ex->getMessage ();
		}
		echo 'Reached';
	}
}