
function addInvoiceItem(item_id){

    var customer_id = $('#select2-customer_list_pos-container').attr('data-id'); 
    var invoice_id = $('#table_invoice_id').attr('data-id') ; 

    if(typeof(customer_id) === 'undefined' || parseInt(customer_id) === 0 ){
        
        showInfoModal('danger','Cliente','Selecciona un cliente para poder continuar.') ;
        $('#product_list_pos').empty();
        return  ;

    }else if(typeof(invoice_id) === 'undefined' || invoice_id === ""){ // || invoice_id === "0"

        showInfoModal('danger',' La factura no tiene identificador y no se pueden añadir elementos , porfavor contacta con el administrador.');
        return  ;

    }

    $.ajax({
        
        type : 'POST',
        url : '/OO_bones/admin/invoicecontroller/addInvoiceItem',
        data: { item_id : item_id , customer_id : customer_id, invoice_id : invoice_id},
        dataType : 'json',
        beforeSend: function(){
            $('#invoice_box').append("<div class='overlay'><i class='fa fa-refresh fa-spin'></i></div>");
        },
        success : function(result) {
            
            if(typeof(result.status) !== 'undefined' && result.status == 400){
                alert('No se ha podido actualizar el item : '+ result.detail);
                showInfoAlert('danger',' Item '+item_id+' añadido al ticket . A la factura : '+ result);
                return ;
            }

            if($('#table_invoice_id').attr('data-id') === '0'){
                $('#table_invoice_wrap').attr('hidden',false) ;
                $('#table_invoice_id').attr('data-id',result[0].invoice_id);
                $('#table_invoice_id').html('');
                $('#table_invoice_id').html(result[0].invoice_id);
            } 

            showInfoAlert('success',' Item '+item_id+' añadido al ticket . A la factura : '+ result[0].invoice_id);
            
            drawInvoiceTable(result);

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

}

function deleteInvoiceItem(item_id,invoice_id,customer_id){

    $.ajax({
        
        type : 'POST',
        url : '/OO_bones/admin/invoicecontroller/deleteInvoiceItem',
        data: { item_id : item_id , customer_id : customer_id, invoice_id : invoice_id},
        dataType : 'json',
        beforeSend: function(){
            $('#invoice_box').append("<div class='overlay'><i class='fa fa-refresh fa-spin'></i></div>");
        },
        success : function(result) {
            
            if(typeof(result.status) !== 'undefined' && result.status == 400){
                alert('No se ha podido eliminar el item : '+ result.detail);
            }

            drawInvoiceTable(result,invoice_id,customer_id);

            showInfoAlert('warning',' Eliminado item '+item_id+' de la factura '+invoice_id); 

        },
        error : function(result){

            if(typeof(result.detail) === 'undefined')
                console.log('There is an error making ajax call. Please check console log');
            
            console.log('Ajax call failed .Error result : '+result.detail);
            
        },
        complete: function(result){
            $('#invoice_box > .overlay').remove();
        }
    
    });

}

function deleteInvoice(invoice_id,customer_id){

    var customer_id = $('#select2-customer_list_pos-container').attr('data-id'); 
    var invoice_id = $('#table_invoice_id').attr('data-id') ; 

    if(typeof(customer_id) === 'undefined' || parseInt(customer_id) === 0 ){
        
        showInfoModal('danger','Cliente','Selecciona un cliente para poder continuar.') ;
        $('#product_list_pos').empty();
        return  ;

    }else if(typeof(invoice_id) === 'undefined' || invoice_id === "0"){ // || invoice_id === "0"

        showInfoModal('danger','Factura','No tienes productos en el ticket') ;
        return  ;

    }

    $.ajax({
        
        type : 'POST',
        url : '/OO_bones/admin/invoicecontroller/deleteInvoice',
        data: { customer_id : customer_id, invoice_id : invoice_id},
        dataType : 'text',
        success : function(result) {
            
            if(typeof(result.status) !== 'undefined' && result.status == 400){
                alert('No se ha podido eliminar la factura : '+ result.detail);
            }

            $('#table_invoice_wrap').attr('hidden',true) ;
            $('#table_invoice_id').attr('data-id','0');
            $('#customer_list_pos').empty();
            $('#product_list_pos').empty();
            $('#category_list_pos').empty();
            
            showInfoAlert('warning',' Se ha eliminado la factura '+result); 

        },
        error : function(result){

            if(typeof(result.detail) === 'undefined')
                console.log('There is an error making ajax call. Please check console log');
            
            console.log('Ajax call failed .Error result : '+result.detail);
            
        }
    
    });

}


