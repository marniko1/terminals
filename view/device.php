		<div class="container mt-5">
			<div class="row">
				<table class="col-12 table table-sm mt-5">
					<caption>Uređaj</caption>
					<thead>
						<th scope="col" style="width: auto;">#</th>
					    <th scope="col" style="width: auto;">Serijski broj</th>
				      	<th scope="col" style="width: auto;">Model</th>
				      	<th scope="col" style="width: auto;">Tip</th>
				      	<th scope="col" style="width: auto;">SIM</th>
				      	<th scope="col" style="width: auto;">ICCID</th>
				      	<th scope="col" style="width: auto;">Lokacija</th>
				      	<th scope="col" style="width: auto;">Distributor</th>
					</thead>
					<tbody class="tbody">
						<tr>
							<th scope="row"><?php echo '1'; ?></th>
							<td><?php echo $this->data['device'][0]->sn; ?></td>
							<td><?php echo $this->data['device'][0]->model; ?></td>
							<td><?php echo $this->data['device'][0]->type; ?></td>
							<td><?php echo $this->data['device'][0]->sim; ?></td>
							<td><?php echo $this->data['device'][0]->iccid; ?></td>
							<td><?php echo $this->data['device'][0]->location; ?></td>
							<td><?php echo $this->data['device'][0]->distributor; ?></td>
						</tr>
					</tbody>
				</table>