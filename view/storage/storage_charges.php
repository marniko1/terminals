		<div class="container">
			<div class="row">
				<?php
				include "includes/storage_navigation.php";
				// var_dump($this->data['devices_in_storage']);
				?>
				<fieldset  class="customLegend row col-6" style="height: min-content;">
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
							<label for="device_sn" class="col-form-label col-5 px-0">Ser. br. uređaja u magacinu: </label>
							<input type="text" class="proposal-input device_sn form-control col-6" name="device_sn" id="device_sn">
							<input type="hidden" class="device_sn_hidden" name="device_sn" id="device_id">
							<div class="proposals d-none">
								<ul class="mb-0 pl-0"></ul>
							</div>
							<span class="d-none remove ml-2"><img style="width: 15px;height: 15px;" src="<?php  echo INCL_PATH.'assets/images/remove.png'?>"></span>
						</div>
						<div>
							<input type="submit" value="Potvrdi" class="btn btn-primary btn-sm ml-2 submit_btn">
							<button class="btn btn-sm btn-primary" id="print_btn">Štampanje otpremnice</button>
							<input type="reset" value="Reset" class="btn btn-light btn-sm ml-2">
						</div>
					</form>
					<div class="col-12"><?php echo (isset($this->data['msg']['msg1'])) ? "<span class='text-danger'>" . $this->data['msg']['msg1'] . "</span>" : false ?></div>
				</fieldset>
				<!-- terminals table -->
				<div  class="table-holder col-2 ml-5" style="min-height: 450px; width:100%">
					<table class="col-12 table table-sm">
						<caption>Lista terminala u magacinu</caption>
						<thead>
							<th scope="col" style="width: auto;">#</th>
						    <th scope="col" style="width: auto;">Serijski broj</th>
						</thead>
						<tbody class="tbody">
						<?php if (isset($this->data['terminals_in_storage'][0]->id)):
						foreach ($this->data['terminals_in_storage'] as $key => $terminal) {
						?>
						<tr style="cursor: pointer;" onclick="document.location.href='<?php echo INCL_PATH.'Devices/'.$terminal->id; ?>'">
							<th scope="row"><?php echo $key + 1 + $this->skip; ?></th>
							<td><?php echo $terminal->sn; ?></td>
						</tr>
						<?php
						}
						else: ?>
						<tr><td colspan="6">Nema uređaja.</td></tr>
						<?php endif ?>
						</tbody>
					</table>
				</div>
				<!-- terminals table -->
				<!-- qprox table -->
				<div  class="table-holder col-3 ml-1" style="min-height: 450px; width:100%">
					<table class="col-12 table table-sm">
						<caption>Lista qprox uređaja u magacinu</caption>
						<thead>
							<th scope="col" style="width: auto;">#</th>
						    <th scope="col" style="width: auto;">Serijski broj</th>
						</thead>
						<tbody class="tbody">
						<?php if (isset($this->data['qproxes_in_storage'][0]->id)):
						foreach ($this->data['qproxes_in_storage'] as $key => $qprox) {
						?>
						<tr style="cursor: pointer;" onclick="document.location.href='<?php echo INCL_PATH.'Devices/'.$qprox->id; ?>'">
							<th scope="row"><?php echo $key + 1 + $this->skip; ?></th>
							<td><?php echo $qprox->sn; ?></td>
						</tr>
						<?php
						}
						else: ?>
						<tr><td colspan="6">Nema uređaja.</td></tr>
						<?php endif ?>
						</tbody>
					</table>
				</div>
				<!-- qprox table -->
				<!-- delivery note place -->
				<div class="col-8 ml-4" id="delivery_note_div">
					<?php
					include "includes/delivery_note.php";
					?>
				</div>
				<!-- delivery note place -->