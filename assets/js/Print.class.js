class Print {
	constructor (btn, div, head_html) {
		this.printDiv(btn, div, head_html);
	}
	printDiv (btn, div, head_html) {
		$(btn).on('click', function(e){
			e.preventDefault();
			var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
			WinPrint.document.write(`<html>
										<head>
											<link rel="stylesheet" type="text/css" href="/terminals/assets/css/bootstrap.css">
											<link rel="stylesheet" type="text/css" href="/terminals/assets/css/main.css">
											<link rel="stylesheet" type="text/css" href="/terminals/assets/css/delivery_note.css">
											<link rel="stylesheet" type="text/css" media="print" href="/terminals/assets/css/print.css">
										</head>
										<body>
										<div class="container"><div class="row">`);
			WinPrint.document.write($(div).html());
			WinPrint.document.write(`</div></div></body></html>`);
			WinPrint.document.close();
			WinPrint.focus();
			WinPrint.print();
			setTimeout(function(){
				WinPrint.close();
			}, 500);
		});
	}
	addLastInputValueInNoteOnPrintIfNotThere () {
		
	}
}