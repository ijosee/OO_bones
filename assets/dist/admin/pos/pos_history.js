$(function () {

    var dataTableHistory = $('#pos_history_table').DataTable({

        processing: true
        ,serverSide: true
        ,ajax: {
            url : "invoicecontroller/readInvoice"
            ,type : "POST"
        }
        ,createdRow: function ( row, data, index ) {

            if ( data[5]) {
                $('td', row).eq(5).addClass('highlight');
            }

        }
        ,"columns" : [

                {
                    data : 0
                    ,render: function ( data, type, row ) {
                        // Combine the first and last names into a single table field
                        return data ; 
                    }
                }
                ,{data : 1}
                ,{data : 2}
                ,{
                    data : 3
                    ,render : function(data, row ,type){
                        var box_type = "error" ; 
                        var box_txt = "error";
                        if(data == "1" ){
                            box_type = "green" ; 
                            box_txt = "activo";
                        }else{
                            box_type = "red" ; 
                            box_txt = "desactivada";
                        }

                       return " <span class='label pull-right bg-"+box_type+"'>"+box_txt+"</span> "
                    }
                }
                ,{
                    data : 4
                    ,render : function(data, row ,type){
                        var box_type = "error" ; 
                        var box_txt = "error";
                        if(data == "1" ){
                            box_type = "green" ; 
                            box_txt = "desbloqueada";
                        }else{
                            box_type = "yellow" ; 
                            box_txt = "bloqueda";
                        }

                       return " <span class='label pull-right bg-"+box_type+"'>"+box_txt+"</span> "
                    }
                }
                ,{
                    data : 5
                    ,render : function(data, row ,type){
                        var box_type = "error" ; 
                        var box_txt = "error";
                        if(data == "1" ){
                            box_type = "green" ; 
                            box_txt = "pagado";
                        }else{
                            box_type = "red" ; 
                            box_txt = "deuda";
                        }

                       return " <span class='label pull-right bg-"+box_type+"'>"+box_txt+"</span> "
                    }
                }
                ,{
                    data : 6
                }
                ,{data : 7}
                ,{data : 8}
                ,{
                    data : 9
                    ,render : function(data, row ,type){
                        var box_type = "error" ; 
                        var box_txt = "error";

                        if(data == "CASH" ){
                            box_type = "green" ; 
                            box_txt = "MONEDA";
                        }else{
                            box_type = "yellow" ; 
                            box_txt = "CREDITO";
                        }

                       return " <span class='label pull-right bg-"+box_type+"'>"+box_txt+"</span> "
                    }
                }
                ,{
                    data: null,
                    className: "center"
                    ,render: function ( data, type, row ) {
                        // Combine the first and last names into a single table field
                        return '<button class="btn-xs btn-warning" onclick="showHistoryInvoiceModal('+row[0]+')">Ver</button>' 
                    }
                }
        ]
        ,"columnDefs" : [

                {
                   name: "my_class", 
                   targets: [ 0 ]

                }
        ]
        ,data : function(){

        }
        ,initComplete: function () {
            // New record

        }

    });

    $('#modal_pos_toggle_active').change(function() {

    var invoice_id = $('#modal-pos-invoice-id').attr('data-id');

    var invoice_paid = $('#modal_pos_toggle_paid').prop('checked');
    var invoice_active = $('#modal_pos_toggle_active').prop('checked');
    var invoice_on_hold = $('#modal_pos_toggle_on_hold').prop('checked');

      $.ajax({
          
          type : 'POST',
          url : '/OO_bones/admin/invoicecontroller/updateInvoice',
          data: { invoice_id : invoice_id ,invoice_active : invoice_active ,invoice_on_hold :invoice_on_hold , invoice_paid :invoice_paid},
          dataType : 'text',
          beforeSend: function(){

          $('#spinBefore').append("<div class='overlay'><i class='fa fa-refresh fa-spin'></i></div>");
          $('#spinBefore > .overlay').slideUp( 300 ).delay( 800 ).fadeIn( 400 );

          },
          success : function(result) {

              if(typeof(result.status) !== 'undefined' && result.status == 400){
                  alert('No se ha podido eliminar la factura : '+ result.detail);
              }

          },
          error : function(result){

              if(typeof(result.detail) === 'undefined')
                  console.log('There is an error making ajax call. Please check console log');
              
              console.log('Ajax call failed .Error result : '+result.detail);
              
          },
          complete : function(){

                $('#spinBefore > .overlay').remove();
          }

        });

    })

    $('#modal_pos_toggle_on_hold').change(function() {

      var invoice_id = $('#modal-pos-invoice-id').attr('data-id');

      var invoice_paid = $('#modal_pos_toggle_paid').prop('checked');
      var invoice_active = $('#modal_pos_toggle_active').prop('checked');
      var invoice_on_hold = $('#modal_pos_toggle_on_hold').prop('checked');

        $.ajax({
            
            type : 'POST',
            url : '/OO_bones/admin/invoicecontroller/updateInvoice',
            data: { invoice_id : invoice_id ,invoice_active : invoice_active ,invoice_on_hold :invoice_on_hold , invoice_paid :invoice_paid},
            dataType : 'text',
            beforeSend: function(){
            
            $('#spinBefore').append("<div class='overlay'><i class='fa fa-refresh fa-spin'></i></div>");
            $('#spinBefore > .overlay').slideUp( 300 ).delay( 800 ).fadeIn( 400 );
            
            },
            success : function(result) {

                if(typeof(result.status) !== 'undefined' && result.status == 400){
                    alert('No se ha podido eliminar la factura : '+ result.detail);
                }

            },
            error : function(result){

                if(typeof(result.detail) === 'undefined')
                    console.log('There is an error making ajax call. Please check console log');
                
                console.log('Ajax call failed .Error result : '+result.detail);
                
            },
            complete : function(){

                    $('#spinBefore > .overlay').remove();
              }
        
          });

    })

    $('#modal_pos_toggle_paid').change(function() {

      var invoice_id = $('#modal-pos-invoice-id').attr('data-id');

      var invoice_paid = $('#modal_pos_toggle_paid').prop('checked');
      var invoice_active = $('#modal_pos_toggle_active').prop('checked');
      var invoice_on_hold = $('#modal_pos_toggle_on_hold').prop('checked');

        $.ajax({
            
            type : 'POST',
            url : '/OO_bones/admin/invoicecontroller/updateInvoice',
            data: { invoice_id : invoice_id ,invoice_active : invoice_active ,invoice_on_hold :invoice_on_hold , invoice_paid :invoice_paid},
            dataType : 'text',
            beforeSend: function(){
            
                $('#spinBefore').append("<div class='overlay'><i class='fa fa-refresh fa-spin'></i></div>");
                $('#spinBefore > .overlay').slideUp( 300 ).delay( 800 ).fadeIn( 400 );
            
            },
            success : function(result) {

                if(typeof(result.status) !== 'undefined' && result.status == 400){
                    alert('No se ha podido eliminar la factura : '+ result.detail);
                }

            },
            error : function(result){

                if(typeof(result.detail) === 'undefined')
                    console.log('There is an error making ajax call. Please check console log');
                
                console.log('Ajax call failed .Error result : '+result.detail);
                
            },
            complete : function(){

                    $('#spinBefore > .overlay').remove();
              }
        
          });

    })

    $('#modal_pos_invoice').on('hidden.bs.modal', function () {
        dataTableHistory.ajax.reload();

    })


});


