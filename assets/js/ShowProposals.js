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
				} else if (label_text == 'Ser. br. uređaja u magacinu: ') {
					var fn = 'devicesInStorage';
				} else if (label_text == 'Ser. br. uređaja u Lanusu: ') {
					var fn = 'devicesInLanus';
				} else if (label_text == 'Lokacija: ') {
					var fn = 'location';
				} else if (label_text == 'Stari - Ser.br.: ') {
					var fn = 'devicesOnOtherLocations';
				} else if (label_text == 'Novi - Ser.br.: ') {
					var fn = 'devicesInService';
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
								// adding id if proposals are for devices or locations
								if (fn == 'location') {
									div_html += `<li class="pl-1" data-location_id="${response[i].id}">${response[i].ajax_data}</li>`;
								} else if (fn == 'device' || fn == 'devicesInStorage' || fn == 'devicesInLanus' || fn == 'devicesInService') {
									div_html += `<li class="pl-1" data-device_id="${response[i].id}">${response[i].ajax_data}</li>`;
								} else if (fn == 'devicesOnOtherLocations') {
									div_html += `<li class="pl-1" data-device_id="${response[i].id}" data-location="${response[i].location}" data-location_id="${response[i].location_id}">${response[i].ajax_data}</li>`;
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
								self.in = false;
								var text = $(this).text();
								$(self).val(text);
								$(self).focus();
								// set that input is valid
								$(self).attr('data-validate', 'true');
								$(this).parents('.mt-5').find('.proposals').addClass('d-none');
								// *****************************
								if (fn == 'device' || fn == 'devicesInStorage' || fn == 'devicesInLanus') {
									$(self).parent().find('input[type=hidden]').val($(this).data('device_id'));
								} else if (fn == 'location') {
									$(self).parents().find('#location_id').val($(this).data('location_id'));
								} else if (fn == 'devicesOnOtherLocations') {
									$(self).parents().find('#old_device_id').val($(this).data('device_id'));
									$(self).parents().find('#location_info').val($(this).data('location'));
									$(self).parents().find('#location_id').val($(this).data('location_id'));
								} else if (fn == 'devicesInService') {
									$(self).parents().find('#new_device_id').val($(this).data('device_id'));
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