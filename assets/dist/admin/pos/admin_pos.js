$(document).ready(function(){
	
	$('#customer_list_pos').select2({
        placeholder: 'Selecionar cliente',
        ajax: {
            url: "/OO_bones/admin/customercontroller/getCustomers",
            dataType: 'json',
            quietMillis: 100,
            data: function (term, page) {
                return {
                    term: term, //search term
                    page_limit: 10 // page size
                };
            },
            results: function (data, page) {
                return { results: data.results };
            }
        }
    });
	
	$('#product_list_pos').select2({
        placeholder: 'Selecionar producto',
        ajax: {
            url: "/OO_bones/admin/productcontroller/getProducts",
            dataType: 'json',
            quietMillis: 100,
            data: function (term, page) {
                return {
                    term: term, //search term
                    page_limit: 10 // page size
                };
            },
            results: function (data, page) {
                return { results: data.results };
            }
        }
    });
	
	$('#category_list_pos').select2({
        placeholder: 'Selecionar categoria',
        ajax: {
            url: "/OO_bones/admin/productcontroller/getCategories",
            dataType: 'json',
            quietMillis: 100,
            data: function (term, page) {
                return {
                    term: term, //search term
                    page_limit: 10 // page size
                };
            },
            results: function (data, page) {
                return { results: data.results };
            }
        }
    });
	
	getAllProducts();

    // @TODO - 
    // uncoment this to keep user in the same page
    // i cant control the text ... weird
    //  window.onbeforeunload = function() {
      //    return "Jo puta?";
    //  };
	
    // on clicks

    $('.paymentMethod').on('click',function(){ 

        var border = $(this).css("border-color");

        if(border == 'rgb(255, 0, 0)'){
            $(this).css({"border-color": "", 
             "border-width":"", 
             "border-style":""});
        }else{

            $('.paymentMethod').css({"border-color": "", 
             "border-width":"", 
             "border-style":""});

            $(this).css({"border-color": "red", 
             "border-width":"5px", 
             "border-style":"solid"});
        }
        
    }) ; 

    $("#product_list_pos").on('change', function(e) {
        // Access to full data
        addInvoiceItem($(this).select2('data')[0].id);
    });

    $("#category_list_pos").on('change', function(e) {
        // Access to full data
        getAllProducts($(this).select2('data')[0].id);
    });

});


function getAllProducts(provider_string){

    $.ajax({
            
            type : 'POST',
            url : '/OO_bones/admin/productcontroller/getProductsWithPrice',
            data: { provider_string : provider_string},
            dataType : 'json',
            beforeSend: function(){

            },
            success : function(result) {
                
                if(typeof(result.status) !== 'undefined' && result.status == 400){
                    alert('No se ha puede rescuperar las categorias : '+ result.detail);
                }
                $("#product_category_table").html('');
                $.each(result, function(index,value){

                    var template_html = "<div class='col-md-3 column productbox'> " 
                                       +"<img src='#image#' class='img-responsive'> "
                                       +"<div class='producttitle' >#name#</div> "
                                           +"<div class='productprice'> "
                                               +"<div class='pull-right' > " 
                                                    +"<a onclick='addInvoiceItem(#id#)' class='btn btn-danger btn-sm' role='button'>Añadir</a> "
                                               +"</div> "
                                               +"<div class='pricetext'>#price# €</div> "
                                            +"</div> "
                                       +"</div> " ; 
                    
                    template_html = template_html.replace('#id#',value.id);
                    template_html = template_html.replace('#image#',value.image);
                    template_html = template_html.replace('#name#',value.name);
                    template_html = template_html.replace('#price#',value.price);
                    $("#product_category_table").append(template_html);

                });


            },
            error : function(result){

                if(typeof(result.detail) === 'undefined')
                    console.log('There is an error making ajax call. Please check console log');
                
                console.log('Ajax call failed .Error result : '+result.detail);
                
            },
            complete: function(result){

            }
        
        });
    
}

function openCashBox(){

    if($('.paymentMethod').css("border-color") === 'rgb(255, 0, 0)'){

        showInfoModalAlert('warning','Abriendo cajón de caja ... ' );

        setTimeout(function(){
            $('#modal_pos_payment').modal('hide');
        }, 2000);

    }else{

        showInfoModalAlert('danger','Porfavor indica un método de pago' );

    }

}

function holdPayment(){

    showInfoModal('warning','Permisos','Ouppss !  parece que no tienes permisos para esta accion. No se lo diremos a nadie ;-P' );

}

function confirmInvoice(){

    var payment_selected = false;
    var payment_method ='';
    $.each($('p > .paymentMethod'),function(index,value){
        if($(this).css("border-color") === 'rgb(255, 0, 0)'){
            payment_method = $(this).data('id');
            payment_selected = true; 
        }
    });    

    if(payment_selected){

        var invoice_id = $('#table_invoice_id').attr('data-id') ; 
        

        $.ajax({
            
            type : 'POST',
            url : '/OO_bones/admin/invoicecontroller/confirmInvoice',
            data: { invoice_id : invoice_id, payment_method : payment_method},
            dataType : 'text',
            beforeSend: function(){
                //$('#modal_pos_payment_body').append("<div class='overlay'><i class='fa fa-refresh fa-spin'></i></div>");
                showInfoModalAlert('warning','Confirmando ticket ... ' );
            },
            success : function(result) {
                
                if(typeof(result.status) !== 'undefined' && result.status == 400){
                    alert('No se ha podido eliminar el item : '+ result.detail);
                }

                // reset all screen after confirm ticket
                $('#table_invoice_wrap').attr('hidden',true) ;
                $('#table_invoice_id').attr('data-id','0');
                $('#customer_list_pos').empty();
                $('#product_list_pos').empty();
                $('#category_list_pos').empty();

                $('.paymentMethod').css({"border-color": "", 
                 "border-width":"", 
                 "border-style":""});

                $('#modal_pos_payment').modal('hide') ;
                getAllProducts();
                showInfoAlert('success','Ticket cerrado.' );
                
            },
            error : function(result){

                if(typeof(result.detail) === 'undefined')
                    console.log('There is an error making ajax call. Please check console log');
                
                console.log('Ajax call failed .Error result : '+result.detail);
                
            },
            complete: function(result){

                
            }
        
        });

    }else{

        showInfoModalAlert('danger','Porfavor indica un método de pago' );

    }

}

//
// --------------------------- MODAL INVOICE
//

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




