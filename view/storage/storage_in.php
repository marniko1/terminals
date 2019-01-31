		<div class="container">
			<div class="row">
				<?php
				include "includes/storage_navigation.php";
				?>
				<fieldset  class="customLegend row col-6" style="height: min-content;">
					<legend>Prijem uređaja iz Lanusa</legend>
					<form class="form mt-5 col-12" method="post" action="<?php echo INCL_PATH.'Charges/makeCharge'; ?>">
						<input type="hidden" name="location" value="2">
						<div class="form-group ml-2 device_sn_div row">
							<label for="device_sn" class="col-form-label col-5">Ser. br. uređaja u Lanusu: </label>
							<input type="text" class="proposal-input device_sn form-control col-6" name="device_sn" id="device_sn">
							<div class="proposals d-none">
								<ul class="mb-0 pl-0"></ul>
							</div>
							<input type="hidden" class="device_sn device_sn_hidden" name="device_sn" id="device_id">
							<span class="d-none remove ml-2"><img style="width: 15px;height: 15px;" src="<?php  echo INCL_PATH.'assets/images/remove.png'?>"></span>
						</div>
						<div>
							<input type="submit" value="Potvrdi" class="btn btn-primary btn-sm ml-2 submit_btn">
							<input type="reset" value="Reset" class="btn btn-light btn-sm ml-2">
						</div>
					</form>
					<div class="col-12"><?php echo (isset($this->data['msg']['msg1'])) ? "<span class='text-danger'>" . $this->data['msg']['msg1'] . "</span>" : false ?></div>
				</fieldset>
				<div  class="table-holder col-5 ml-5" style="min-height: 450px; width:100%">
					<table class="col-12 table table-sm">
						<caption>Lista uređaja u Lanusu</caption>
						<thead>
							<th scope="col" style="width: auto;">#</th>
						    <th scope="col" style="width: auto;">Serijski broj</th>
						</thead>
						<tbody class="tbody">
						<?php if ($this->data['devices_in_lanus'][0]->id != null):
						foreach ($this->data['devices_in_lanus'] as $key => $device) {
						?>
						<tr style="cursor: pointer;" onclick="document.location.href='<?php echo INCL_PATH.'Devices/'.$device->id; ?>'">
							<th scope="row"><?php echo $key + 1 + $this->skip; ?></th>
							<td><?php echo $device->sn; ?></td>
						</tr>
						<?php
						}
						else: ?>
						<tr><td colspan="6">Nema uređaja.</td></tr>
						<?php endif ?>
						</tbody>
					</table>
				</div>