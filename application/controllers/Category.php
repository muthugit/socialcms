<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Category extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->model ( 'generic_model' );
		$this->load->model ( 'post_model' );
	}
	public function index() {
	}
	public function view($id) {
		$categoryInfo = json_decode ( file_get_contents ( API_PATH . 'category/categoryInfo/' . $id ) );
		$data ['categoryInfo'] = $categoryInfo;
		$data['categoryId']=$categoryInfo[0]->id;
		$this->load->view ( 'common/header', $data );
		$this->load->view ( 'common/navBar' );
		$this->load->view ( 'category' );
		$this->load->view ( 'common/footer' );
	}
}
