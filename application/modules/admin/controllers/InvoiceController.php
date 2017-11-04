<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class InvoiceController extends Admin_Controller {
	

	public function readInvoice() {

		if (isset ($_POST['invoice_id'])){
			
			$this->load->model('Invoice_model');

			$result = $this->Invoice_model->read($_POST['invoice_id']);

			$result_modified = array();

			$result_modified['results']['date'] =  date("d-m-Y H:i:s") ;
			$result_modified['results']['invoice_id'] =  $result[0]->invoice_id ;
			$result_modified['results']['customer_id'] =  $result[0]->customer_id  ;
			$result_modified['results']['customer_name'] =  $result[0]->customer_name ;
			$result_modified['results']['created_time'] =  $result[0]->created_time ;
			$result_modified['results']['customer_comment'] =  $result[0]->comment ;
			$result_modified['results']['active'] =  $result[0]->active ;
			$result_modified['results']['on_hold'] =  $result[0]->on_hold ;
			$result_modified['results']['paid'] =  $result[0]->paid ;
			$result_modified['results']['items'] =  $result ;

			echo json_encode($result_modified);

		}else{

			$this->load->model('Invoice_model');

			$result = $this->Invoice_model->read();

			echo json_encode($result);

		}

	}

	public function updateInvoice() {

		if (isset ($_POST['invoice_id'])){
			
			$this->load->model('Invoice_model');

			$result = $this->Invoice_model->update();


			echo $result;

		}else{
			echo 'Item id is empty, please fill up ' ;
		}

	}

	public function addInvoiceItem() {

		if (isset($_POST['item_id'])
			&& isset ($_POST['customer_id'])
			&& isset ($_POST['invoice_id'])){
			
			$this->load->model('Invoice_model');

			$invoice_id = $this->Invoice_model->create();

			if((int)$invoice_id > 0){

				$result = $this->Invoice_model->read($invoice_id);
				echo json_encode($result);

			}else{

				echo 'Inserted, but impossible get invoice by id, try again' ; 

			}
			
		}else{
			echo 'Item id is empty, please fill up ' ;
		}

	}

	public function deleteInvoiceItem() {

		if (isset($_POST['item_id'])
			&& isset ($_POST['customer_id'])
			&& isset ($_POST['invoice_id'])){
			
			$this->load->model('Invoice_model');

			$invoice_id = $this->Invoice_model->deleteItem();

			if((int)$invoice_id > 0){

				$result = $this->Invoice_model->read($invoice_id);
				echo json_encode($result);

			}else{

				echo 'Inserted, but impossible get invoice by id, try again' ; 

			}
			
		}else{
			echo 'Item id is empty, please fill up ' ;
		}

	}

	public function deleteInvoice() {

		if (isset ($_POST['customer_id'])
			&& isset ($_POST['invoice_id'])){
			
			$this->load->model('Invoice_model');

			$result = $this->Invoice_model->delete();

			if((int)$result > 0){

				 echo $result;

			}else{

				echo 'Inserted, but impossible get invoice by id, try again' ; 

			}

		}else{
			echo 'Item id is empty, please fill up ' ;
		}

	}

	public function confirmInvoice() {

		echo "Confirmada" ; 

	}

}
