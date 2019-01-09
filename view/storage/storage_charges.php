		<div class="container">
			<div class="row">
				<?php
				include "includes/storage_navigation.php";
				?>
				<h1 class="col-12">PRAVLJENJE ZADUŽENJA</h1>
				<fieldset  class="customLegend row col-4" style="height: min-content;">
					<legend>Zaduženje</legend>
					<form class="form mt-5 col-12 pr-0" method="post" action="<?php echo INCL_PATH.'Charges/makeCharge'; ?>">
						<div class="form-group form-group-inline col-10 mb-5">
					      	<select class="form-control" name="location" id="location_for_charge">
					        	<option value="/">Lokacija...</option>
					        	<?php
					        	foreach ($this->data['locations'] as $location) {
					        	?>
					        	<option value="<?php echo $location->id; ?>"><?php echo $location->title; ?></option>
					        	<?php
					        	}
					        	?>
					      	</select>
					    </div>
						<div class="form-group ml-2 device_sn_div row">
							<label for="device_sn" class="col-form-label col-7 pr-0 pl-0">Ser. br. uređaja u magacinu: </label>
							<input type="text" class="proposal-input device_sn form-control col-3" name="device_sn" id="device_sn">
							<input type="hidden" class="device_sn_hidden" name="device_sn" id="device_id">
							<div class="proposals d-none">
								<ul class="mb-0 pl-0"></ul>
							</div>
							<span class="d-none remove ml-2"><img style="width: 15px;height: 15px;" src="<?php  echo INCL_PATH.'assets/images/remove.png'?>"></span>
						</div>
						<div>
							<input type="submit" value="Potvrdi" class="btn btn-primary btn-sm ml-2 submit_btn">
							<input type="reset" value="Reset" class="btn btn-light btn-sm ml-2">
						</div>
					</form>
					<div class="col-12"><?php echo (isset($this->data['msg']['msg1'])) ? "<span class='text-danger'>" . $this->data['msg']['msg1'] . "</span>" : false ?></div>
				</fieldset>
				<div class="col-8" id="delivery_note_div">
					<?php
					include "includes/delivery_note.php";
					?>
				</div>