<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Bill extends Admin_Controller {
	


	public function addBillItem() {

		$return_arr = array ();
		

		if (isset ( $_POST ['item_id'] ) && isset ( $_POST ['customer_id'] )) {
			
			// existe factura para este item y este usuario de hoy

			$this->db->where ('item_id', $_POST ['item_id']) ; 
			$num_results = $this->db->where ('customer_id', $_POST ['customer_id']) ; 
			if($num_results == 0){

				// -- > no : creo una factura
				// -- crear nueva fatura en bill
				$item = array (

					'item_id' => $_POST ['item_id'] 
					,'customer_id' => $_POST ['customer_id'] 
				);
			
				$this->db->insert ( 'bill_customer', $item );
				// -- crear nueva fila en bill_customer

				// -- obtener id de la factura en bill

				// -- actualizar bill_product

				// devolvemos true

			}


			

			// -- > si : debemos añadir una fila extra bill_product
				// -- actualizamos bill product

				// devolvemos true






			$item = array (

					'item_id' => $_POST ['item_id'] 
					,'customer_id' => $_POST ['customer_id'] 
			);
			
			$this->db->insert ( 'bill_customer', $item );

			echo $this->db->where('id', $item ) -> count_all_results('bill_customer' ;

		} else {

			echo 'The item_id value is empty';
			return false;
			
		}

	}


}
