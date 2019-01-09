		<div class="container">
			<div class="row">
				<?php
				include "includes/service_navigation.php";
				// var_dump($this->data['malfunctions']);
				?>
				<h1>ZAMENA UREĐAJA</h1>
				<div class="col-12 row">
					<div class="col-7">
						<form class="mt-5 row border rounded p-2" method="post" action="<?php echo INCL_PATH.'Service/switchDevices'; ?>">
							<div class="col-12 form-inline border p-2 mt-5">
								<div class="form-group row ml-2">
									<label class="mr-1" for="old_device_sn">Stari - Ser.br.: </label>
									<input type="text" class="proposal-input device_sn form-control col-5" id="old_device_sn">
									<input type="hidden" class="device_sn device_sn_hidden" name="old_device_id" id="old_device_id">
									<div class="proposals d-none">
										<ul class="mb-0 pl-0"></ul>
									</div>
								</div>
								<div class="form-group row ml-4">
									<label class="mr-1" for="location_info">Lokacija: </label>
									<input type="text" id="location_info" class="form-control" disabled>
									<input type="hidden" name="location_id" id="location_id">
								</div>
							</div>
							<div class="col-12 form-inline mt-5 border p-2">
								<div class="form-group ml-2">
									<label class="mr-1" for="new_device_sn">Novi - Ser.br.: </label>
									<input type="text" id="new_device_sn" class="form-control col-5 proposal-input">
									<input type="hidden" class="device_sn device_sn_hidden" name="new_device_id" id="new_device_id">
									<div class="proposals d-none">
										<ul class="mb-0 pl-0"></ul>
									</div>
								</div>
								<div class="form-group form-group-inline">
							      	<select class="form-control" name="malfunction" id="malfunction">
							        	<option value="/">Opis kvara...</option>
							        	<?php foreach ($this->data['malfunctions'] as $malfunction): ?>
							        	<option value="<?php echo $malfunction->id; ?>"><?php echo $malfunction->title; ?></option>	
							        	<?php endforeach ?>
							      	</select>
							    </div>
							</div>
							<div class="col-12 form-inline mt-5 border p-2">
								<div class="form-group form-group-inline">
							      	<select class="form-control" name="repairer" id="repairer">
							        	<option value="/">Serviser...</option>
							        	<?php foreach ($this->data['repairers'] as $repairer): ?>
							        	<option value="<?php echo $repairer->id; ?>"><?php echo $repairer->repairer; ?></option>	
							        	<?php endforeach ?>
							      	</select>
							    </div>
							</div>
							<div class="col-12 form mt-5 border p-2">
								<div class="form-group">
								    <label for="comment">Komentar</label>
								    <textarea class="form-control" name="comment" id="comment" rows="6" cols="50"></textarea>
								</div>
							</div>
							<div class="form-group">
								<input type="hidden" name="action_type" value="1">
								<input type="checkbox" name="send_mail" id="send_mail" class="form-check-input ml-2" value="1">
								<label for="send_mail" class="form-check-label ml-4">Pošalji propratni mail</label>
							</div>
							<div class="form-group row ml-5 mt-5">
								<input type="submit" id="submit_btn" value="Potvrdi" class="btn btn-primary submit_btn">
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
				