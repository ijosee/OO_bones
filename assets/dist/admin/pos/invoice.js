
function addInvoiceItem(item_id){

    var customer_id = $('#select2-customer_list_pos-container').attr('data-id'); 
    var invoice_id = $('#table_invoice_id').attr('data-id') ; 

    if(typeof(customer_id) === 'undefined' || parseInt(customer_id) === 0 ){
        
        showInfoModal('danger','Cliente','Selecciona un cliente para poder continuar.') ;
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

    $.ajax({
        
        type : 'POST',
        url : '/OO_bones/admin/invoicecontroller/deleteInvoice',
        data: { customer_id : customer_id, invoice_id : invoice_id},
        dataType : 'text',
        success : function(result) {
            
            if(typeof(result.status) !== 'undefined' && result.status == 400){
                alert('No se ha podido eliminar la factura : '+ result.detail);
            }

            showInfoAlert('warning',' Se ha eliminado la factura '+result); 

        },
        error : function(result){

            if(typeof(result.detail) === 'undefined')
                console.log('There is an error making ajax call. Please check console log');
            
            console.log('Ajax call failed .Error result : '+result.detail);
            
        }
    
    });

}

// - ---------------------- ---------------------- ---------------------- --------------------- //


function drawInvoiceTable(results, invoice_id = null, customer_id = null){

    $('#table_invoice > tbody').empty();

    var sum_items  = 0;
    var sum_price  = 0;
    var sum_sub_total = 0;
    var CONS_IVA = 21 ; 
    var sum_iva = 0 ; 

    $.each(results, function(index,value){

        var invoice_table_one = $('#table_invoice > tbody') ; 

        var line_one = "<tr data-id = '"+value.product_id+"'>" +
                    " <td>" +
                        " <a class='delete' onClick = 'deleteInvoiceItem("+value.product_id+","+value.invoice_id+","+value.customer_id+")' >" +
                            " <i class='fa fa-times-circle-o'></i> " +
                        " </a> " +
                    " </td> " +
                    " <td>"+value.product_name+"</td> " +
                    " <td>"+value.product_price+"</td> " +
                    " <td> " +
                        " <input class='form-control qty' " +
                        " onchange='UpdateSaleItem('43',this.value)' " +
                        " value="+value.total+"" +
                        "  > " +
                    " </td> " +
                    " <td>"+(value.product_price * value.total)+" €</td> " +
                   " </tr> " ;

        invoice_table_one.append(line_one);

        sum_items += parseInt(value.total);
        sum_sub_total += parseFloat(value.product_price * value.total) ;
        sum_price += parseFloat(value.product_price * value.total) ; 

    });


    $('#table_total_price').html('');
    $('#table_total_items').html('');
    $('#table_sub_total_price').html('');
    $('#table_total_iva').html('');

    var iva_value = (sum_sub_total * CONS_IVA)/100;
    var total_value = sum_price + iva_value ;
    
    $('#table_total_price').html( total_value.toFixed(2) +' €');
    $('#table_total_items').html(sum_items +' item(s)');
    $('#table_sub_total_price').html(sum_sub_total.toFixed(2)+' €');
    $('#table_total_iva').html( iva_value.toFixed(2) +' €');

    if(results.length === 0){

        $('#table_invoice_wrap').attr('hidden',true) ;
        $('#table_invoice_id').attr('data-id','0');

        deleteInvoice(invoice_id,customer_id) ; 
    }
}


function setInvoiceModalTable(result){

    var CONS_IVA = 21 ;

    var sum_items  = 0;
    var sum_price  = 0;
    var sum_sub_total = 0;
    var customer_id ;
    var customer_name ;
    var invoice_id;

    $.each(result.results.items, function(index,value){

        sum_items += parseInt(value.total);
        sum_sub_total += parseFloat(value.product_price * value.total) ;
        sum_price += parseFloat(value.product_price * value.total) ; 

    });

    var iva_value = (sum_sub_total * CONS_IVA)/100;
    var total_value = sum_price + iva_value ;

    $('#modal_pos_payment_invoice_id').html(''); 
    $('#modal_pos_payment_date').html('');
    $('#modal_pos_payment_hour').html('');
    $('#modal_pos_payment_subtotal').html('');
    $('#modal_pos_payment_iva').html('');
    $('#modal_pos_payment_discount').html('');
    $('#modal_pos_payment_discount').html('');
    $('#modal_pos_payment_customer_name').html(''); 

    $('#modal_pos_payment_invoice_id').html('Numero de ticket : '+result.results.invoice_id); 
    $('#modal_pos_payment_date').html(result.results.date.split(' ')[0]);
    $('#modal_pos_payment_hour').html(result.results.date.split(' ')[1]);
    $('#modal_pos_payment_subtotal').html(sum_sub_total.toFixed(2)+' €');
    $('#modal_pos_payment_iva').html(iva_value.toFixed(2) +' €');
    $('#modal_pos_payment_discount').html('NO APLICABLE');
    $('#modal_pos_payment_total').html('<h2>'+total_value.toFixed(2) +' €</h2>');
    $('#modal_pos_payment_customer_name').html(result.results.customer_name); 


}




