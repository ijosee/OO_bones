<div class="box box-primary">
	<div class="box-body">
		<div class="form-group ">
			<label for="role"> Usuario </label> 
			<select name="customer_list_pos"
				id="customer_list_pos"
				class="form-control select2 select2-hidden-accessible"
				onchange="#" style="width: 100%;"
				tabindex="-1" aria-hidden="true">
			</select>
		</div>
		
		<div class="form-group">

		<label for="role"> Productos </label> 
			<select name="product_list_pos"
				id="product_list_pos"
				class="form-control select2 select2-hidden-accessible"
				onchange="#" style="width: 100%;"
				tabindex="-1" aria-hidden="true">
			</select>

		</div>

		<div class="form-group" id ="table_invoice_wrap" hidden>
			<div id="bill_wrapper">
				
			
				<table class="table table-striped">
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

<!-- 				      <tr> -->
<!-- 				         <td> -->
<!-- 				         	<a class="delete"> -->
<!-- 				         		<i class="fa fa-times-circle-o"></i> -->
<!-- 				         	</a> -->
<!-- 				         </td> -->
<!-- 				         <td>12</td> -->
<!-- 				         <td>13.50</td> -->
<!-- 				         <td> -->
<!-- 				         	<input class="form-control qty"  -->
<!-- 				         	onchange="UpdateSaleItem('43',this.value)"  -->
<!-- 				         	value="1" -->
<!-- 				         	> -->
<!-- 				         </td> -->
<!-- 				         <td>13.50</td> -->
<!-- 				      </tr> -->

				   </tbody>
				   <tfoot>
				      <tr>
				         <th></th>
				         <th colspan="3"><b>Total</b></th>
				         <th><b id ="table_total_price" >0 €</b></th>
				      </tr>
				      <tr>
				         <th><b></b></th>
				         <th colspan="3"><b>IVA 15 (15.00%)</b></th>
				         <th><b>0 €</b></th>
				      </tr>
				      <tr>
				         <th><b></b></th>
				         <th colspan="3"><b>Número de items</b></th>
				         <th><b>8</b></th>
				      </tr>
				   </tfoot>
				</table>		

			</div>
		</div>

	</div>
	
	
	<div class="box-footer">
		<input 
		type="submit" 
		name="ctl00$MainContent$btnReset" 
		value="Borrar"
		id="MainContent_btnReset" class="btn margin btn-danger"> <a
			
		onclick="addItemBill()" class="btn btn-primary margin pull-right">Pago</a>
		<a onclick="PopupHold()" class="btn btn-success margin pull-right">Postponer</a>
	</div>
</div>
