jQuery(document).ready(function(){
			const ratingSelector = jQuery('#list_rating');
			ratingSelector.find('li').on('click', function(){
				const number = $(this).data('number');
				// para mostrar por consola los resultados
				console.log(number);

				/**	Me posiciono sobre el id rating form
					Busco el input con name rating_input
					Asigno el number seleccionado
				*/
				$("#rating_form").find('input[name=rating_input]').val(number);
				ratingSelector.find('li i').removeClass('yellow').each(function(index){
					if ((index + 1) <= number){
						$(this).addClass('yellow');
					}
				})
			})
		});
		
		
