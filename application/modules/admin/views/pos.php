<script src="<?php echo base_url('assets/dist/admin/pos/admin_pos.js');?>"></script>
<script src="<?php echo base_url('assets/dist/admin/pos/invoice.js');?>"></script>
<script src="<?php echo base_url('assets/dist/admin/modals/modal.js');?>"></script>
<script src="<?php echo base_url('assets/dist/admin/alerts/alert.js');?>"></script>
<script src="<?php echo base_url('assets/dist/admin/select_2/js/select2.js');?>"></script>

<div class="row">

	<div class="alert alert-danger" id="alert_pos" style="display: none;"> 
	    <span id='alert_pos_message'></span>
	</div>

	<div class="col-xs-5">
	<?php 
	 echo modules::run('adminlte/sand/comp_widget_sand'); ?>
	</div>

	<div class="col-xs-7">
	<?php echo modules::run('adminlte/sand/comp_widget_sand_large'); ?>
	</div>

</div>
	
<div class="modal fade" id="modal_pos">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="modal-pos-title">Modal title</h4>
      </div>

      <div class="modal-body" id="modal-pos-body">
        <p>One fine body…</p>
      </div>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="modal_pos_payment">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <span class="lead" id="modal_pos_payment_invoice_id">0</span>
      </div>

      <div class="modal-body" id="modal_pos_payment_body">

      	<div class="alert alert-danger" id="alert_pos_payment" style="display: none;">
      	    <span id='alert_pos_message_payment'></span>
      	</div>

      		<p>
      			<strong>Cliente : </strong> <span id="modal_pos_payment_customer_name"></span></br> 
      			<strong>Fecha : </strong> <span id="modal_pos_payment_date"></span> </br> 
      			<strong>Hora : </strong> <span id="modal_pos_payment_hour"></span> </br> 
      		</p>
          <div class="table-responsive">
            <table class="table">
              <tbody>
              <tr>
                <th>Subtotal:</th>
                <td id="modal_pos_payment_subtotal">00.0 €</td>
              </tr>
              <tr>
                <th>IVA (21 %)</th>
                <td id="modal_pos_payment_iva">00.0 €</td>
              </tr>
              <tr>
                <th>Descuentos</th>
                <td id="modal_pos_payment_discount">00.0 €</td>
              </tr>
              <tr>
                <th>Total:</th>
                <td id="modal_pos_payment_total">00.0 €</td>
              </tr>
            </tbody>
          </table>
          </div>
          <h5 style="font-weight: bold;">Método de pago :</h5>
          <p>
            <a class="btn btn-info btn-sq-lg btn-primary pull-right paymentMethod" data-id = "CASH">
                <i class="fa fa-money fa-5x" ></i><br/>
                Pago <br>Efectivo
            </a>
             <a class="btn btn-info btn-sq-lg btn-primary paymentMethod" data-id = "CREDIT">
                <i class="fa fa-credit-card fa-5x" ></i><br/>
                Pago <br>Tarjeta
            </a>

          </p>

      </div>

      <div class="modal-footer" id="modal-pos-footer" >
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
        <button type="button" onclick="openCashBox()" class="btn btn-warning pull-right">Cajón</button>
        <button type="button" onclick="confirmInvoice()" class="btn btn-success pull-right">Confirmar</button>

      </div>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
