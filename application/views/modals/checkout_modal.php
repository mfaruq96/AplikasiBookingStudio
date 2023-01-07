<!-- Check Out Modal-->
<div class="modal fade" id="checkout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Check Out</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= base_url('activity/check_out/') . $order['id_order']; ?>" method="post" enctype="multipart/form-data">
					<div class="mb-3">
						<div class="custom-file">
							<input type="file" class="custom-file-input" id="image" name="image" required>
							<label for="image" class="custom-file-label">Evidence of payment</label>
						</div>
					</div>
					<div class="mb-3">
						<input type="text" id="remark" name="remark" class="form-control" placeholder="Enter your note.." required>
					</div>
					<div class="mb-3">
						<button class="btn btn-sm btn-success" width="100%">Check Out</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- End Check Out Modal-->
