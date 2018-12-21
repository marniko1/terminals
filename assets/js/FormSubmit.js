class FormSubmit {
	constructor(frmvalidator) {
		this.frmvalidator = frmvalidator;
		this.submit();
	}
	validate(form) {
		return this.frmvalidator.validation(form);
	}
	submit() {
		var that = this;
		jQuery('.submit_btn').on('click', function(e){
			e.preventDefault();
			if(!that.validate($(this).parents('form'))){
				console.log('ne valja');
				return;
			}
			var form = $(this).parents('form');
			$(form).submit();
		});
	}
}