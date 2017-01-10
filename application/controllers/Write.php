<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Write extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->model ( 'generic_model' );
		$this->load->model ( 'post_model' );
	}
	public function index() {
		$this->load->view ( 'common/header' );
		$this->load->view ( 'common/navBar' );
		$this->load->view ( 'write' );
		$this->load->view ( 'common/footer' );
	}
}
