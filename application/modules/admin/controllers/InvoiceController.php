<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class InvoiceController extends Admin_Controller {
	


	public function addBillItem() {

		if (isset ($_POST['customer_id']) && !isset ($_POST['invoice_id'])){
			
			$this->load->model('Invoice_model');
			
			$this->Invoice_model->create();
			
		}		
		

// 		if (isset ( $_POST ['item_id'] ) && isset ( $_POST ['customer_id'] )) {
			
// 			// existe factura para este item y este usuario de hoy

// 			$this->db->where ('item_id', $_POST ['item_id']) ; 
// 			$where = $this->db->where ('customer_id', $_POST ['customer_id']); 
// 			$number = $where->from("invoice_customer") ;
// 			echo "NUMBER  : " . $number;

// 				// -- > no : creo una factura
// 				// -- crear nueva fatura en bill
// 				$item = array (

// 					'item_id' => $_POST ['item_id'] 
// 					,'customer_id' => $_POST ['customer_id'] 
// 				);
			
// 				$this->db->insert ( 'invoice_customer', $item );
// 				// -- crear nueva fila en bill_customer

// 				// -- obtener id de la factura en bill

// 				// -- actualizar bill_product

// 				// devolvemos true


			

// 			// -- > si : debemos añadir una fila extra bill_product
// 				// -- actualizamos bill product

// 				// devolvemos true

// 			echo 'Final del contolador de invoice' ;

// 		}

	}


}
