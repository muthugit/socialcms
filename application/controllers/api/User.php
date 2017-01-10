<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class User extends CI_Controller {
	function __construct() {
		date_default_timezone_set ( 'Africa/Lagos' ); // or change to whatever timezone you want
		if (session_status () == PHP_SESSION_NONE) {
		}
		parent::__construct ();
		$this->load->model ( 'generic_model' );
		$this->load->model ( 'user_model' );
	}
	public function index() {
	}
	public function userInfo($userId) {
		$results = $this->user_model->getUserInfoByUserName ( $userId );
		$resultObject = $this->getUserDetails ( $results );
		echo json_encode ( $resultObject );
	}
	public function loginForm() {
		$this->user_model->login ( $_POST ['userName'], $_POST ['password'], true );
	}
	public function login($userId, $password, $byEmail = false, $displayName = false) {
		$this->user_model->login ( $userId, $password, $byEmail, $displayName );
	}
	public function logout() {
		$_SESSION ['currentUser'] = "";
		redirect ( SITE_PATH . 'feeds', 'location', 301 );
	}
	public function register() {
		$this->user_model->createNewUser ();
	}
	public function currentUser() {
		$results = $this->user_model->getCurrentUser ();
		echo '<hr>';
		print_r ( $_SESSION );
		echo '<hr>';
	}
	private function getUserDetails($results) {
		$resultObject = [ ];
		for($i = 0; $i < count ( $results ); $i ++) {
			$object = $results [$i];
			$resultObject [$i] ['id'] = $object->getObjectId ();
			$resultObject [$i] ['userName'] = $object->get ( 'username' );
			$resultObject [$i] ['displayName'] = $object->get ( 'displayName' );
			$resultObject [$i] ['about'] = $object->get ( 'about' );
		}
		return $resultObject;
	}
	
	/**
	 * GET USER INFO BY ID
	 *
	 * @param unknown $userPrivateKey        	
	 */
	public function getUserByKey($userPrivateKey) {
		echo 'User private id: ' . $userPrivateKey;
	}
}