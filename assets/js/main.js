window.onload = function() {
	// turn off autocomplete sugestion from browser
	$('input').attr('autocomplete', 'off');
	var url = window.location.origin + window.location.pathname;
	var url_part = url.replace(root_url, '').split('/');
	// makes ajax for pagination and filter
	var controller = window.location.href.split('/').reverse()[1];
	if (controller.match(/(\d+)/)) {
		controller = window.location.href.split('/').reverse()[2].slice(0, -1);
	}
	var filter = $('#filter');
	var pagination_links = $(".pagination li a");
	new FilterAndPagination(filter, pagination_links, controller);
    // *************************************************************************************************
	// forms submit validation
    if (window.location.pathname == '/terminals/Storage/index'
    	|| window.location.pathname == '/terminals/Storage/panel'
    	|| window.location.pathname == '/terminals/Storage/locations'
    	|| window.location.pathname == '/terminals/Storage/device'
    	|| window.location.pathname == '/terminals/Service/index'
    	|| window.location.pathname == '/terminals/SIMs/index'
    	|| window.location.pathname == '/terminals/Admin/index'
    	|| window.location.pathname == '/terminals/Devices/panel'
    	|| window.location.pathname == '/terminals/Service/panel'
    	|| window.location.pathname == '/terminals/Service/other'
    	|| window.location.pathname == '/terminals/Service/administration'
    	) {
    	// form validation
    	var frmvalidator = new Validator($('form'));

    	// add validation rules on fields
    	// storage pages validation rules
    	frmvalidator.addValidation('location_for_charge', ['selectRequired']);
    	frmvalidator.addValidation('device_sn', ['req', 'proposalValidation']);
    	frmvalidator.addValidation('location', ['req', 'proposalValidation']);
    	frmvalidator.addValidation('new_location', ['req', 'minLength=3']);
    	frmvalidator.addValidation('new_distributor', ['req']);

    	frmvalidator.addValidation('type', ['selectRequired']);

    	frmvalidator.addValidation('username', ['req']);
    	frmvalidator.addValidation('password', ['req', 'passConfirm=#co_password']);
    	frmvalidator.addValidation('co_password', ['req', 'passConfirm=#password']);

		new FormSubmit(frmvalidator);
		
		
    	new ShowProposals();
	}
	// ***********************************************************************************************
	// if home page
	// for chart drawing
	if (url_part[0] == '') {
		new DeviceCounter('terminals', ['magacin','servis','lanus'], ['terminali','lanus', 'certus']);
		new DeviceCounter('qprox', ['magacin'], ['qprox']);
	}
	// ***********************************************************************************************
	// if page url is charge view prepare charge form
	if (url_part[0] == 'Storage'  && (url_part[1] == 'index' || url_part[1] == 'panel')) {
		new Charge();
		new Print('#print_btn', $('#delivery_note_div'), $('head').html());
	}
	// ***********************************************************************************************
	// for single terminal page
	if (url_part[0] == 'Terminals' && url_part[1].match(/^\d+$/)) {
		if ($('span#location_span').text() == 'magacin') {
			$('input[name="remove"]').attr('disabled', false);
		}
	}
	// **********************************************************************************************
	// for STORAGE LOCATION PAGE
	if (url_part[0] == 'Storage' && url_part[1] == 'locations') {
		$('input:radio[name="priviledge"]').on('change', function() {
			if ($(this).is(':checked') && $(this).val() == '2') {
				$('#distributor').attr('disabled', false);
    			frmvalidator.addValidation('distributor', ['selectRequired']);
			} else if ($(this).is(':checked') && $(this).val() == '1') {
				$('#distributor').attr('disabled', true);
			}
		});
	}
	// **********************************************************************************************
	// for STORAGE DEVICE PAGE
	if (url_part[0] == 'Storage' && url_part[1] == 'device') {
		$('#type').on('change', function(){
			// console.log($('#type option:selected').text());
			if ($('#type option:selected').text() == 'terminal') {
				$('#model').attr('disabled', false);
    			frmvalidator.addValidation('model', ['selectRequired']);
				frmvalidator.addValidation('new_device_sn', ['req', 'minLength=6', 'maxLength=6']);
			} else {
				$('#model').attr('disabled', true);
    			frmvalidator.addValidation('new_device_sn', ['req', 'minLength=10', 'maxLength=10'], );
			}
		});
	}
	// **********************************************************************************************
	// for SERVICE PAGE
	if (url_part[0] == 'Service') {
		if (url_part[1] == 'index') {
			new Switch();
	    	frmvalidator.addValidation('old_device_sn', ['req', 'proposalValidation']);
	    	frmvalidator.addValidation('new_device_sn', ['req', 'proposalValidation']);
			frmvalidator.addValidation('malfunction', ['selectRequired']);
			frmvalidator.addValidation('repairer', ['selectRequired']);
		} else if (url_part[1] == 'other') {
			frmvalidator.addValidation('device_sn', ['req', 'proposalValidation']);
			frmvalidator.addValidation('malfunction', ['selectRequired']);
			frmvalidator.addValidation('action_type', ['selectRequired']);
			frmvalidator.addValidation('repairer', ['selectRequired']);
		} else if (url_part[1] == 'administration') {
			frmvalidator.addValidation('new_thing', ['selectRequired']);
			frmvalidator.addValidation('new_title', ['req']);
			frmvalidator.addValidation('software', ['selectRequired']);
		}
	}
}