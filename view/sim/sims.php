		<div class="container">
			<div class="row">
				<div class="col-6">
					<form class="mt-2 col-12 mb-5">
						<input type="text" name="filter" placeholder="Filter" id="filter">
					</form>
					<div  class="table-holder" style="min-height: 450px; width:100%">
						<table class="col-12 table table-sm">
							<caption>Lista sim kartica</caption>
							<thead>
								<th scope="col" style="width: auto;">#</th>
							    <th scope="col" style="width: auto;">Broj</th>
						      	<th scope="col" style="width: auto;">ICCID</th>
							</thead>
							<tbody class="tbody">
						<?php if ($this->data['sim_cards'][0]->id != null):
							foreach ($this->data['sim_cards'] as $key => $sim) {
							?>
								<tr style="cursor: pointer;" onclick="document.location.href='<?php echo INCL_PATH.'SIMs/'.$sim->id; ?>'">
									<th scope="row"><?php echo $key + 1 + $this->skip; ?></th>
									<td><?php echo $sim->num; ?></td>
									<td><?php echo $sim->iccid; ?></td>
								</tr>
							<?php
							}
							else: ?>
							<tr><td colspan="6">Nema sim kartica.</td></tr>
						<?php endif ?>
							</tbody>
						</table>
					</div>
					<nav class="col-12">
					    <ul class="pagination justify-content-center">
					    	<?php
						    foreach ($this->data['pagination_links'] as $link) {
						    	echo  '<li class="page-item"><a href="'.$link[0].'" class="page-link">'.$link[1].'</a></li>';
						    }
						    ?>
					    </ul>
					</nav>
				</div>
				<!-- ****************************************************************************************** -->
				<div class="col-6">
					<fieldset  class="customLegend row col-12">
						<legend>Poveži SIM sa terminalom</legend>
						<form class="form-inline mt-5 col-12 row" method="post" action="<?php echo INCL_PATH.'SIMs/putSIMInTerminal'; ?>">
							<div class="form-group ml-2 col-7 pr-0">
								<label for="iccid" class="col-form-label col-2">ICCID: </label>
								<input type="text" name="iccid" id="iccid" class="proposal-input form-control col-9">
								<input type="hidden" name="iccid" id="iccid_id">
								<div class="proposals d-none">
									<ul class="mb-0 pl-0"></ul>
								</div>
							</div>
							<div class="form-group col-4">
								<label for="terminal" class="col-form-label col-4 mr-2">Terminal: </label>
								<input type="text" name="terminal" id="terminal" class="proposal-input form-control col-7">
								<input type="hidden" name="terminal" id="terminal_id">
								<div class="proposals d-none">
									<ul class="mb-0 pl-0"></ul>
								</div>
							</div>
							<div class="form-group mt-3">
								<input type="submit" value="Potvrdi" class="btn btn-primary btn-sm ml-2 submit_btn">
								<input type="reset" value="Reset" class="btn btn-light btn-sm ml-2">
							</div>
						</form>
						<div class="col-12"><?php echo (isset($this->data['msg']['msg1'])) ? "<span class='text-danger'>" . $this->data['msg']['msg1'] . "</span>" : false ?></div>
					</fieldset>
					<!--***************************************************************************************** -->
					<fieldset  class="customLegend row col-12">
						<legend>Dodaj novu sim karticu</legend>
						<form class="form-inline mt-5 col-12 row" method="post" action="<?php echo INCL_PATH.'SIMs/addNewSIM'; ?>">
							<div class="form-group ml-2">
								<label for="number" class="col-form-label">Broj: </label>
								<input type="text" name="number" id="number" class="form-control">
							</div>
							<div class="form-group ml-2">
								<label for="iccid" class="col-form-label">ICCID: </label>
								<input type="text" name="iccid" id="iccid" class="proposal-input form-control">
							</div>
							<div class="form-group mt-3">
								<input type="submit" value="Potvrdi" class="btn btn-primary btn-sm ml-2 submit_btn">
								<input type="reset" value="Reset" class="btn btn-light btn-sm ml-2">
							</div>
						</form>
						<div class="col-12"><?php echo (isset($this->data['msg']['msg1'])) ? "<span class='text-danger'>" . $this->data['msg']['msg1'] . "</span>" : false ?></div>
					</fieldset>
				</div>