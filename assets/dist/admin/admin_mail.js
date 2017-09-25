$(document).ready(function(){
	
	// inicialice elements neded
	
	// 1.- check the api key and enable campaigns
	checkMailChimpApi();
	
	
	// ------------------------------------------------------------ ON CHANGE 
	
	$('#mail_chimp_campaign').on('change',function(value){
		
		console.log('api key : '+$('#inputCheckApiKeyMailChimp').val());
		console.log('id campaigns : '+$(this).find('option:selected').val());
		
		if($('#mail_chimp_campaign').val() !== "Selecciona una campaña" ){
			
			$('#send_campaigns_mail_chimp').prop('disabled',false);
			$('#mail_chimp_campaign_button_groups').fadeIn('slow');	
			
			// EYE ! this can be consfused. this returns only one campaigns
			getCampaign();
			getLists();
			
		}else{
			
			$('#send_campaigns_mail_chimp').prop('disabled',true);
			$('#mail_chimp_list').prop('disabled',true);
			$('#mail_chimp_campaign_button_groups').fadeOut('fast');
			$('#mail_chimp_list_button_groups').fadeOut('fast');
			
		}
		
	})
	
	$('#mail_chimp_list').on('change',function(value){
		
		console.log('api key : '+$('#inputCheckApiKeyMailChimp').val());
		console.log('id list : '+$(this).find('option:selected').val());
		
		if($('#mail_chimp_list').val() !== "Selecciona una lista de distribución" ){
			
			$('#send_campaigns_mail_chimp').prop('disabled',false);
			$('#mail_chimp_list_button_groups').fadeIn('slow');	
			
		}else{
			
			$('#send_campaigns_mail_chimp').prop('disabled',true);
			$('#mail_chimp_list').prop('disabled',false);
			$('#mail_chimp_list_button_groups').fadeOut('fast');
			
			// loop on id = flex1 crud table 
			var table = document.getElementById('flex1');
			var rowLength = table.rows.length;
			for (var i = 1; i < rowLength; i += 1) {
				var row = table.rows[i];
				var emailCustomer = row.cells[0].children[0].children[0].id.replace("_", "@").replace("-", ".");
				row.cells[0].children[0].children[0].checked = false;
			}

		}
		
		checkKnowedMailsInList($(this).find('option:selected').val(),$('#inputCheckApiKeyMailChimp').val());
		
	})
	
	// ------------------------------------------------------------ ON CLICK 
	
	// -------- CAMPAIGN
	
	$('#send_campaigns_mail_chimp').on('click',function(){
		
		var api_key = $('#inputCheckApiKeyMailChimp').val()
		var campaign_id = $('#mail_chimp_campaign').val() ;
		
		$.ajax({
			type : 'POST',
			url : '/OO_bones/admin/mail/sendCampaing',
			data : { api_key : api_key, campaign_id : campaign_id},
			dataType : 'json',
			beforeSend: function(){
				$('#box_body_mailchimp').append("<div class='overlay'><i class='fa fa-refresh fa-spin'></i></div>");
			},
			success : function(result) {
				
				if(typeof(result.status) !== 'undefined' && result.status == 400){
					alert('No se ha podido enviar la campaña : '+result.detail);
				}
				
			},
			error : function(result){
				$('#main-box_body_mailchimp > .overlay').remove();
				if(typeof(result.detail) === 'undefined')
					console.log('There is an error making ajax call. Please check console log');
				
				console.log('Ajax call failed .Error result : '+result.detail);
				
			},
			complete: function(result){
				$('#box_body_mailchimp > .overlay').remove();
			}
		});
	});
	
	$('#create_campaign_button').on('click',function(){
		
	    var date = new Date().toLocaleString();
	    var campaignName = prompt("Introduce el nombre de la campaña:", "Campaña nueva "+date);
		
		var requestApi = {};
		requestApi.recipients = {};
		requestApi.recipients.list_id = $('#mail_chimp_list').val();
		
		requestApi.type = 'regular';
		
		requestApi.settings = {};
		requestApi.settings.subject_line = campaignName;
		requestApi.settings.reply_to = 'ijose@aol.es';
		requestApi.settings.from_name = 'jose el mailer';
		
		var api_key =$('#inputCheckApiKeyMailChimp').val()
		var campaign_id = $('#mail_chimp_campaign').val();

			$.ajax({
				type : 'POST',
				url : '/OO_bones/admin/mail/createCampaigns',
				data : { api_key : api_key ,requestApi :  requestApi},
				dataType : 'json',
				beforeSend: function(){
					$('#box_body_mailchimp').append("<div class='overlay'><i class='fa fa-refresh fa-spin'></i></div>");
				},
				success : function(result) {
					
					console.log('Se ha creado la campaña correctamente. Ahora falta añadirle el content');
					
				},
				error : function(result){
					$('#main-box_body_mailchimp > .overlay').remove();
					if(typeof(result.detail) === 'undefined')
						console.log('There is an error making ajax call. Please check console log');
					
					console.log('Ajax call failed .Error result : '+result.detail);
					
				},
				complete: function(result){
					$('#box_body_mailchimp > .overlay').remove();
				}
			});
			
	});
	
	$('#replicate_campaign_button').on('click',function(){
		
		var api_key =$('#inputCheckApiKeyMailChimp').val()
		var campaign_id = $('#mail_chimp_campaign').val();

			$.ajax({
				type : 'POST',
				url : '/OO_bones/admin/mail/replicateCampaigns',
				data : { api_key : api_key ,campaign_id :  campaign_id},
				dataType : 'json',
				beforeSend: function(){
					$('#box_body_mailchimp').append("<div class='overlay'><i class='fa fa-refresh fa-spin'></i></div>");
				},
				success : function(result) {
					
					console.log('Se ha copiado correctamente la campaña');
					
				},
				error : function(result){
					$('#main-box_body_mailchimp > .overlay').remove();
					if(typeof(result.detail) === 'undefined')
						console.log('There is an error making ajax call. Please check console log');
					
					console.log('Ajax call failed .Error result : '+result.detail);
					
				},
				complete: function(result){
					$('#box_body_mailchimp > .overlay').remove();
					
				}
			});
			
	});
	
	$('#delete_campaign_button').on('click',function(){
		
		var api_key =$('#inputCheckApiKeyMailChimp').val()
		var campaign_id = $('#mail_chimp_campaign').val();

			$.ajax({
				type : 'POST',
				url : '/OO_bones/admin/mail/deleteCampaigns',
				data : { api_key : api_key ,campaign_id :  campaign_id},
				dataType : 'json',
				beforeSend: function(){
					$('#box_body_mailchimp').append("<div class='overlay'><i class='fa fa-refresh fa-spin'></i></div>");
				},
				success : function(result) {
					
					console.log('Se ha borrado correctamente la campaña');
					
				},
				error : function(result){
					$('#main-box_body_mailchimp > .overlay').remove();
					if(typeof(result.detail) === 'undefined')
						console.log('There is an error making ajax call. Please check console log');
					
					console.log('Ajax call failed .Error result : '+result.detail);
					
				},
				complete: function(result){
					$('#box_body_mailchimp > .overlay').remove();
					
				}
			});
	});
	
	// -------- LISTS
	
	$('#create_list_button').on('click',function(){
		
	    var date = new Date().toLocaleString();
	    var listName = prompt("Introduce el nombre de la lista:", "Campaña nueva "+date);

		var api_key =$('#inputCheckApiKeyMailChimp').val()
		var list_id = $('#mail_chimp_list').val();
			
	});
	
	$('#delete_list_button').on('click',function(){
			
			var api_key =$('#inputCheckApiKeyMailChimp').val()
			var list_id = $('#mail_chimp_list').val();
	
		});
	});


