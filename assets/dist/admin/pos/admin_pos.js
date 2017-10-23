$(document).ready(function(){
	//$('#customer_list_pos').select2();
	//$('#product_list_pos').select2();
	//$('#category_list_pos').select2();
	
	$('#customer_list_pos').select2({
        placeholder: 'Selecionar cliente',
        ajax: {
            url: "/OO_bones/admin/poscontroller/getCustomers",
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
            url: "/OO_bones/admin/poscontroller/getProducts",
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
            url: "/OO_bones/admin/poscontroller/getCategories",
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



	
});


function getAllProducts(){
    
    $.getJSON("/OO_bones/admin/poscontroller/getProductsWithPrice", function(result){
        $.each(result, function(index,value){

            var template_html = "<div class='col-md-3 column productbox'> " 
                               +"<img src='#image#' class='img-responsive'> "
                               +"<div class='producttitle'>#name#</div> "
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

function confirmInvoice(){

    if($('p > .paymentMethod').css("border-color") === 'rgb(255, 0, 0)'){
        var invoice_id = $('#table_invoice_id').attr('data-id') ; 
        

        $.ajax({
            
            type : 'POST',
            url : '/OO_bones/admin/invoicecontroller/confirmInvoice',
            data: { invoice_id : invoice_id},
            dataType : 'json',
            beforeSend: function(){
                //$('#modal_pos_payment_body').append("<div class='overlay'><i class='fa fa-refresh fa-spin'></i></div>");
                showInfoModalAlert('warning','Confirmando ticket ... ' );
            },
            success : function(result) {
                
                if(typeof(result.status) !== 'undefined' && result.status == 400){
                    alert('No se ha podido eliminar el item : '+ result.detail);
                }



            },
            error : function(result){

                if(typeof(result.detail) === 'undefined')
                    console.log('There is an error making ajax call. Please check console log');
                
                console.log('Ajax call failed .Error result : '+result.detail);
                
            },
            complete: function(result){
                //$('#modal_pos_payment_body > .overlay').remove();
            }
        
        });

        

    }else{

        showInfoModalAlert('danger','Porfavor indica un método de pago' );

    }


}




