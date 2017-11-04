<div class="box box-primary" id="invoice_box">
	<div class="box-body" >
		<div class="form-group ">
			<label for="role"> Usuario </label> 
			<select name="customer_list_pos"
				id="customer_list_pos"
				class="form-control select2 select2-hidden-accessible"
				onchange="#" 
				style="width: 100%;"
				tabindex="-1" 
				aria-hidden="true" >
			</select>
		</div>
		
		<div class="form-group">

		<label for="role"> Productos </label> 
			<select name="product_list_pos"
				id="product_list_pos"
				class="form-control select2 select2-hidden-accessible"
				style="width: 100%;"
				tabindex="-1" 
				aria-hidden="true" >
			</select>

		</div>

		<div class="form-group" id ="table_invoice_wrap" hidden>
			<div id="bill_wrapper">
				
			
				<table class="table table-striped" id ="table_invoice">
				   	<thead>
					  <tr>
					   	<th  colspan="5" >Número de factura : <span id = "table_invoice_id" data-id = "0" > #error# </span></th>
					  </tr>
				      <tr>
				         <th width="5%"></th>
				         <th width="30%" >Name</th>
				         <th width="20%">Price</th>
				         <th width="15%">Qty</th>
				         <th width="30%">Total</th>
				      </tr>
				   </thead>
				   <tbody>
				   		<!-- DINAMIC FILL UP  -->
				   </tbody>
				   <tfoot>

				   	<tr>
				         <th><b></b></th>
				         <th colspan="3"><b>Total productos</b></th>
				         <th><b id ="table_total_items">0</b></th>
				    </tr>
				   	<tr>
				         <th></th>
				         <th colspan="3"><b>Sub-total</b></th>
				         <th><b id ="table_sub_total_price" >0 €</b></th>
				    </tr>
				    <tr>
				         <th></th>
				         <th colspan="3"><b>IVA (21%)</b></th>
				         <th><b id ="table_total_iva" >0 €</b></th>
				    </tr>
				    <tr>
				         <th></th>
				         <th colspan="3"><b>Total ticket</b></th>
				         <th><b id ="table_total_price" >0 €</b></th>
				    </tr>
				      
				   </tfoot>
				</table>		

			</div>
		</div>

	</div>
	
	
	<div class="box-footer">
		<a onclick="deleteInvoice()" class="btn margin btn-danger">Borrar</a> 

		<a onclick="showPaymentModal()" class="btn btn-primary margin pull-right">Pago</a>
		<a onclick="holdPayment()" class="btn btn-success margin pull-right">Postponer</a>
	</div>
</div>
