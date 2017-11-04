<script src="<?php echo base_url('assets/dist/admin/modals/modal.js');?>"></script>
<script src="<?php echo base_url('assets/dist/admin/alerts/alert.js');?>"></script>
<script src="<?php echo base_url('assets/dist/admin/pos/pos_history.js');?>"></script>
<script src="<?php echo base_url('assets/dist/admin/datatable/jquery.dataTables.js');?>"></script>
<script src="<?php echo base_url('assets/dist/admin/datatable/dataTables.bootstrap.js');?>"></script>


<div class="row">

	<div class="alert alert-danger" id="alert_pos" style="display: none;"> 
	    <span id='alert_pos_message'></span>
	</div>

	<div class="box">
    <div class="box-header">
      <h3 class="box-title">Listado de facturas</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="pos_history_table" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>id</th>
          <th>first_name</th>
          <th>last_name</th>
          <th>active</th>
          <th>on_hold</th>
          <th>paid</th>
          <th>created_time</th>
          <th>last_update</th>
          <th>comment</th>
          <th>pay_method</th>
          <th>actions</th>
        </tr>
        </thead>

        <tbody>

        </tbody>
        
        <tfoot>
        <tr>
          <th>id</th>
          <th>first_name</th>
          <th>last_name</th>
          <th>active</th>
          <th>on_hold</th>
          <th>paid</th>
          <th>created_time</th>
          <th>last_update</th>
          <th>comment</th>
          <th>pay_method</th>
          <th>actions</th>
        </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->

</div>
	
<div class="modal fade" id="modal_pos_invoice">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="modal-pos-history-title">Modal title</h4>
      </div>

      <div class="modal-body" id="modal-pos-history-body">
        <section class="invoice" style="color:black">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> Origen Orgánico
            <small class="pull-right" id="modal-pos-invoice-now">Hoy, 14/10/1983</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          Dirección facturación
          <address>
            <strong>Origen Orgánico</strong><br>
            Pascual Ribot, 69<br>
            Palma de Mallorca, 07141<br>
            Teléfono : (607) 22 50 91<br>
            Email: info@origenorganic.com
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          Dirección cliente
          <address>
            <strong id="modal-pos-invoice-client-name">Jose Mateu</strong><br>
            - sin dirección del cliente<br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b id="modal-pos-invoice-id" data-id="">Factura #00014</b><br>
          <br>
          <b>Pedido ID:</b> 4F3S8J<br>
          <b>Última actualización :</b> 2/22/2014<br>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped" id="modal-pos-invoice-history-table">
            <thead>
            <tr>
              <th>Id</th>
              <th>Nombre</th>
              <th>Precio</th>
              <th>Cantidad</th>
              <th>Total</th>
            </tr>
            </thead>
            <tbody>
            <tr>
             <!-- 
              <td>1</td>
              <td>Call of Duty</td>
              <td>455-981-221</td>
              <td>El snort testosterone trophy driving gloves handsome</td>
              <td>$64.50</td>
             -->
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead">Metodos de pago:</p>
          <img src="../../dist/img/credit/visa.png" alt="Visa">
          <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
          <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;" id="modal-pos-invoice-history-customer-comment">
            Comentario de la factura
          </p>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead" id="modal-pos-invoice-created-time">Fecha Factura 2/22/2014</p>

          <div class="table-responsive">
            <table class="table">
              <tbody><tr>
                <th style="width:50%">Subtotal:</th>
                <td id="modal_pos_history_payment_subtotal">$250.30</td>
              </tr>
              <tr>
                <th>IVA (21%)</th>
                <td id="modal_pos_history_payment_iva">$10.34</td>
              </tr>
              <tr>
                <th>Descuento:</th>
                <td id="modal_pos_history_payment_discount">$5.80</td>
              </tr>
              <tr>
                <th>Total:</th>
                <td id="modal_pos_history_payment_total">$265.24</td>
              </tr>
            </tbody></table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">

        <div class="col-xs-12" id="spinBefore">
          
          <div class="col-xs-3">
            <input type="checkbox" data-toggle="toggle" id ="modal_pos_toggle_active" data-on="Activo" data-off="Desactivado" data-style="slow" data-width="100%">
          </div>

          <div class="col-xs-4">
            <input type="checkbox" data-toggle="toggle" id ="modal_pos_toggle_on_hold" data-on="Bloqueada" data-off="Desbloqueado" data-style="slow" data-width="100%">
          </div>

          <div class="col-xs-2">
            <input type="checkbox" data-toggle="toggle" id ="modal_pos_toggle_paid" data-on="Pagado" data-off="Deuda" data-style="slow" data-width="100%"> 
          </div>
          <!-- <button href="invoice-print.html" target="_blank" class="btn btn-default">
            <i class="fa fa-print"></i> Imprimir
          </button> -->

          <!--<button type="button" class="btn btn-success pull-right">
            <i class="fa fa-credit-card"></i> Confirmar Pago
          </button> 
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generar Ticket
          </button>-->

        </div>

      </div>
    </section>
      </div>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

