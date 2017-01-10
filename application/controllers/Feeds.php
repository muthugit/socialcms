<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Feeds extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->model ( 'generic_model' );
		$this->load->model ( 'post_model' );
	}
	public function index() {
		$data['categoryId']=false;
		$this->load->view ( 'common/header',$data );
		$this->load->view ( 'common/navBar' );
		$this->load->view ( 'feeds' );
		$this->load->view ( 'common/footer' );
	}
	public function singlePost($postId, $title) {
		$feedData = (file_get_contents ( API_PATH . 'post/singlePost/' . $postId . '/s' ));
		$renderObject ['object'] = json_decode ( $feedData );
		$this->load->view ( 'common/header', $renderObject );
		$this->load->view ( 'common/singlePostNavBar' );
		$this->load->view ( 'templates/singlePostTemplate' );
		$this->load->view ( 'common/footer' );
	}
	public function write($id) {
		$this->load->view ( 'common/header' );
		$this->load->view ( 'common/navBar' );
		$this->load->view ( 'write' );
		$this->load->view ( 'common/footer' );
	}
}
