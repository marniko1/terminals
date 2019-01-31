		<div class="container">
			<div class="row">
				<?php
				include "includes/service_navigation.php";
				?>
				<fieldset  class="customLegend row col-12">
					<legend>Dodaj...</legend>
					<form class="form-inline mt-5 col-12" method="post" action="<?php echo INCL_PATH.'Service/serviceAdministration'; ?>">
						<div class="form-group">
							<select class="form-control" name="new_thing" id="new_thing">
					        	<option value="/">...novi...</option>
					        	<option value="malfunctions">kvar</option>
					        	<option value="actions">servisna akcija</option>
					        	<option value="repairers">serviser</option>
					        	<option value="software">software</option>
					      	</select>
						</div>
						<div class="form-group ml-5">
								<label for="new_title" class="col-form-label">Naziv: </label>
								<input type="text" class="form-control ml-2" name="new_title" id="new_title">
						</div>
						<input type="submit" value="Potvrdi" class="btn btn-primary btn-sm ml-2 submit_btn">
						<input type="reset" value="Reset" class="btn btn-light btn-sm ml-2">
					</form>
					<div class="col-12"><?php echo (isset($this->data['msg']['msg1'])) ? "<span class='text-danger'>" . $this->data['msg']['msg1'] . "</span>" : false ?></div>
				</fieldset>
				<fieldset  class="customLegend row col-12">
					<legend>Promeni software uređaja</legend>
					<form class="form-inline mt-5" method="post" action="<?php echo INCL_PATH.'Service/serviceSoftwareChange'; ?>">
						<div class="form-group ml-2">
							<label for="device_sn">Serijski broj uređaja: </label>
							<input type="text" class="proposal-input form-control" id="device_sn">
							<input type="hidden" name="device_id" id="device_id">
							<div class="proposals d-none">
								<ul class="mb-0 pl-0"></ul>
							</div>
						</div>
						<div class="form-group form-group-inline ml-3">
					      	<select id="software" class="form-control" name="software">
					        	<option value="/">Software...</option>
					        	<?php
					        	foreach ($this->data['softwares'] as $software) {
					        	?>
					        	<option value="<?php echo $software->id; ?>"><?php echo $software->title; ?></option>
					        	<?php
					        	}
					        	?>
					      	</select>
					    </div>
						<input type="submit" value="Potvrdi" class="btn btn-primary btn-sm ml-2 submit_btn">
						<input type="reset" value="Reset" class="btn btn-light btn-sm ml-2">
					</form>
					<div class="col-12"><?php echo (isset($this->data['msg']['msg1'])) ? "<span class='text-danger'>" . $this->data['msg']['msg1'] . "</span>" : false ?></div>
				</fieldset>