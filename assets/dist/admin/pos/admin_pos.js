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
	
	
});


function getAllProducts(){
    
    $.getJSON("/OO_bones/admin/poscontroller/getProductsWithPrice", function(result){
        $.each(result, function(index,value){

            var template_html = "<div class='col-md-3 column productbox'> " 
                               +"<img src='#image#' class='img-responsive'> "
                               +"<div class='producttitle'>#name#</div> "
                                   +"<div class='productprice'> "
                                       +"<div class='pull-right' > " 
                                            +"<a onclick='addItemBill(#id#)' class='btn btn-danger btn-sm' role='button'>Añadir</a> "
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




