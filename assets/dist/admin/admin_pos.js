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
            $("#product_category_table").append("<div class='col-md-3 column productbox'><img src='"+value.image+"' class='img-responsive'><div class='producttitle'>"+value.name+"</div><div class='productprice'><div class='pull-right'><a href='#' class='btn btn-danger btn-sm' role='button'>Añadir</a></div><div class='pricetext'>"+value.price+" €</div></div></div>");
        });
    });
	
}