// ------------------------------------------------------------ FUNCTIONS

function checkMailChimpApi(){
	
	$('#label_check_api_key').attr('class','form-group has-success');
	$('#label_check_api_key_label').html("<label class='control-label' for='inputError' id='label_check_api_key_label'><i class='fa fa-check'></i> ¡ Genial ! </label>");
	getCampaigns();

}



function checkKnowedMailsInList(list_id,api_key){
	var temp_email_array = [];
		$.ajax({
				type : 'POST',
				url : "/OO_bones/admin/mail/getCustomersEmailsInList",
				data : {list_id : list_id,api_key : api_key},
				dataType : 'json',
				beforeSend: function(){
					$('#box_body_mailchimp').append("<div class='overlay'><i class='fa fa-refresh fa-spin'></i></div>");
				},
				success : function(result) {
					if (typeof (result.members) !== 'undefined') {

						for (var a = 0; a < result.members.length; a++) {
							// loop on id = flex1 crud table 
							var table = document.getElementById('flex1');
							var rowLength = table.rows.length;

							for (var i = 1; i < rowLength; i += 1) {
								
								var row = table.rows[i];

									var emailCustomer = row.cells[0].children[0].children[0].id.replace("_","@").replace("-",".");

									if (result.members[a].email_address === emailCustomer) {
										
										row.cells[0].children[0].children[0].checked = true; 
										temp_email_array.push(emailCustomer);
										continue;
										
									} else{
										
										if($.grep(temp_email_array, function(e){return e == emailCustomer;}) == 0){
											row.cells[0].children[0].children[0].checked = false;
										}
									}
							}
						}

					}
				},
		error : function(result){
			
			if(typeof(result.detail) === 'undefined')
				console.log('There is an error making ajax call. Please check console log');
			
			console.log('Ajax call failed .Error result : '+result.detail);
			
		},
		complete: function(result){
			$('#box_body_mailchimp > .overlay').remove();
			
		}
	});
}