function showHistoryInvoiceModal(invoice_id){

    event.preventDefault();
    
    var modal_body = $('#modal-pos-history-body');

    $.ajax({
        
        type : 'POST',
        url : '/OO_bones/admin/invoicecontroller/readInvoice',
        data: { invoice_id : invoice_id},
        dataType : 'json',
        beforeSend: function(){
        //$('#invoice_box').append("<div class='overlay'><i class='fa fa-refresh fa-spin'></i></div>");
        },
        success : function(result) {
            

            if(typeof(result.status) !== 'undefined' && result.status == 400){
                alert('No se ha podido eliminar la factura : '+ result.detail);
            }

            drawHistoryInvoiceTable(result, invoice_id = null, customer_id = null) ;

            var modal = $('#modal_pos_invoice');
            var type_f = 'modal modal-## fade'.replace('##','success');
            modal.attr('class',type_f); 
            modal.modal('show') ;

        },
        error : function(result){

            if(typeof(result.detail) === 'undefined')
                console.log('There is an error making ajax call. Please check console log');
            
            console.log('Ajax call failed .Error result : '+result.detail);
            
        }
    
    });
    
} 

function drawHistoryInvoiceTable(results, invoice_id = null, customer_id = null){

    var modal_title = $('#modal-pos-history-title');

    var modal_pos_invoice_now = $('#modal-pos-invoice-now');
    var modal_pos_invoice_client_name = $('#modal-pos-invoice-client-name');
    var modal_pos_invoice_id = $('#modal-pos-invoice-id');
    var modal_pos_invoice_created_time = $('#modal-pos-invoice-created-time');
    var modal_pos_invoice_last_update = $('#modal-pos-invoice-last-update');
    //var modal_pos_invoice_history_table = $('#modal-pos-invoice-history-table');
    var modal_pos_invoice_history_customer_comment = $('#modal-pos-invoice-history-customer-comment');
    var modal_pos_history_payment_subtotal = $('#modal_pos_history_payment_subtotal');
    var modal_pos_history_payment_iva = $('#modal_pos_history_payment_iva');
    var modal_pos_history_payment_discount = $('#modal_pos_history_payment_discount');
    var modal_pos_history_payment_total = $('#modal_pos_history_payment_total');
    
    var modal_pos_toggle_active = $('#modal_pos_toggle_active');
    var modal_pos_toggle_on_hold = $('#modal_pos_toggle_on_hold');
    var modal_pos_toggle_paid = $('#modal_pos_toggle_paid');

    modal_title.html('Ticket : ' + results.results.invoice_id);

    $('#modal-pos-invoice-history-table > tbody').empty();

    var sum_items  = 0;
    var sum_price  = 0;
    var sum_sub_total = 0;
    var CONS_IVA = 21 ; 
    var sum_iva = 0 ; 

    $.each(results.results.items, function(index,value){

        var invoice_table_one = $('#modal-pos-invoice-history-table > tbody') ; 

        var line_one = "<tr data-id = '"+value.product_id+"'>" +
                    " <td>"+value.product_id+"</td> " +
                    " <td>"+value.product_name+"</td> " +
                    " <td>"+value.product_price+"</td> " +
                    " <td>"+value.total+"</td> " +
                    " </td> " +
                    " <td>"+(value.product_price * value.total)+" €</td> " +
                   " </tr> " ;

        invoice_table_one.append(line_one);

        sum_items += parseInt(value.total);
        sum_sub_total += parseFloat(value.product_price * value.total) ;
        sum_price += parseFloat(value.product_price * value.total) ; 

    });

    modal_pos_invoice_now.html('');
    modal_pos_invoice_client_name.html('');
    modal_pos_invoice_id.html('');
    modal_pos_invoice_created_time.html('');
    modal_pos_invoice_last_update.html('');
    //modal_pos_invoice_history_table.html('');
    modal_pos_invoice_history_customer_comment.html('');
    modal_pos_history_payment_subtotal.html('');
    modal_pos_history_payment_iva.html('');
    modal_pos_history_payment_discount.html('');
    modal_pos_history_payment_total.html('');

    var iva_value = (sum_sub_total * CONS_IVA)/100;
    var total_value = sum_price + iva_value ;

    modal_pos_invoice_now.html('Hoy, '+results.results.date.split(' ')[0]);
    modal_pos_invoice_client_name.html(results.results.customer_name);
    modal_pos_invoice_id.html('Factura #'+results.results.invoice_id);
    $('#modal-pos-invoice-id').attr('data-id',results.results.invoice_id);
    modal_pos_invoice_created_time.html('Fecha Factura , '+results.results.created_time);
    modal_pos_invoice_last_update.html('Última actualizacion : '+results.results.last_update);
    //modal_pos_invoice_history_table.html('');
    modal_pos_invoice_history_customer_comment.html(results.results.customer_comment);

    modal_pos_history_payment_subtotal.html(sum_sub_total.toFixed(2)+' €');
    modal_pos_history_payment_iva.html( iva_value.toFixed(2) +' €');
    modal_pos_history_payment_discount.html('no aplicable');
    modal_pos_history_payment_total.html( total_value.toFixed(2) +' €');

    if(results.results.active === "1"){
        modal_pos_toggle_active.prop('checked', true).change();
    }else{
        modal_pos_toggle_active.prop('checked', false).change();
    }

    if(results.results.on_hold === "1"){
        modal_pos_toggle_on_hold.prop('checked', true).change();
    }else{
        modal_pos_toggle_on_hold.prop('checked', false).change();
    }

    if(results.results.paid === "1"){
        modal_pos_toggle_paid.prop('checked', true).change();
    }else{
        modal_pos_toggle_paid.prop('checked', false).change();
    }

}





















