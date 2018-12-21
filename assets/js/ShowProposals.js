class ShowProposals {
	constructor(){
		this.hideOptionDiv();
		this.unhideOptionDiv();
	}
	unhideOptionDiv(){
		jQuery('.proposal-input').on('keyup',function(e){
			if ($(this).val() != '') {
				var self = this;
				var input_text = false;
				var proposals_div = $(this).parents('.form-group').find('.proposals');
				var filter_value = $(this).val().trim();
				var ul = $(this).parents('.form-group').find('.proposals ul');
				var label_text = $(e.target).parents('.form-group').find('label').text();
				if (label_text == 'Serijski broj uređaja: ') {
					var fn = 'device';
				}
				
				setTimeout(function(){
					$.ajax({
						type: "POST",
						url: root_url + "AjaxCalls/index",
						data: "ajax_fn=" + fn + "Filter&search_value=" + filter_value,
						success: function(data){
							var response = JSON.parse(data);
							var div_html = '';
							$.each(response, function(i, val){
								// adding model if proposals are for phone
								if (fn == 'phone') {
									div_html += `<li class="pl-1" data-model="${response[i].model}">${response[i].ajax_data}</li>`;
								} else if (fn == 'device') {
									div_html += `<li class="pl-1" data-device_id="${response[i].id}">${response[i].ajax_data}</li>`;
								} else {
									div_html += `<li class="pl-1">${response[i].ajax_data}</li>`;
								}
							});
							// for validation make attr data-validate
							// ***************************************************
							$.each(response, function(key, value){
								if (value.ajax_data == filter_value) {
									input_text = true;
								};
							});
							if (!input_text) {
								$(self).attr('data-validate', 'false');
							} else {
								$(self).attr('data-validate', 'true');
							}
							// ***************************************************


							if (response.length != 0) {
								$(self).parents('.form-group').find('.proposals').removeClass('d-none');
							} else {
								$(self).parents('.form-group').find('.proposals').addClass('d-none');
							}
							
							$(ul).html(div_html);
							jQuery('.proposals li').on('click', function(e){
								var text = $(this).text();
								$(self).val(text);
								$(self).focus();
								// set that input is valid
								$(self).attr('data-validate', 'true');
								$(this).parents('.mt-5').find('.proposals').addClass('d-none');
								// *****************************
								if (fn == 'device') {
									// console.log($(this).data)
									$(self).parent().find('.device_sn_hidden').val($(this).data('device_id'));
									// $('#location_id').val($(this).data('location_id'));
								}
							});
						},
						error: function(XMLHttpRequest, textStatus, errorThrown) {
					     	alert("some error"+errorThrown);
					 	}
					});
				},1000);
			} else {
				$('.proposals').addClass('d-none');
			}
		});
	}
	hideOptionDiv() {
		jQuery('html').on('click', function(e){
				var div = $(e.target).parents('.form-group').find('.proposals');
				if (div.length !== 0) {
					$(e.target).parents('.mt-5').find('.proposals').not(div).addClass('d-none');
				} else {
					$('.proposals').addClass('d-none');
				}
		});
	}
	takeLiValueInInput() {
		jQuery('.proposal li').on('click', function(e){
			var li_text = $(e.target).text();
		});
	}
}