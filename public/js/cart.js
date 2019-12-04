$(document).ready(function(){

/*
	$(".btn-update-item").on('click',function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var href = $(this).data('href');
		var quantity = $("#product_"+id).val();
		window.location.href = href +"/"+ quantity;
	});
*/
	
	$(".quantity-right-plus").on('click',function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var href = $(this).data('href');
		var stock = $(this).data('stock');
		var quantity = parseInt($("#product_"+id).val())+1;
		if (quantity > stock) 
		{
          	quantity = stock;
        }
		$("#product_"+id).val(quantity);
		window.location.href = href +"/"+ quantity;
	});

	$('.quantity-left-minus').click(function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var href = $(this).data('href');
		var quantity = parseInt($("#product_"+id).val());
		if (quantity > 1) 
		{
          	quantity = quantity - 1;
          	$("#product_"+id).val(quantity);
        }
		window.location.href = href +"/"+ quantity;
    });

});

