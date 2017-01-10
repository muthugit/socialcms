<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Welcome extends CI_Controller {
	public $user = "";
	public function __construct() {
		parent::__construct ();
		
		// Load facebook library and pass associative array which contains appId and secret key
		$this->load->helper ( 'url' );
		$this->load->library ( 'facebook', array (
				'appId' => FB_APP_ID,
				'secret' => FB_APP_SECRET 
		) );
		$this->user = $this->facebook->getUser ();
	}
	public function index() {
		$data ['user_profile'] = "";
		$data ['user_profile'] ['name'] = "";
		$data ['login_url'] = $this->facebook->getLoginUrl ();
		$data ['logout_url'] = SITE_PATH . 'index.php/oauthlogin/logout/1';
		if ($this->user) {
			$data ['login'] = true;
			$data ['user_profile'] = $this->facebook->api ( '/me/' );
		} else
			$data ['login'] = false;
		$latestPost = json_decode ( file_get_contents ( "http://localhost/padaippaligal/api/post/lists/openApi/json/1/1" ) );
		if (sizeof ( $latestPost ) > 0)
			$data ['topLatest'] = $latestPost [0];
		$this->load->view ( 'common/header' );
		$this->load->view ( 'index', $data );
		$this->load->view ( 'common/footer' );
	}
}
