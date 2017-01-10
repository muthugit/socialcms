<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class fbloader extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->database ();
		$this->load->model ( 'generic_model' );
		$this->load->model ( 'post_model' );
	}
	public function index() {
		$xml = JSON_DECODE ( file_get_contents ( "https://graph.facebook.com/v2.8/385457931797554/feed?fields=updated_time,link,from,message,full_picture,picture&access_token=EAACzeZAdLO8EBAG1KTRsZBg0sckWztuQYtm02zqaJUZBee81tn0hkt3r3VTcPoFY2smdV3UK2oK0Rqtf4e2ZC8xZA8sLv90OdRS20EsBLSxCMzEQ2nwPOqT7mUnwPKBYa9FGmRh0lDkpwgAtOcTPBKMOZAL5SLw8QZD" ) );
		foreach ( $xml->data as $current ) {
			if (! isset ( $current->message ))
				continue;
			$msgSplit = explode ( "\n", $current->message );
			if (count ( $msgSplit ) < 3)
				continue;
			$category = $msgSplit [0];
			$title = explode ( "\n", $current->message ) [1];
			
			$removeCategory = substr ( strstr ( $current->message, "\n" ), 1 );
			
			$message = substr ( strstr ( $removeCategory, "\n" ), 1 );
			date_default_timezone_set ( 'America/New_York' );
			$updatedTime = strtotime ( $current->updated_time );
			
			$data ['postId'] = $current->id;
			$data ['updatedTime'] = $updatedTime;
			$data ['postTitle'] = $title;
			$data ['message'] = $message;
			$data ['userId'] = $current->from->id;
			$data ['userDisplayName'] = $current->from->name;
			
			if (isset ( $current->full_picture )) {
				$data ['postImage'] = $current->full_picture;
			}
			if (isset ( $current->link ))
				$data ['link'] = $current->link;
			$this->post_model->createPost ( $data );
			echo '<br>Insert completed ===> ' . $current->id;
		}
	}
}