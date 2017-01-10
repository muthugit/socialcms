<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Category extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->model ( 'category_model' );
	}
	public function all() {
		$results = $this->category_model->getCategories ();
		$resultObject = $this->getCategoryInfo ( $results );
		echo json_encode ( $resultObject );
	}
	
	public function categoryInfo($categorySlug){
		$results = $this->category_model->getCategories ($categorySlug);
		$resultObject = $this->getCategoryInfo ( $results );
		echo json_encode ( $resultObject );
	}
	
	
	private function getCategoryInfo($results) {
		$resultObject = [ ];
		for($i = 0; $i < count ( $results ); $i ++) {
			$object = $results [$i];
			$resultObject [$i] ['id'] = $object->getObjectId ();
			$resultObject [$i] ['categoryName'] = $object->get ( 'categoryName' );
			$resultObject [$i] ['categorySlug'] = $object->get ( 'categorySlug' );
		}
		return ($resultObject);
	}
}
