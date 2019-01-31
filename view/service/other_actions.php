		<div class="container">
			<div class="row">
				<?php
				include "includes/service_navigation.php";
				?>
				<h1>OSTALE SERVISNE AKCIJE</h1>
				<form class="mt-5 row border rounded p-2" method="post" action="<?php echo INCL_PATH.'Service/doOtherActions'; ?>">
							<div class="col-12 form-inline border p-2 mt-5">
								<div class="form-group row ml-2">
									<label class="mr-1" for="device_sn">Ser.br.uređaja: </label>
									<input type="text" class="proposal-input device_sn form-control col-5" id="device_sn">
									<input type="hidden" class="device_sn device_sn_hidden" name="device_id" id="device_id">
									<div class="proposals d-none">
										<ul class="mb-0 pl-0"></ul>
									</div>
								</div>
								<div class="form-group row ml-2">
									<label class="mr-1" for="location_info">Lokacija: </label>
									<input type="text" id="location_info" class="form-control" disabled>
									<input type="hidden" name="location_id" id="location_id">
								</div>
								<div class="form-group form-group-inline ml-5">
							      	<select class="form-control" name="malfunction" id="malfunction">
							        	<option value="/">Opis kvara...</option>
							        	<?php foreach ($this->data['malfunctions'] as $malfunction): ?>
							        	<option value="<?php echo $malfunction->id; ?>"><?php echo $malfunction->title; ?></option>	
							        	<?php endforeach ?>
							      	</select>
							    </div>
							    <div class="form-group form-group-inline ml-5">
							      	<select class="form-control" name="action_type" id="action_type">
							        	<option value="/">Servisna akcija...</option>
							        	<?php foreach ($this->data['action_types'] as $action_type): ?>
							        	<option value="<?php echo $action_type->id; ?>"><?php echo $action_type->title; ?></option>	
							        	<?php endforeach ?>
							      	</select>
							    </div>
								<div class="form-group form-group-inline ml-2">
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
								<input type="checkbox" name="send_mail" id="send_mail" class="form-check-input ml-2" value="1">
								<label for="send_mail" class="form-check-label ml-4">Pošalji propratni mail</label>
							</div>
							<div class="form-group row ml-5 mt-5">
								<input type="submit" id="submit_btn" value="Potvrdi" class="btn btn-primary submit_btn">
							</div>
							<?php echo (isset($this->data['msg']['msg1'])) ? "<span class='text-danger'>" . $this->data['msg']['msg1'] . "</span>" : false ?>
						</form>