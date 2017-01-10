<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Post extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->model ( 'generic_model' );
		$this->load->model ( 'post_model' );
		require ('User.php');
	}
	public function index() {
		$dbconnect = $this->load->database ();
		$this->load->model ( 'generic_model' );
		echo 'Post';
	}
	public function test() {
		$this->post_model->test ();
	}
	
	/**
	 * CREATE THE NEW POST
	 *
	 * @param unknown $userPrivateKey        	
	 */
	public function create($userPrivateKey) {
		$results = $this->post_model->createPost();
	}
	
	/**
	 * LIST ALL POSTS
	 *
	 * @param unknown $apiKey        	
	 * @param string $format        	
	 * @param string $from        	
	 * @param string $limit        	
	 * @param string $category        	
	 * @param string $isImageRequired        	
	 */
	public function lists($apiKey, $format = false, $from = false, $limit = false, $category = false, $authorId=false, $isImageRequired = false) {
		$categoryId = false;
		$sourceId = false;
		$results = $this->post_model->getPosts ( $apiKey, $category, $sourceId, $from, $limit, $authorId, $isImageRequired );
		$resultObject = $this->getPostData ( $results );
		$renderObject ['post'] = $resultObject;
		if ($format == 'json' || $format == false)
			echo json_encode ( $resultObject );
		elseif ($format == 'render')
			$this->load->view ( 'templates/postListTemplate', $renderObject );
	}
	
	/*
	 *
	 */
	public function getPostData($results) {
		$resultObject = [ ];
		for($i = 0; $i < count ( $results ); $i ++) {
			$object = $results [$i];
			$resultObject [$i] ['id'] = $object->getObjectId ();
			$resultObject [$i] ['feedTitle'] = $object->get ( 'feedTitle' );
			$resultObject [$i] ['feedContent'] = $object->get ( 'feedContent' );
			$resultObject [$i] ['feedImage'] = $object->get ( 'feedImage' );
			$resultObject [$i] ['feedCategory'] = $this->getCategory ( $object );
			$resultObject [$i] ['feedAuthor'] = $this->getAuthor ( $object );
			$resultObject [$i] ['status'] = $object->get ( 'status' );
		}
		return $resultObject;
	}
	
	/**
	 *
	 * @param unknown $object        	
	 * @return NULL[]
	 */
	private function getCategory($object) {
		$feedCategory = $object->get ( 'feedCategory' );
		$feedCategoryObject = [ ];
		$feedCategoryObject ['categoryName'] = $feedCategory->categoryName;
		return $feedCategoryObject;
	}
	private function getAuthor($object) {
		$feedCategory = $object->get ( 'feedAuthor' );
		$feedCategoryObject = [ ];
		$feedCategoryObject ['username'] = $feedCategory->username;
		$feedCategoryObject ['displayName'] = $feedCategory->displayName;
		return $feedCategoryObject;
	}
	
	/**
	 * RETRIEVE SINGLE POST
	 *
	 * @param unknown $apiKey        	
	 * @param unknown $postKey        	
	 */
	public function singlePost($postKey, $format) {
		$singlePostData = $this->post_model->getSinglePost ( $postKey );
		$result = ($this->getPostData ( $singlePostData ));
		$renderObject ['object'] = $result;
		echo json_encode ( $result );
	}
}
