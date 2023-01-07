<!-- Booking Now Modal-->
<div class="modal fade" id="bookingNow" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Booking Now</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?= base_url('activity'); ?>" method="post">
						<div class="mb-3">
							<label for="date" class="form-label">Date</label>
							<input type="date" class="form-control" id="date" name="date" title="Enter new date" placeholder="Enter new date" value="<?= set_value('date') ?>">
							<?= form_error('date', '<small class="text-danger pl-1">', '</small>'); ?>
						</div>
						<div class="mb-3">
							<label for="room" class="form-label">Room</label>
							<select name="room" id="room" class="form-control" title="Choose room">
								<option value="1">Room 1</option>
								<option value="2">Room 2</option>
								<option value="3">Room 3</option>
							</select>
							<?= form_error('room', '<small class="text-danger pl-1">', '</small>'); ?>
						</div>
						<div class="mb-3">
							<label for="schedule" class="form-label">Schedule</label>
							<select name="schedule" id="schedule" class="form-control" title="Choose schedule">
								<?php foreach( $products as $product ) : ?>
									<option value="<?= $product['id_product']; ?>"><?= $product['note']; ?></option>
								<?php endforeach; ?>
							</select>
							<?= form_error('schedule', '<small class="text-danger pl-1">', '</small>'); ?>
						</div>
						<div class="mb-3">
							<label for="note" class="form-label">Note</label>
							<input type="text" class="form-control" id="note" name="note" title="Enter new note" placeholder="Enter new note" value="<?= set_value('note') ?>">
							<?= form_error('note', '<small class="text-danger pl-1">', '</small>'); ?>
						</div>
						<button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
						<button class="btn btn-primary btn-sm" type="submit">Check availability</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- End Booking Now Modal-->
