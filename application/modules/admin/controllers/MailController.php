<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

use \DrewM\MailChimp\MailChimp;

class MailController extends Admin_Controller {
	public function __construct() {
		parent::__construct ();
	}
	
	// Frontend User CRUD
	public function index() {
		$pageType = 'Mail';
		
		$crud = $this->generate_crud ( 'customers', 'Customer' );
		
		$crud->where ( 'email !=', ' ' );
		$crud->columns ( 'email', 'first_name', 'last_name', 'last_login' );
		
		$crud->display_as ( 'email', 'Mail' );
		$crud->display_as ( 'first_name', 'Nombre' );
		$crud->display_as ( 'last_name', 'Apellido' );
		$crud->display_as ( 'last_login', 'Última contacto por mail' );
		
		// disable direct create / delete Admin User
		$crud->unset_add ();
		$crud->unset_delete ();
		$crud->unset_edit ();
		
		$crud->callback_column ( 'email', array (
				$this,
				'checkboxMail' 
		) );
		
		$this->mPageTitle = 'Enviar mail';
		
		$isMailChimp = false;
		
		$this->render_crud ( $pageType );
	}
	
	/**
	 * ------------------------------------------ PRIVATE METHODS
	 */
	
	public function checkboxMail($post_array) {
		$post_array_for_id = str_replace ( "@", "_", $post_array );
		$post_array_for_id = str_replace ( ".", "-", $post_array_for_id );
		
		return '<input type="checkbox" id="' . $post_array_for_id . '" onchange="addDeleteMemberToList(this)"> ' . $post_array;
	}
	
	
	/**
	 * ------------------------------------------ API KEY
	 */
	
	public function checkApiKey() {
		$mailchimp = new Mailchimp ( '56ec508114429503a18b2b2ca81cc7ca-us16' );
		
		$result = $mailchimp->get ( 'lists' );
		
		echo var_dump ( $result );
	}
	
	/**
	 * ------------------------------------------ CAMPAIGNS
	 */
	
	public function createCampaigns() {
		
		if (isset ( $_POST ['api_key'] ) && isset ( $_POST ['requestApi'] )) {
			
			//var_dump($_POST ['requestApi']);
			
			$mailchimp = new Mailchimp ( $_POST ['api_key'] );
			$result = $mailchimp->post ( 'campaigns' , $_POST ['requestApi']);
			
			echo json_encode ( $result, JSON_PRETTY_PRINT );
		} else {
			echo 'REPLICATE Campaigns . Api key is empty, please check console log : ' . $_POST ['api_key'];
		}
		
	}
	
	
	// @TODO - getCampaigns && getCampaign must be one function
	// --------------------------------------------------------
	
	public function getCampaigns() {
		
		if (isset ( $_POST ['api_key'] )) {
			$mailchimp = new Mailchimp ( $_POST ['api_key'] );
			
			$result = $mailchimp->get ( 'campaigns' );
			
			echo json_encode ( $result, JSON_PRETTY_PRINT );
		} else {
			echo 'GET Campaigns . Api key is empty, please check console log : ' . $_POST ['api_key'];
		}
	}
	
	public function getCampaign() {
		
		if (isset ( $_POST ['api_key'] ) && isset ( $_POST ['campaign_id'] )) {
			$mailchimp = new Mailchimp ( $_POST ['api_key'] );
			
			$result = $mailchimp->get ( '/campaigns/'.$_POST ['campaign_id'] );
			
			echo json_encode ( $result, JSON_PRETTY_PRINT );
		} else {
			echo 'GET Campaigns . Api key is empty, please check console log : ' . $_POST ['api_key'];
		}
	}
	// --------------------------------------------------------
	
	public function replicateCampaigns() {
		
		if (isset ( $_POST ['api_key'] ) && isset ( $_POST ['campaign_id'] )) {
			
			$mailchimp = new Mailchimp ( $_POST ['api_key'] );
			$result = $mailchimp->post ( 'campaigns/' . $_POST ['campaign_id'].'/actions/replicate'  );
			
			echo json_encode ( $result, JSON_PRETTY_PRINT );
		} else {
			echo 'REPLICATE Campaigns . Api key is empty, please check console log : ' . $_POST ['api_key'];
		}
		
	}
	 
