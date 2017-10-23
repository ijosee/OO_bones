
function showInfoModal(type,title,message){

	var modal = $('#modal_pos');

	var modal_title = $('#modal-pos-title');
	var modal_body = $('#modal-pos-body');
	var modal_footer = $('#modal-pos-footer');

	modal_title.html('');
	modal_body.html('');

	var type_f = 'modal modal-## fade'.replace('##',type);
	modal.attr('class',type_f); 
	modal_title.html(title);
	modal_body.html(message);

	modal.modal('show') ;

}

function showPaymentModal(){

	var modalPayment = $('#modal_pos_payment') ; 

	var invoice_id = $('#table_invoice_id').attr('data-id') ;
	var customer_id = $('#select2-customer_list_pos-container').attr('data-id'); 

	if(typeof(customer_id) === 'undefined' || parseInt(customer_id) === 0 )
	    return showInfoModal('danger','Cliente','Selecciona un cliente para poder continuar.') ;

	if(parseInt(invoice_id) === 0 ) 
		return showInfoAlert('danger','No hay productos en la factura, añade uno para poder continuar') ;

	$.ajax({
	    
	    type : 'POST',
	    url : '/OO_bones/admin/invoicecontroller/readInvoice',
	    data: { invoice_id : invoice_id},
	    dataType : 'json',
	    beforeSend: function(){
	        $('#invoice_box').append("<div class='overlay'><i class='fa fa-refresh fa-spin'></i></div>");
	    },
	    success : function(result) {
	        
	        if(typeof(result.status) !== 'undefined' && result.status == 400){
	            alert('No se ha podido actualizar el item : '+ result.detail);
	            showInfoAlert('danger',' Item '+item_id+' NO añadido al ticket . A la factura : '+ result);
	            return ;
	        }

	        showInfoAlert('success',' Factura '+ result.results.invoice_id+ ' recuperada . ');
	        
	        setInvoiceModalTable(result);

	    },
	    error : function(result){

	        if(typeof(result.detail) === 'undefined')
	            console.log('There is an error making ajax call. Please check console log');
	        
	        console.log('Ajax call failed .Error result : '+result.detail);
	        
	    },
	    complete: function(result){

	        //readInvoice(result.responseText);
	        $('#invoice_box > .overlay').remove();
	       
	    }
	
	});


	modalPayment.modal('show') ;

}



