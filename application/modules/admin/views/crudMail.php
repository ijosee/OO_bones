<script src="<?php echo base_url('assets/dist/admin/admin_mail.js');?>"></script>
<div class="box box-warning" id="box_body_mailchimp">
	<div class="box-header with-border">
		<h3 class="box-title">MailChimp</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<p>
			Introduce tu API KEY de MailChimp en el formato correcto.
			<span class="help-block">
				Nota : sino recuerdas tu api key , puedes conseguirla aqui
				<a href="http://www.mailchimp.com">Mailchimp</a>
			</span>
		</p>
		<!-- input states -->
		<div class="form-group has-error" id="label_check_api_key">
			<!-- success ,warning-->
			<label class="control-label" for="inputError" id="label_check_api_key_label">
				<i class="fa fa-times-circle-o"></i>
				La clave no es válida
			</label>
			<input type="text" class="form-control" id="inputCheckApiKeyMailChimp" placeholder="" value="56ec508114429503a18b2b2ca81cc7ca-us16">
			<!-- 				<span class="help-block">El campo esta vacio o no tiene el formato correcto</span> -->
		</div>
		<div class="form-group col-xs-12 has-errors" style="padding: 0px !important;">
			<label style="display: block;">
				Selecciona una campaña
				<span class="help-block" id="mail_chimp_campaign_span_info"></span>
			</label>
			<div class="col-xs-12" style="padding: 0px !important;">
				<select class="form-control" id="mail_chimp_campaign" disabled>
					<option>Selecciona una campaña</option>
				</select>
			</div>
			<div class="col-xs-6" style="padding: 0px !important; margin: 0.2% 0%;" id="mail_chimp_campaign_button_groups" hidden>
				<div class="btn-group btn-group-xs">
					<button type="button" class="btn btn-info btn-xs" id="create_campaign_button">Crear</button>
					<button type="button" class="btn btn-danger btn-xs" id="delete_campaign_button">Eliminar</button>
					<button type="button" class="btn btn-warning btn-xs" id="replicate_campaign_button">Copiar</button>
				</div>
			</div>
		</div>
		<div class="form-group has-warnings">
			<label style="display: block;">Selecciona una lista de distribución</label>
			<div class="col-xs-12" style="padding: 0px !important;">
				<select class="form-control" id="mail_chimp_list" disabled>
					<option>Selecciona una lista de distribución</option>
				</select>
			</div>
			<div class="col-xs-2" style="padding: 0px !important; margin: 0.2% 0%;" id="mail_chimp_list_button_groups" hidden>
				<div class="btn-group btn-group-xs">
					<button type="button" class="btn btn-info btn-xs" id="create_campaign_button">Crear</button>
					<button type="button" class="btn btn-danger btn-xs" id="delete_campaign_button">Eliminar</button>
				</div>
			</div>
		</div>
	</div>
	<!-- /.box-body -->
	<div class="box-footer">
		<button type="submit" class="btn btn-warning pull-right" id="send_campaigns_mail_chimp" disabled s>Enviar mails</button>
	</div>
</div>
<?php if ( !empty($crud_note) ) echo "<p>$crud_note</p>"; ?>

<?php if ( !empty($crud_output) ) echo $crud_output; ?>

