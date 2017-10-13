function addItemBill(item_id){

    //var item_id = $(this).attr('data-id');
	var customer_id = $('#select2-customer_list_pos-container').attr('data-id'); 
	var invoice_id = $('#table_invoice_id').attr('data-id') ; 
	
	if(typeof(customer_id) === 'undefined' || customer_id === 0 ){
		return console.log('The customer id is empty') ;
	}else if(invoice_id === "0"){
		console.log('First item in invoice');
	}
		
	$('#table_invoice_wrap').attr('hidden',false) ;
	
    $.ajax({
        
        type : 'POST',
        url : '/OO_bones/admin/invoicecontroller/addBillItem',
        data: { item_id : item_id , customer_id : customer_id},
        dataType : 'text',
        beforeSend: function(){
            
        },
        success : function(result) {
            
            if(typeof(result.status) !== 'undefined' && result.status == 400){
                alert('No se ha podido actualizar el item : '+ result.detail);
            }
            
            // alert('cita guardada');
            console.log('Item ' + result + ' añadido');

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

function delItemBill(item_id){

    var item_ide = item_id;


    $.ajax({
        
        type : 'POST',
        url : '/OO_bones/admin/invoicecontroller/delBillItem',
        data: { eventId : eventId },
        dataType : 'text',
        beforeSend: function(){
            
        },
        success : function(result) {
            
            if(typeof(result.status) !== 'undefined' && result.status == 400){
                alert('No se ha podido actualizar el item : '+ result.detail);
            }
            
            // alert('cita guardada');
            console.log('Item ' + result + ' añadido');

        },
        error : function(result){

            if(typeof(result.detail) === 'undefined')
                console.log('There is an error making ajax call. Please check console log');
            
            console.log('Ajax call failed .Error result : '+result.detail);
            
        },
        complete: function(result){
            // $('#box_body_mailchimp > .overlay').remove();
        }
    
    });



}

function updateItemBillValue(item_id){

    var item_ide = item_id;


    $.ajax({
        
        type : 'POST',
        url : '/OO_bones/admin/invoicecontroller/updateBillItem',
        data: { eventId : eventId },
        dataType : 'text',
        beforeSend: function(){
            
        },
        success : function(result) {
            
            if(typeof(result.status) !== 'undefined' && result.status == 400){
                alert('No se ha podido actualizar el item : '+ result.detail);
            }
            
            // alert('cita guardada');
            console.log('Item ' + result + ' añadido');

        },
        error : function(result){

            if(typeof(result.detail) === 'undefined')
                console.log('There is an error making ajax call. Please check console log');
            
            console.log('Ajax call failed .Error result : '+result.detail);
            
        },
        complete: function(result){
            // $('#box_body_mailchimp > .overlay').remove();
        }
    
    });



}

function checkBill(item_id){


    var bill_table = $('#bill_wrapper').closest('table') ; 

    bill_table.each(function(each){

            var bill_table_line = each  ;

            if (bill_table_line === item_id){

                console.log('Existe un elemto igual en la lista, +1') ;

            }else{

                console.log('primera insercion , +1 ') ;
            }

    });



}
