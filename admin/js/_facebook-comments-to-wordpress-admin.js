(function( $ ) {
	'use strict';

	$(document).ready(function(){
		var page = 1;
		var go_with = {'next': 0};
		$('#start_import_comments').click(function(){
			var access_token = $('#fb_access_token').val();
			var import_type = $('#import_type').val();
			var data = {
				'action': 'import_fb_comments',
				'token': access_token,
				'what':import_type,
				'paged':page,
				'go_with':go_with
			}

			$.post( ajaxurl, data, function( response ) {
				//$('#results').append(response.);
				console.log(go_with);
				//console.log(response.hasOwnProperty('comback_with'));
				$.each(response.message, function(intIndex,objValue){
						$('#results').append(objValue+'<br />');
					}
				);
				if(response.hasOwnProperty('comback_with')){
					go_with = response.comback_with;
					//console.log(response);
					console.log('Response',response.comback_with);
					console.log('var', go_with);
					alert('test');
					$('#start_import_comments').click();
				}else{
					$('#results').append('<strong>All Done this post, lets try next.</strong><br />');
					page++;
				}
			});
		});
	});

})( jQuery );