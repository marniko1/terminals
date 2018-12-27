<?php


if (Auth::logged()) {
	
	Route::get('/', 'Home@index');

	Route::get('/Devices/index', 'Devices@index');
	// Route::get('/Devices/panel', 'Devices@showPageNumTwo');
	// Route::get('/Devices/{id}', 'Devices@showSingleDevice', $req = ['/^\d+$/']);
	// Route::get('/Devices/{page}', 'Devices@index', $req = ['/^p\d+$/']);
	Route::post('/Devices/changeDeviceLocation', 'Devices@changeDeviceLocation');

	Route::get('/SIMs/index', 'SIMs@index');
	// Route::get('/SIMs/panel', 'SIMs@showAddNewSimPage');
	// Route::get('/SIMs/{id}', 'SIMs@showSingleSIM', $req = ['/^\d+$/']);
	// Route::get('/SIMs/{page}', 'SIMs@index', $req = ['/^p\d+$/']);
	// Route::post('/SIMs/addNewSIM', 'SIMs@addNewSIM');

	Route::post('/Locations/addNewLocation', 'Locations@addNewLocation');

	Route::get('/Storage/index', 'Storage@index');
	Route::get('/Storage/locations', 'Storage@showLocationsPage');
	Route::get('/Storage/panel', 'Storage@showDevicesInPage');



	// Route::get('/Charges/panel', 'Charges@showPageNumTwo');
	Route::post('/Charges/makeCharge', 'Charges@makeCharge');
	// Route::post('/Charges/discharge', 'Charges@discharge');

	// Route::post('/Models/addNewModel', 'Models@addNewModel');

	Route::get('/Service/index', 'Service@index');
	Route::get('/Service/history', 'Service@malHistory');
	Route::get('/Service/administration', 'Service@administration');
	// Route::get('/Service/switchTerminals', 'Service@switchTerminals');

	if (Auth::admin()) {
		Route::get('/Admin/index', 'Admin@index');
		// Route::get('/Admin/panel', 'Admin@showPageNumTwo');
		// Route::post('/Admin/addNewUser', 'Admin@addNewUser');
		// Route::post('/Admin/editUserData', 'Admin@editUserData');
		// Route::post('/Admin/removeUser', 'Admin@removeUser');
	}

	Route::get('/AjaxCalls/index', 'AjaxCalls@index');

	Route::post('/Login/logoutUser', 'Login@logoutUser');

	Route::redirect('Error404@index');
} else {
	Route::post('/Login/loginUser', 'Login@loginUser');
	Route::redirect('Login@index');
}