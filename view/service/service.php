		<div class="container">
			<div class="row">
				<?php
				include "includes/service_navigation.php";
				?>
				<h1>ZAMENA UREĐAJA</h1>
				<div class="col-12 row">
					<div class="col-7">
						<form class="mt-5 row border rounded p-2" method="post" action="<?php echo INCL_PATH.'Charges/makeCharge'; ?>">
							<div class="col-12 form-inline border p-2 mt-5">
								<div class="form-group row ml-2">
									<label class="mr-1" for="old_device_sn">Stari - Ser.br.: </label>
									<input type="text" class="proposal-input device_sn form-control col-5" name="device_sn" id="old_device_sn">
									<input type="hidden" class="device_sn device_sn_hidden" name="old_device_id" id="old_device_id">
									<div class="proposals d-none">
										<ul class="mb-0 pl-0"></ul>
									</div>
								</div>
								<div class="form-group row ml-4">
									<label class="mr-1" for="location">Lokacija: </label>
									<input type="text" id="location" class="form-control" disabled>
								</div>
							</div>
							<div class="col-12 form-inline mt-5 border p-2">
								<div class="form-group ml-2">
									<label class="mr-1" for="new_device_sn">Novi - Ser.br.: </label>
									<input type="text" name="new_device_sn" id="new_device_sn" class="form-control col-5 proposal-input">
									<input type="hidden" class="device_sn device_sn_hidden" name="new_device_id" id="new_device_id">
									<div class="proposals d-none">
										<ul class="mb-0 pl-0"></ul>
									</div>
								</div>
								<div class="form-group form-group-inline">
							      	<select class="form-control" name="location" id="location_for_charge">
							        	<option value="/">Opis kvara...</option>
							        	<option value="/">Blokira</option>
							        	<option value="/">Nema mrezu</option>
							        	<option value="/">Ne stampa</option>
							        	
							      	</select>
							    </div>
							</div>
							<div class="form-group">
								<input type="checkbox" name="send_mail" id="send_mail" class="form-check-input ml-2" value="1">
								<label for="send_mail" class="form-check-label ml-4">Pošalji propratni mail</label>
							</div>
							<div class="form-group row ml-5 mt-5">
								<input type="submit" id="submit_btn" value="Potvrdi" class="btn btn-primary submit_btn" disabled>
							</div>
							<?php echo (isset($this->data['msg']['msg1'])) ? "<span class='text-danger'>" . $this->data['msg']['msg1'] . "</span>" : false ?>
						</form>
					</div>
					<div  class="table-holder col-2 ml-5 col-4" style="min-height: 450px; width:100%">
						<table class="col-12 table table-sm">
							<caption>Lista uređaja u servisu</caption>
							<thead>
								<th scope="col" style="width: auto;">#</th>
							    <th scope="col" style="width: auto;">Serijski broj</th>
							</thead>
							<tbody class="tbody">
								<?php if ($this->data['devices_in_service'][0]->id != null):
								foreach ($this->data['devices_in_service'] as $key => $device) {
								?>
								<tr style="cursor: pointer;" onclick="document.location.href='<?php echo INCL_PATH.'Devices/'.$device->id; ?>'">
									<th scope="row"><?php echo $key + 1 + $this->skip; ?></th>
									<td><?php echo $device->sn; ?></td>
								</tr>
								<?php
								}
								else: ?>
								<tr><td colspan="6">Nema napravljenih uređaja.</td></tr>
								<?php endif ?>
							</tbody>
						</table>
					</div>
				</div>
				