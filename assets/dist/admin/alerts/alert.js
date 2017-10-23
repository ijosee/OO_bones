
function showInfoAlert(type,message){

	var alert = $('#alert_pos');

	var alert_pos = $('#alert_pos_message') ; 
	alert_pos.html('');
	alert_pos.html(message);

	var type_f = 'alert alert-##'.replace('##',type);
	alert.attr('class',type_f); 

	alert.fadeTo(2000, 500).slideUp(500, function(){
               $("#alert").slideUp(500);
    }); 

}

function showInfoModalAlert(type,message){

	var alert = $('#alert_pos_payment');

	var alert_pos = $('#alert_pos_message_payment') ; 
	alert_pos.html('');
	alert_pos.html(message);

	var type_f = 'alert alert-##'.replace('##',type);
	alert.attr('class',type_f); 

	alert.fadeTo(2000, 500).slideUp(500, function(){
               $("#alert").slideUp(500);
    }); 

}