function addDeleteMemberToList(input){
	
	if($('#mail_chimp_list').val() !== "Selecciona una lista de distribución" ){
		
		var customer_email = input.id.replace("_","@").replace("-",".");
		var list_id = $('#mail_chimp_list').val() ;
		var api_key =$('#inputCheckApiKeyMailChimp').val()
		var url = '';
		
		if($('#'+input.id).is(':checked')){
			url = "/OO_bones/admin/mail/suscribeMemberToAList";
		}else{
			url = "/OO_bones/admin/mail/unsuscribeMemberToAList";
		}
		
		$.ajax({
			type : 'POST',
			url : url,
			data : { list_id : list_id , customer_email : customer_email, api_key : api_key },
			dataType : 'json',
			beforeSend: function(){
				$('#main-table-box').append("<div class='overlay'><i class='fa fa-refresh fa-spin'></i></div>");
			},
			success : function(result) {
				if(result == false){
					console.log('The member was unsucribed to the list, sorry to see you away.');
				}else if(typeof(result.email_address) !== 'undefined' && typeof(result.status) !== 'undefined'){
					console.log('The member : '+ result.email_address + ' was '+result.status+' to the list .');
				}
			},
			error : function(result){
				
				if(typeof(result.detail) === 'undefined')
					console.log('There is an error making ajax call. Please check console log');
				
				console.log('Ajax call failed .Error result : '+result.detail);
				
			},
			complete: function(result){
				$('#main-table-box > .overlay').remove();
			}
		});
		
	}else{
		
		alert('Debes seleccionar una lista de distribución a la que añadir el mail.');
		
	}
	
	
}



// ------------------------------------ CAMPAIGNS

function getCampaigns(){
	
	var api_key =$('#inputCheckApiKeyMailChimp').val()
	
	$.ajax({
		type : 'POST',
		url : '/OO_bones/admin/mail/getCampaigns',
		data : { api_key : api_key },
		dataType : 'json',
		beforeSend: function(){
			$('#box_body_mailchimp').append("<div class='overlay'><i class='fa fa-refresh fa-spin'></i></div>");
		},
		success : function(result) {
			
			if(typeof(result.campaigns) !== 'undefined' ){
				$('#mail_chimp_campaign').prop('disabled',false);
				$('#mail_chimp_campaign').html('<option value="Selecciona una campaña">Selecciona una campaña</option>');
				
				for (var a = 0 ; a < result.campaigns.length ; a++){
					$('#mail_chimp_campaign').append('<option value ='+result.campaigns[a].id+'>'+result.campaigns[a].settings.subject_line+'</option>');
				}
			}else{
				console.log('Campaigns is empty. Could be timeout .');
			}
			
		},
		error : function(result){
			$('#main-box_body_mailchimp > .overlay').remove();
			if(typeof(result.detail) === 'undefined')
				console.log('There is an error making ajax call. Please check console log');
			
			console.log('Ajax call failed .Error result : '+result.detail);
			
		},
		complete: function(result){
			$('#box_body_mailchimp > .overlay').remove();
			
		}
	});
}

function getCampaign(){
	
	var api_key =$('#inputCheckApiKeyMailChimp').val();
	var campaign_id = $('#mail_chimp_campaign').val(); 
	
	$.ajax({
		type : 'POST',
		url : '/OO_bones/admin/mail/getCampaign',
		data : { api_key : api_key , campaign_id : campaign_id },
		dataType : 'json',
		beforeSend: function(){
			$('#box_body_mailchimp').append("<div class='overlay'><i class='fa fa-refresh fa-spin'></i></div>");
		},
		success : function(result) {
			
			if(typeof(result.recipients) !== 'undefined' ){
				$('#mail_chimp_campaign_span_info').html('');
				$('#mail_chimp_campaign_span_info').html(result.recipients.recipient_count + ' mientro(s) en la lista '+result.recipients.list_name);
			}else{
				console.log('Campaigns is empty. Could be timeout .');
			}
		},
		error : function(result){
			$('#main-box_body_mailchimp > .overlay').remove();
			if(typeof(result.detail) === 'undefined')
				console.log('There is an error making ajax call. Please check console log');
			
			console.log('Ajax call failed .Error result : '+result.detail);
			
		},
		complete: function(result){
			$('#box_body_mailchimp > .overlay').remove();
			
		}
	});
}


//------------------------------------ LISTS

