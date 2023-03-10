
<!-- Begin Page Content -->
<div class="container-fluid mb-5">

	<!-- Breadcrumb -->
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url('home'); ?>">Home</a></li>
			<li class="breadcrumb-item"><a href="<?= base_url('orders/order_verification'); ?>">Order Verification</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?= $order_detail_try['name'] . " - " . $order['invoice']; ?></li>
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
	<h1 class="h3 mb-4 text-gray-800">Order Verification <?= $order['invoice']; ?></h1>
	<!-- End Page Heading -->

	<!-- customer details -->
	<div class="row mb-2">
		<div class="col-lg-7">
			<table class="table text-nowrap" cellpadding="0" cellspacing="0">
				<tbody>
					<tr>
						<td>Invoice</td>
						<td>:</td>
						<td>
							<?= $order['invoice']; ?>
						</td>
					</tr>
					<tr>
						<td>Date</td>
						<td>:</td>
						<td>
							<?= date('d F Y, h:i', strtotime($order['updated_at'])); ?>
						</td>
					</tr>
					<tr>
						<td>Name</td>
						<td>:</td>
						<td>
							<?= $order_detail_try['name']; ?>
						</td>
					</tr>
					<tr>
						<td>Phone</td>
						<td>:</td>
						<td>
							<?= $order_detail_try['phone']; ?>
						</td>
					</tr>
					<tr>
						<td>Status</td>
						<td>:</td>
						<td>
							<span class="badge badge-info">sudah bayar</span>
						</td>
					</tr>
					<tr>
						<td>Remark</td>
						<td>:</td>
						<td>
							<?= $order['remarks']; ?>
						</td>
					</tr>
				</tbody>
			</table>
			<hr>
		</div>
	</div>
	<!-- end customer details -->

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
									<th>PRICE</th>
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
									<td class="text-right">
										Rp.&ensp;<?= number_format($order_detail['price']); ?>
									</td>
								</tr>
								<?php endforeach; ?>
								<tr>
									<td colspan="5">
										<b>Sub Total</b>
									</td>
									<td class="text-right">
										<b>
											Rp.&ensp;<?= number_format($order['total_price']); ?>
										</b>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end content -->

	<!-- checkout -->
	<div class="row mt-3">
		<div class="col-lg-12 mb-2 text-right">
			<button class="btn btn-sm btn-info mb-2" width="100%" data-toggle="modal" data-target="#viewPayment">View proof of payment</button>
			<button class="btn btn-sm btn-success mb-2" width="100%" data-toggle="modal" data-target="#viewProcess">Process</button>
		</div>
	</div>
	<!-- end checkout -->

	<!-- Modal Process -->
	<div class="modal fade" id="viewProcess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="add">Payment of Invoice : <?= $order['invoice']; ?></h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">??</span>
					</button>
				</div>
				<div class="modal-body">
					Are you sure want to process ?
				</div>
				<div class="modal-footer">
					<form action="<?= base_url('orders/order_verification_verify/') . $order['id_order']; ?>" method="post">
						<button class="btn btn-primary btn-sm" type="submit">OK</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- End Modal Process -->

	<!-- Modal Proof Payment -->
	<div class="modal fade" id="viewPayment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="add">Payment of Invoice : <?= $order['invoice']; ?></h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">??</span>
					</button>
				</div>
				<div class="modal-body">
					<img src="<?= base_url('assets/img/orders/') . $order['image']; ?>" alt="<?= $order['invoice']; ?>" title="<?= $order['invoice']; ?>" class="card-img">
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary btn-sm" type="button" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>
	<!-- End Modal Proof Payment -->

</div>
<!-- /.container-fluid -->
