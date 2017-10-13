$(document).ready(function(){
	//$('#customer_list_pos').select2();
	//$('#product_list_pos').select2();
	//$('#category_list_pos').select2();
	
	$('#customer_list_pos').select2({
        placeholder: 'Selecionar cliente',
        ajax: {
            url: "/OO_bones/admin/pos/getCustomers",
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
            url: "/OO_bones/admin/pos/getProducts",
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
            url: "/OO_bones/admin/pos/getCategories",
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
	
	
	
});


function getAllProducts(){
    
    $.getJSON("/OO_bones/admin/pos/getProductsWithPrice", function(result){
        $.each(result, function(index,value){

            var template_html = "<div class='col-md-3 column productbox'> " 
                               +"<img src='#image#' class='img-responsive'> "
                               +"<div class='producttitle'>#name#</div> "
                                   +"<div class='productprice'> "
                                       +"<div class='pull-right' onclick='addItemBill(#id#)' > " 
                                            +"<a href='#' class='btn btn-danger btn-sm' role='button'>Añadir</a> "
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






function addItemBill(item_id){

    //var item_id = $(this).attr('data-id');


    $.ajax({
        
        type : 'POST',
        url : '/OO_bones/admin/bill/addBillItem',
        data: { item_id : item_id , customer },
        dataType : 'json',
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
        url : '/OO_bones/admin/bill/delBillItem',
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
        url : '/OO_bones/admin/bill/updateBillItem',
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




