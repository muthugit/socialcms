<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Author extends CI_Controller {
	public $user = "";
	function __construct() {
		parent::__construct ();
		$this->load->model ( 'generic_model' );
		$this->load->model ( 'post_model' );
		
		// Load facebook library and pass associative array which contains appId and secret key
		$this->load->helper ( 'url' );
		$this->load->library ( 'facebook', array (
				'appId' => FB_APP_ID,
				'secret' => FB_APP_SECRET 
		) );
		$this->user = $this->facebook->getUser ();
	}
	public function index() {
	}
	public function view($id) {
		$data ['userInfo'] = json_decode ( file_get_contents ( API_PATH . 'user/userInfo/' . $id ) );
		$data ['authorId'] = $data ['userInfo'] [0]->id;
		$this->load->view ( 'common/header', $data );
		$this->load->view ( 'common/authorNavBar' );
		$this->load->view ( 'author' );
		$this->load->view ( 'common/footer' );
	}
	public function login() {
		$data ['login_url'] = $this->facebook->getLoginUrl ();
		$data ['logout_url'] = SITE_PATH . 'index.php/oauthlogin/logout/1';
		$data ['userProfile'] = "";
		if ($this->user) {
			$userProfile = $this->facebook->api ( '/me/' );
			$data ['userProfile'] = $this->facebook->api ( '/me/' );
			$data ['login'] = true;
			redirect ( SITE_PATH . 'api/user/login/' . $userProfile ['id'] . '/' . $userProfile ['id'] . '/oauth/' . $userProfile ['name'] );
		} else
			$data ['login'] = false;
		$this->load->view ( 'common/header' );
		$this->load->view ( 'index', $data );
		$this->load->view ( 'common/footer' );
	}
}
