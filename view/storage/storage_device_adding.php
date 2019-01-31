		<div class="container">
			<div class="row">
				<?php
				include "includes/storage_navigation.php";
				?>
				<fieldset  class="customLegend row col-12" style="height: min-content;">
					<legend>Dodaj novi uređaj</legend>
					<form class="form mt-5 col-12 row" method="post" action="<?php echo INCL_PATH.'Devices/addNewDevice'; ?>">
						<div class="form-group form-group-inline col-3">
					      	<select id="type" class="form-control" name="type">
					        	<option value="/">Tip...</option>
					        	<?php
					        	foreach ($this->data['types'] as $type) {
					        	?>
					        	<option value="<?php echo $type->id; ?>"><?php echo $type->title; ?></option>
					        	<?php
					        	}
					        	?>
					      	</select>
					    </div>
					    <div class="form-group form-group-inline col-3">
					    	<input type="hidden" name="model" value="0">
					      	<select id="model" class="form-control" name="model" disabled>
					        	<option value="/">Model...</option>
					        	<?php
					        	foreach ($this->data['models'] as $model) {
					        	?>
					        	<option value="<?php echo $model->id; ?>"><?php echo $model->title; ?></option>
					        	<?php
					        	}
					        	?>
					      	</select>
					    </div>
						<div class="form-group form-group-inline ml-2 device_sn_div row col-6">
							<label for="new_device_sn" class="col-form-label col-4">Ser. br. uređaja: </label>
							<input type="text" class="new_device_sn form-control col-5" name="new_device_sn" id="new_device_sn">
						</div>
						<div class="ml-5 mt-5">
							<input type="submit" value="Potvrdi" class="btn btn-primary btn-sm ml-2 submit_btn">
							<input type="reset" value="Reset" class="btn btn-light btn-sm ml-2">
						</div>
					</form>
					<div class="col-12"><?php echo (isset($this->data['msg']['msg1'])) ? "<span class='text-danger'>" . $this->data['msg']['msg1'] . "</span>" : false ?></div>
				</fieldset>