	 public function sendCampaing() {
		if (isset ( $_POST ['api_key'] ) && isset ( $_POST ['campaign_id'] )) {
			
			$mailchimp = new Mailchimp ( $_POST ['api_key'] );
			
			$result = $mailchimp->post ( 'campaigns/' . $_POST ['campaign_id'] . '/actions/send' );
			
			echo json_encode ( $result, JSON_PRETTY_PRINT );
		} else {
			echo 'Api key is empty, please check console log : ' . $_POST ['api_key'];
		}
	}
	
	
	public function deleteCampaigns() {
		
		if (isset ( $_POST ['api_key'] ) && isset ( $_POST ['campaign_id'] )) {
			
			$mailchimp = new Mailchimp ( $_POST ['api_key'] );
			$result = $mailchimp->delete ( 'campaigns/' . $_POST ['campaign_id']  );
			
			echo json_encode ( $result, JSON_PRETTY_PRINT );
		} else {
			echo 'DELETE Campaigns . Api key is empty, please check console log : ' . $_POST ['api_key'];
		}
		
	}
	
	/**
	 * ------------------------------------------ LISTS
	 *  Get list of users added to a campaign
	 */
	
	// get all lists
	public function getLists() {
		if (isset ( $_POST ['api_key'] )) {
			$mailchimp = new Mailchimp ( $_POST ['api_key'] );
			
			$result = $mailchimp->get ( 'lists' );
			
			echo json_encode ( $result, JSON_PRETTY_PRINT );
		} else {
			echo 'Api key is empty, please check console log : ' . $_POST ['api_key'];
		}
	}

	// get members in LIST
	public function getCustomersEmailsInList() {
		if (isset ( $_POST ['api_key'] ) && isset ( $_POST ['list_id'] )) {
			
			$mailchimp = new Mailchimp ( $_POST ['api_key'] );
			
			$result = $mailchimp->get ( 'lists/' . $_POST ['list_id'] . '/members' );
			
			echo json_encode ( $result, JSON_PRETTY_PRINT );
		} else {
			echo 'Api key is empty, please check console log : ' . $_POST ['api_key'];
		}
	}
	
	
	
	/**
	 * ------------------------------------------ SUSCRIBE / UNSUSCRIBE
	 */
	
	public function suscribeMemberToAList() {
		if (isset ( $_POST ['list_id'] ) && isset ( $_POST ['customer_email'] ) && isset ( $_POST ['api_key'] )) {
			
			$mailchimp = new Mailchimp ( $_POST ['api_key'] );
			
			$result = $mailchimp->post ( "lists/" . $_POST ['list_id'] . "/members", [ 
					'email_address' => '' . $_POST ['customer_email'] . '',
					'status' => 'subscribed' 
				// 'merge_fields' => ['FNAME'=>'Dani', 'LNAME'=>'Muñoz']
			] );
			
			echo json_encode ( $result, JSON_PRETTY_PRINT );
		} else {
			echo 'Api key is empty, please check console log : ' . $_POST ['api_key'];
		}
	}
	
	public function unsuscribeMemberToAList() {
		if (isset ( $_POST ['list_id'] ) && isset ( $_POST ['customer_email'] ) && isset ( $_POST ['api_key'] )) {
			
			$mailchimp = new Mailchimp ( $_POST ['api_key'] );
			
			$subscriber_hash = $mailchimp->subscriberHash ( '' . $_POST ['customer_email'] . '' );
			
			$result = $mailchimp->delete ( "lists/" . $_POST ['list_id'] . "/members/" . $subscriber_hash . "" );
			
			echo json_encode ( $result, JSON_PRETTY_PRINT );
		} else {
			echo 'Api key is empty, please check console log : ' . $_POST ['api_key'];
		}
	}
}
