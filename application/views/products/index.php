
<!-- Begin Page Content -->
<div class="container-fluid mb-5">

	<!-- Breadcrumb -->
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url('home'); ?>">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Products</li>
		</ol>
	</nav>
	<!-- End Breadcrumb -->

	<!-- Message -->
	<div class="row">
		<div class="col-lg-12">
			<?= $this->session->flashdata('message'); ?>
		</div>
	</div>
	<!-- End Message -->

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">Products</h1>
	<!-- End Page Heading -->

	<!-- button -->
	<div class="row">
		<div class="col-lg-12">
			<button class="btn btn-sm btn-success mb-2" data-toggle="modal" data-target="#addProductModal">Add</button>
		</div>
	</div>
	<!-- end button -->

	<!-- content -->
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-hover text-nowrap text-center" id="dataTable" cellspacing="0" cellpadding="0">
							<thead class="text-center">
								<tr>
									<th width="5%">NO</th>
									<th>PRODUCT</th>
									<th>SCHEDULE</th>
									<th>PRICE</th>
									<th>STATUS</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1; ?>
								<?php foreach( $products as $product ) : ?>
								<tr>
									<td>
										<?= $no++; ?>
									</td>
									<td>
										<?= $product['product']; ?>
									</td>
									<td>
										<?= $product['note']; ?>
									</td>
									<td>
										Rp.&ensp;<?= number_format($product['price']); ?>
									</td>
									<td>
										<?php if( $product['is_active'] == 1 ) : ?>
											<span class="badge badge-success">active</span>
										<?php else : ?>
											<span class="badge badge-danger">non active</span>
										<?php endif; ?>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end content -->

	<!-- Add Category Modal-->
	<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?= base_url('products'); ?>" method="post">
						<div class="mb-3">
							<label for="product" class="form-label">Product</label>
							<input type="text" class="form-control" id="product" name="product" title="Enter new product" placeholder="Enter new product" value="<?= set_value('product') ?>">
							<?= form_error('product', '<small class="text-danger pl-1">', '</small>'); ?>
						</div>
						<div class="mb-3">
							<label for="schedule" class="form-label">Schedule</label>
							<input type="text" class="form-control" id="schedule" name="schedule" title="Enter new schedule" placeholder="Enter new schedule" value="<?= set_value('schedule') ?>">
							<?= form_error('schedule', '<small class="text-danger pl-1">', '</small>'); ?>
						</div>
						<div class="mb-3">
							<label for="price" class="form-label">Price</label>
							<input type="number" class="form-control" id="price" name="price" title="Enter new price" placeholder="Enter new price" value="<?= set_value('price') ?>">
							<?= form_error('price', '<small class="text-danger pl-1">', '</small>'); ?>
						</div>
						<button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
						<button class="btn btn-primary btn-sm" type="submit">Add</button>
					</form>
				</div>
			</div>
		</div>
	</div>

</div>
<!-- /.container-fluid -->
