		<div class="container mt-5">
			<div class="row">
				<div  class="table-holder" style="min-height: 450px; width:100%">
					<table class="col-12 table table-sm mt-5">
						<caption>SIM</caption>
						<thead>
							<th scope="col" style="width: auto;">#</th>
						    <th scope="col" style="width: auto;">Broj</th>
					      	<th scope="col" style="width: auto;">ICCID</th>
					      	<th scope="col" style="width: auto;">Terminal</th>
						</thead>
						<tbody class="tbody">
							<tr>
								<th scope="row"><?php echo '1'; ?></th>
								<td><?php echo $this->data['sim'][0]->num; ?></td>
								<td><?php echo $this->data['sim'][0]->iccid; ?></td>
								<td><?php echo $this->data['sim'][0]->sn; ?></td>
							</tr>
						</tbody>
					</table>
					<form class="text-right" method="post" action="<?php echo INCL_PATH.'SIMs/splitSIMTerminal'; ?>">
						<input type="hidden" name="sim_id" value="<?php echo $this->data['sim'][0]->id; ?>">
						<input type="hidden" name="device_id" value="<?php echo $this->data['sim'][0]->device_id; ?>">
						<button  class="btn btn-warning">&lrarr;Razdvoj SIM i terminal&lrarr;</button>
					</form>