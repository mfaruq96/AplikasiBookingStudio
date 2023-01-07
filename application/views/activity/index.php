
<!-- Begin Page Content -->
<div class="container-fluid mb-5">

	<!-- Breadcrumb -->
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url('home'); ?>">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Booking</li>
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
	<h1 class="h3 mb-4 text-gray-800">Booking</h1>
	<!-- End Page Heading -->

	<!-- button -->
	<div class="row">
		<div class="col-lg-12">
			<button class="btn btn-sm btn-primary mb-2" data-toggle="modal" data-target="#bookingNow">Booking Now</button>
			<?php if( !empty($order_details) ) : ?>
				<button class="btn btn-sm btn-success mb-2" data-toggle="modal" data-target="#checkout">Check Out</button>
			<?php endif; ?>
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
									<th>DATE</th>
									<th>ROOM</th>
									<th>SCHEDULE</th>
									<th>NOTE</th>
									<th>OPSI</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1; ?>
								<?php foreach( $order_details as $order_detail ) : ?>
								<tr>
									<td>
										<?= $no++; ?>
									</td>
									<td>
										<?= date('d F Y', strtotime($order_detail['date'])); ?>
									</td>
									<td>
										<?= $order_detail['room']; ?>
									</td>
									<td>
										<?= $order_detail['note']; ?>
									</td>
									<td>
										<?= $order_detail['remark']; ?>
									</td>
									<td>
										<a href="<?= base_url('activity/delete/') . $order_detail['id_order_detail']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure want to delete ?');">
											<i class="fas fa-trash"></i> delete
										</a>
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

</div>
<!-- /.container-fluid -->
