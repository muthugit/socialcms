<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Oauthlogin extends CI_Controller {
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
	
	// Store user information and send to profile page
	public function index() {
		if ($this->user) {
			$data ['user_profile'] = $this->facebook->api ( '/me/' );
			
			// Get logout url of facebook
			$data ['logout_url'] = $this->facebook->getLogoutUrl ( array (
					'next' => SITE_PATH . 'oauthlogin/logout/1' 
			) );
			
			// Send data to profile page
			$this->load->view ( 'profile', $data );
		} else {
			
			// Store users facebook login url
			$data ['login_url'] = $this->facebook->getLoginUrl ();
			$this->load->view ( 'fblogin', $data );
		}
	}
	
	// Logout from facebook
	public function logout($d) {
		
		// Destroy session
		session_destroy ();
		
		// Redirect to baseurl
		redirect ( SITE_PATH );
	}
}
?>