function getLists(){
	
	var api_key =$('#inputCheckApiKeyMailChimp').val()
	
	$.ajax({
		type : 'POST',
		url : '/OO_bones/admin/mail/getLists',
		data : { api_key : api_key },
		dataType : 'json',
		beforeSend: function(){
			$('#box_body_mailchimp').append("<div class='overlay'><i class='fa fa-refresh fa-spin'></i></div>");
		},
		success : function(result) {
			
			$('#mail_chimp_list').prop('disabled',false);
			$('#mail_chimp_list').html('<option value="Selecciona una lista de distribución">Selecciona una lista de distribución</option>');
			
			for (var a = 0 ; a < result.lists.length ; a++){
				
				$('#mail_chimp_list').append('<option value ='+result.lists[a].id+'>'+result.lists[a].name+'</option>');
				
			}
				
		},
		error : function(result){
			
			$('#main-box_body_mailchimp > .overlay').remove();
			if(typeof(result.detail) === 'undefined')
				console.log('There is an error making ajax call. Please check console log');
			
			console.log('Ajax call failed .Error result : '+result.detail);
			
		},
		complete: function(result){
			$('#box_body_mailchimp > .overlay').remove();
			
		}
	});
}





////////// OLD CODE 


//$("#inputCheckApiKeyMailChimp").keyup(function(){
//
//if($("#inputCheckApiKeyMailChimp").val().match('([a-z 0-9]{32})-([a-z 0-9]{4})')){
//	
//	var api_key = $("#inputCheckApiKeyMailChimp").val(); 
//	
//	$.ajax({
//		type:"POST",
//		url: "/OO_bones/admin/mail/getCampaigns", 
//		data: { api_key : api_key },
//		dataType : "json",
//		beforeSend: function(){
//			$('#box_body_mailchimp').append("<div class='overlay'><i class='fa fa-refresh fa-spin'></i></div>");
//		},
//		success: function(result){
//			
//			if(typeof(result.campaigns) !== 'undefined'){
//				
//				$('#label_check_api_key').attr('class','form-group has-success');
//				$('#label_check_api_key_label').html("<label class='control-label' for='inputError' id='label_check_api_key_label'><i class='fa fa-check'></i> ¡ Genial ! </label>");
//				
//				$('#mail_chimp_campaigns').html('<option>Selecciona una campaña</option>');
//				
//				for (var a = 0 ; a < result.campaigns.length ; a++){
//					$('#mail_chimp_campaign').prop('disabled',false);
//					$('#mail_chimp_campaign').append('<option value ='+result.campaigns[a].id+'>'+result.campaigns[a].settings.subject_line+'</option>');
//				}
//				
//				$('#mail_chimp_campaign_button_groups').fadeIn('slow');
//				
//			}
//			else if (typeof(result.lists) === 'undefined' && typeof(result.detail) !== 'undefined' ) {
//				
//				$('#label_check_api_key').attr('class','form-group has-warning');
//				$('#label_check_api_key_label').html("<label class='control-label' for='inputError' id='label_check_api_key_label'><i class='fa fa-times-circle-o'></i> La clave tiene el formato correcto , pero es inválida. Comprueba la consola </label>");
//				$('#mail_chimp_campaign').prop('disabled',true);
//				$('#mail_chimp_campaign').html('<option>v</option>');
//				console.log("Error message : "+ result.detail);
//				console.log("Reference : "+ result.type);
//				
//			}
//			
//		},
//		error : function(result){
//			$('#label_check_api_key').attr('class','form-group has-error');
//			$('#label_check_api_key_label').html("<label class='control-label' for='inputError' id='label_check_api_key_label'><i class='fa fa-times-circle-o'></i> ¡ AJAX call failed !  </label>");
//			$('#mail_chimp_campaign').prop('disabled',true);
//			$('#mail_chimp_campaign').html('<option>Selecciona una campaña</option>');
//			console.log('Ajax call failed');
//		},
//		complete: function(result){
//			
//			$('#box_body_mailchimp > .overlay').remove();
//			
//		}
//	});
//}
//else{
//	$('#label_check_api_key').attr('class','form-group has-error');
//	$('#label_check_api_key_label').html("<label class='control-label' for='inputError' id='label_check_api_key_label'><i class='fa fa-times-circle-o'></i> La clave no es válida </label>");
//	$('#mail_chimp_list').prop('disabled',true);
//	$('#mail_chimp_campaign').prop('disabled',true);
//	$('#mail_chimp_list').html('<option>Selecciona una lista de distribución</option>');
//	$('#mail_chimp_campaign').html('<option>Selecciona una capaña</option>');
//	console.log('Mailchimp key , not valid :  '+$("#inputCheckApiKeyMailChimp").val());
//}
//});
