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
	</div
	>
	<div class="box-body">
		<div id="productList" class="table-responsive">
		<table class="table table-striped"><thead><tr><th width="5%"></th><th width="30%" class="name">Name</th><th width="20%">Price</th><th width="15%">Qty</th><th width="30%">Total</th></tr></thead><tbody><tr><td><a onclick="DeleteSaleItem('44')" class="delete"><i class="fa fa-times-circle-o"></i></a></td><td class="name">1321321</td><td>3231.00</td><td><input class="form-control qty" onchange="UpdateSaleItem('44',this.value)" value="1"></td><td>3231.00</td></tr><tr><td><a onclick="DeleteSaleItem('43')" class="delete"><i class="fa fa-times-circle-o"></i></a></td><td class="name">12</td><td>13.50</td><td><input class="form-control qty" onchange="UpdateSaleItem('43',this.value)" value="1"></td><td>13.50</td></tr><tr><td><a onclick="DeleteSaleItem('34')" class="delete"><i class="fa fa-times-circle-o"></i></a></td><td class="name">8944260907059847113</td><td>0.00</td><td><input class="form-control qty" onchange="UpdateSaleItem('34',this.value)" value="1"></td><td>0.00</td></tr></tbody><tfoot><tr><th></th><th colspan="3"><b>Total</b></th><th><b>3244.50 INR</b></th></tr><tr><th><b></b></th><th colspan="3"><b>GST 15 (15.00%)</b></th><th><b>486.68 INR</b></th></tr><tr><th><b></b></th><th colspan="3"><b>VAT (20.00%)</b></th><th><b>648.90 INR</b></th></tr><tr><th><b></b></th><th colspan="3"><b>Net Amount</b></th><th><b><span id="total">4380.08</span> INR</b></th></tr><tr><th><b></b></th><th colspan="3"><b>Total Items</b></th><th><b>3</b></th></tr></tfoot></table>
		
		</div>
	</div>
	
	<div class="box-footer">
		<input type="submit" name="ctl00$MainContent$btnReset" value="Borrar"
			id="MainContent_btnReset" class="btn margin btn-danger"> <a
			onclick="PopupPayment()" class="btn btn-primary margin pull-right">Pago</a>
		<a onclick="PopupHold()" class="btn btn-success margin pull-right">Postponer</a>
	</div>
</div>
