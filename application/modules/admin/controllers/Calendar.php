<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Calendar extends Admin_Controller {
	
	// Frontend User CRUD
	public function index() {
		$this->render ( 'calendar' );
	}
	public function initCalendar() {
		$return_arr = array ();
		
		$query = $this->db->get ( 'calendar' );
		
		foreach ( $query->result () as $row ) {
			
			$row_array ['id'] = $row->id;
			$row_array ['date_in'] = $row->date_in;
			$row_array ['date_out'] = $row->date_out;
			$row_array ['value'] = $row->value;
			$row_array ['backgroundColor'] = $row->backgroundColor;
			$row_array ['borderColor'] = $row->borderColor;
			$row_array ['last_update'] = $row->last_update;
			
			array_push ( $return_arr, $row_array );
		}
		
		echo json_encode ( $return_arr, JSON_PRETTY_PRINT );
	}
	
	// CRUD
	public function create() {
		$return_arr = array ();
		
		if (isset ( $_POST ['eventValue'] )) {
			
			$cita = array (
					'date_in' => $_POST ['eventStart'],
					'date_out' => $_POST ['eventEnd'],
					'value' => $_POST ['eventValue'],
					'backgroundColor' => $_POST ['backgroundColor'],
					'borderColor' => $_POST ['borderColor'] 
			);
			
			$this->db->insert ( 'calendar', $cita );
			echo 'hemos llegado';
			// must return last inserted value
			echo $id = $this->db->insert_id ();
		} else {
			echo 'The eventValue value is empty';
			return false;
		}
	}
	
	public function read() {
	}
	
	public function update() {
	}
	
	public function deleteCita() {
		
		if (isset ( $_POST ['eventId'] )) {
			
			$this->db->where ( 'id',$_POST ['eventId'] );
			$this->db->delete ( 'calendar' );
			echo $_POST ['eventId'];
			
		}else {
			
			echo 'EventId is empty , please fill up to delete event';
		}
		
	}
	
	public function saveCita() {
		$return_arr = array ();
		
		if (isset ( $_POST ['eventValue'] )) {
			
			$cita = array (
					'date_in' => $_POST ['eventStart'],
					'date_out' => $_POST ['eventEnd'],
					'value' => $_POST ['eventValue'],
					'backgroundColor' => $_POST ['backgroundColor'],
					'borderColor' => $_POST ['borderColor'] 
			);
			
			$this->db->insert ( 'calendar', $cita );
			echo $this->db->insert_id ();
		} else {
			echo 'The event_start value is empty';
			return false;
		}
	}
	
	public function updateCitaDrag() {
		$return_arr = array ();
		
		if (isset ( $_POST ['eventId'] ) && isset ( $_POST ['eventStart'] )) {
			
			if (isset ( $_POST ['eventEnd'] ))
				
				$this->db->set ( 'date_out', $_POST ['eventEnd'] );
			$this->db->set ( 'date_in', $_POST ['eventStart'] );
			
			$this->db->where ( 'id', $_POST ['eventId'] );
			$this->db->update ( 'calendar' );
			
			echo $_POST ['eventId'];
		} else {
			echo 'The event_start value is empty';
			false;
		}
	}
}
