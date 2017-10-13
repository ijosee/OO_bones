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

		<div class="form-group">
			<div id="bill_wrapper">
				
			
				<table class="table table-striped">
				   	<thead>
				      <tr>
				         <th width="5%"></th>
				         <th width="30%" class="name">Name</th>
				         <th width="20%">Price</th>
				         <th width="15%">Qty</th>
				         <th width="30%">Total</th>
				      </tr>
				   </thead>
				   <tbody>

				      <tr>
				         <td>
				         	<a onclick="DeleteSaleItem('43')" class="delete">
				         		<i class="fa fa-times-circle-o"></i>
				         	</a>
				         </td>
				         <td class="name">12</td>
				         <td>13.50</td>
				         <td>
				         	<input class="form-control qty" 
				         	onchange="UpdateSaleItem('43',this.value)" 
				         	value="1"
				         	>
				         </td>
				         <td>13.50</td>
				      </tr>

				   </tbody>
				   <tfoot>
				      <tr>
				         <th></th>
				         <th colspan="3"><b>Total</b></th>
				         <th><b>152.95 INR</b></th>
				      </tr>
				      <tr>
				         <th><b></b></th>
				         <th colspan="3"><b>GST 5 (5.00%)</b></th>
				         <th><b>7.65 INR</b></th>
				      </tr>
				      <tr>
				         <th><b></b></th>
				         <th colspan="3"><b>GST 8 (8.00%)</b></th>
				         <th><b>12.24 INR</b></th>
				      </tr>
				      <tr>
				         <th><b></b></th>
				         <th colspan="3"><b>Net Amount</b></th>
				         <th><b><span id="total">172.83</span> INR</b></th>
				      </tr>
				      <tr>
				         <th><b></b></th>
				         <th colspan="3"><b>Total Items</b></th>
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
