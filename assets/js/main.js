window.onload = function() {
	// console.log(window.location.origin + window.location.pathname);
	// console.log(window.location.pathname);
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
    	|| window.location.pathname == '/terminals/Service/index'
    	|| window.location.pathname == '/terminals/SIMs/panel'
    	|| window.location.pathname == '/terminals/Admin/index'
    	|| window.location.pathname == '/terminals/Devices/panel'
    	|| window.location.pathname == '/terminals/Service/panel'
    	) {
    	// form validation
    	var frmvalidator = new Validator($('form'));

    	// add validation rules on fields
    	// storage pages validation rules
    	frmvalidator.addValidation('location_for_charge', ['selectRequired']);
    	frmvalidator.addValidation('device_sn', ['req', 'proposalValidation']);
    	frmvalidator.addValidation('location', ['req', 'proposalValidation']);
    	frmvalidator.addValidation('new_location', ['req', 'minLength=3']);

		new FormSubmit(frmvalidator);
		
		
    	new ShowProposals();
	}
	// ***********************************************************************************************
	// if page url is single agent view prepare discharge
	if (url_part[0] == 'Agents' && url_part[1].match(/^\d+$/)) {
		new Discharge();
	}
	// ***********************************************************************************************
	// if page url is charge view prepare charge form
	if (url_part[0] == 'Storage'  && (url_part[1] == 'index' || url_part[1] == 'panel')) {
		new Charge();
	}
	// ***********************************************************************************************
	// for single terminal page
	if (url_part[0] == 'Terminals' && url_part[1].match(/^\d+$/)) {
		if ($('span#location_span').text() == 'magacin') {
			$('input[name="remove"]').attr('disabled', false);
		}
	}
	// **********************************************************************************************
	// for SERVICE PAGE
	if (url_part[0] == 'Service' && url_part[1] == 'index') {
		new Switch();
		// $('.service_action_links').on('click', function(e){
		// 	e.preventDefault();
		// 	$('.service_action_divs').addClass('d-none');
		// 	$('#'+$(this).attr('id')+'_div').removeClass('d-none');
		// })
	}
}