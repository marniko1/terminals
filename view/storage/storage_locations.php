		<div class="container">
			<div class="row">
				<?php
				include "includes/storage_navigation.php";
				?>
				<h1 class="col-12">Prebaci uređaj na lokaciju</h1>
				<h1 class="col-12">Dodaj novu lokaciju</h1>
				<fieldset  class="customLegend row col-12">
					<legend>Prebaci uređaj na novu lokaciju</legend>
					<form class="form-inline mt-5" method="post" action="<?php echo INCL_PATH.'Devices/changeDeviceLocation'; ?>">
						<div class="form-group ml-2">
							<label for="location">Lokacija: </label>
							<input type="text" class="proposal-input form-control" id="location">
							<input type="hidden" name="location_id" id="location_id">
							<div class="proposals d-none">
								<ul class="mb-0 pl-0"></ul>
							</div>
						</div>
						<div class="form-group ml-2">
							<label for="device">Serijski broj uređaja: </label>
							<input type="text" class="proposal-input form-control" id="device_sn">
							<input type="hidden" name="device_id" id="device_id">
							<div class="proposals d-none">
								<ul class="mb-0 pl-0"></ul>
							</div>
						</div>
						<input type="submit" value="Potvrdi" class="btn btn-primary btn-sm ml-2 submit_btn">
						<input type="reset" value="Reset" class="btn btn-light btn-sm ml-2">
					</form>
					<div class="col-12"><?php echo (isset($this->data['msg']['msg1'])) ? "<span class='text-danger'>" . $this->data['msg']['msg1'] . "</span>" : false ?></div>
				</fieldset>
				<fieldset  class="customLegend row col-12">
					<legend>Dodaj novu lokaciju</legend>
					<form class="form-inline mt-5 col-12" method="post" action="<?php echo INCL_PATH.'Locations/addNewLocation'; ?>">
						<div class="form-group ml-2">
								<label for="new_location" class="col-form-label">Naziv lokacije: </label>
								<input type="text" class="proposal-input form-control" name="new_location" id="new_location">
						</div>
						<div class="form-group">
							<label for="priviledge1" class="form-check-label ml-4">Lokacija prioriteta 1</label>
							<input type="radio" name="priviledge" id="priviledge1" class="form-check-input ml-2" value="1" checked>
							<label for="priviledge2" class="form-check-label ml-4">Lokacija prioriteta 2</label>
							<input type="radio" name="priviledge" id="priviledge2" class="form-check-input ml-2" value="2">
						</div>
						<input type="submit" value="Potvrdi" class="btn btn-primary btn-sm ml-2 submit_btn">
						<input type="reset" value="Reset" class="btn btn-light btn-sm ml-2">
					</form>
				</fieldset>
				<div class="col-12"><?php echo (isset($this->data['msg']['msg1'])) ? "<span class='text-danger'>" . $this->data['msg']['msg1'] . "</span>" : false ?></div>
				