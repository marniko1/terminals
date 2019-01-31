					<div class="bg-white p-5 col-12" style="height: 29.7cm;" id="delivery_note">
						<h6>APEX SOLUTION TECHNOLOGY DOO</h6>
						<div class="border-bottom company_data">
							<p>Makenzijeva 24</p>
							<p>11000 Beograd, Srbija</p>
							<p>PIB: 106037154</p>
							<p>Šifra Delatnosti: 7022</p>
							<p>Tekući Račun: 340-11005053-79, Erste Bank</p>
						</div>
						<p><b>Vlasnik opreme:</b> Apex Solution Technology doo, magacin: Makenzijeva 24</p>
						<div class="text-center">
							<h5 class="headline">OTPREMNICA ZA UREĐAJE</h5>
							<span class="delivery_note_num"></span>
						</div>
						<h6 class="border-bottom col-4 mt-4 delivery_note_delivery_location">Odredište: <span></span></h6>
						<table class="col-12 text-center" border="1">
							<thead class="bg-light">
								<tr>
									<th scope="col" style="width: 14%;">Redni broj</th>
									<th scope="col" style="width: 43%;">Terminal</th>
									<th scope="col" style="width: 43%;">Qprox</th>
								</tr>
							</thead>
							<tbody>
								<?php for ($i=0; $i < 20; $i++) { 
								?>
								<tr>
									<td><?php echo $i+1; ?></td>
									<td class="terminal"></td>
									<td class="qprox"></td>
								</tr>
								<?php
								} ?>
							</tbody>
						</table>
						<div class="delivery_note_footer row mt-5">
							<div class="col-5 text-center">
								<p>Robu izdao za magacin:</p>
								<div class="border-bottom mt-5"></div>
								<small>(potpis)</small>
							</div>
							<div class="col-2"></div>
							<div class="col-5 text-center">
								<p class="delivery_note_delivery_location">Robu primio za <span></span>:</p>
								<div class="border-bottom mt-5"></div>
								<small>(potpis)</small>
							</div>
						</div>
					</div>