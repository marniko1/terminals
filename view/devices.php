		<div class="container">
			<div class="row">
				<form class="mt-5 col-12 mb-5">
					<div class="form-group">
						<input type="text" name="filter" placeholder="Filter" id="filter">
					</div>
					<div class="mt-2 row params">
						<div class="form-group form-group-inline col-2">
					      	<select id="type" class="form-control" name="type">
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
					      	<select id="model" class="form-control" name="model">
					        	<option value="">Model...</option>
					        	<?php
					        	foreach ($this->data['models'] as $model) {
					        	?>
					        	<option value="<?php echo $model->id; ?>"><?php echo $model->title; ?></option>
					        	<?php
					        	}
					        	?>
					      	</select>
					    </div>
					    <div class="form-group form-group-inline col-2">
					      	<select id="software" class="form-control" name="software">
					        	<option value="">Software...</option>
					        	<?php
					        	foreach ($this->data['softwares'] as $software) {
					        	?>
					        	<option value="<?php echo $software->id; ?>"><?php echo $software->title; ?></option>
					        	<?php
					        	}
					        	?>
					      	</select>
					    </div>
					</div>
				</form>
				<div  class="table-holder" style="min-height: 450px; width:100%">
					<table class="col-12 table table-sm">
						<caption>Lista uređaja</caption>
						<thead>
							<th scope="col" style="width: auto;">#</th>
						    <th scope="col" style="width: auto;">Serijski broj</th>
						    <th scope="col" style="width: auto;">Model</th>
						    <th scope="col" style="width: auto;">Software</th>
					      	<th scope="col" style="width: auto;">Lokacija</th>
					      	<th scope="col" style="width: auto;">Distributer</th>
					      	<th scope="col" style="width: auto;">Tip</th>
						</thead>
						<tbody class="tbody">
						<?php if ($this->data['devices'][0]->sn != null):
						foreach ($this->data['devices'] as $key => $terminal) {
						?>
						<tr style="cursor: pointer;" onclick="document.location.href='<?php echo INCL_PATH.'Devices/'.$terminal->id; ?>'">
							<th scope="row"><?php echo $key + 1 + $this->skip; ?></th>
							<td><?php echo $this->data['devices'][$key]->sn; ?></td>
							<td><?php echo $this->data['devices'][$key]->model; ?></td>
							<td><?php echo $this->data['devices'][$key]->software; ?></td>
							<td><?php echo $this->data['devices'][$key]->location; ?></td>
							<td><?php echo $this->data['devices'][$key]->distributor; ?></td>
							<td><?php echo $this->data['devices'][$key]->type; ?></td>
						</tr>
						<?php
						}
						else: ?>
						<tr><td colspan="6">Nema napravljenih uređaja.</td></tr>
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