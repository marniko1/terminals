		<div class="container">
			<div class="row">
				<?php
				include "includes/service_navigation.php";
				?>
				<h1>ISTORIJA KVAROVA</h1>
				<form class="mt-2 col-12 mb-5">
					<div class="row">
						<div class="form-group-inline col-7">
							<input type="text" name="filter" placeholder="Filter" id="filter">
						</div>
						<div class="row border rounded p-2">
							<div class="form-group-inline mr-2">
								<label>Od: </label>
								<input type="date" name="date_from" disabled>
							</div>
							<div class="form-group-inline">
								<label>do: </label>
								<input type="date" name="date_to" disabled>
							</div>
						</div>
					</div>
					<div class="mt-2 row params">
						<div class="form-group form-group-inline col-2">
					      	<select id="type" class="form-control" name="type" disabled>
					        	<option value="">Tip...</option>
					        	<?php
					        	foreach ($this->data['types'] as $type) {
					        	?>
					        	<option value="<?php echo $type->id; ?>"><?php echo $type->title; ?></option>
					        	<?php
					        	}
					        	?>
					      	</select>
					    </div>
						<div class="form-group form-group-inline col-2">
					      	<select id="model" class="form-control" name="model" disabled>
					        	<option value="">Model...</option>
					        	
					      	</select>
					    </div>
					    <div class="form-group form-group-inline col-2">
					      	<select id="software_v" class="form-control" name="software_v" disabled>
					        	<option value="">Software v...</option>
					        	
					      	</select>
					    </div>
					</div>
				</form>
				<div  class="table-holder" style="min-height: 450px; width:100%">
					<table class="col-12 table table-sm">
						<caption>Istorijat kvarova</caption>
						<thead>
							<th scope="col" style="width: auto;">#</th>
						    <th scope="col" style="width: auto;">Serijski broj</th>
						    <th scope="col" style="width: auto;">Tip</th>
						    <th scope="col" style="width: auto;">Model</th>
						    <th scope="col" style="width: auto;">Lokacija</th>
						    <th scope="col" style="width: auto;">Opis</th>
						    <th scope="col" style="width: auto;">Serviserska akcija</th>
						    <th scope="col" style="width: auto;">Serviser</th>
					      	<th scope="col" style="width: auto;">Komentar</th>
					      	<th scope="col" style="width: auto;">Datum</th>
						</thead>
						<tbody class="tbody">
						<?php foreach ($this->data['malfunction_history'] as $key => $row): ?>
							<tr style="cursor: pointer;" onclick="document.location.href='<?php echo INCL_PATH.'Devices/'.$row->id; ?>'">
								<th scope="row"><?php echo $key + 1 + $this->skip; ?></th>
								<td><?php echo $row->sn; ?></td>
								<td><?php echo $row->type; ?></td>
								<td><?php echo $row->model; ?></td>
								<td><?php echo $row->location; ?></td>
								<td><?php echo $row->malfunction; ?></td>
								<td><?php echo $row->action; ?></td>
								<td><?php echo $row->repairer; ?></td>
								<td><?php echo $row->comment; ?></td>
								<td><?php echo $row->date; ?></td>
							</tr>
						<?php endforeach ?>
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